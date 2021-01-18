<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hitung_ahp extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_kriteria');
		$this->load->model('m_kategori');
		$this->load->model('t_hitung');
		$this->load->model('t_hitung_det');
		$this->load->model('t_sintesis');
		$this->load->model('t_hitungan_vektor');
		$this->load->model('t_normalisasi');
		$this->load->model('m_global');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		
		$join = [ 
			['table' => 'm_proyek as p', 'on' => 'h.id_proyek = p.id']
		];

		$data_hitung = $this->m_global->multi_row(
			'h.*, p.nama_proyek, p.tahun_proyek', ['h.deleted_at' => null], 't_hitung as h', $join, 'h.created_at desc');
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Data Perhitungan AHP',
			'data_user' => $data_user,
			'data_hitung' => $data_hitung
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_hitung_ahp',
			'js'	=> 'hitung_ahp.js',
			'view'	=> 'view_list_hitung_ahp'
		];

		$this->template_view->load_view($content, $data);
		
	}

	public function formulir_proyek()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_proyek = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_proyek', NULL, 'tahun_proyek desc');
		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Form Perhitungan AHP',
			'data_user' => $data_user,
			'kategori' => $kategori,
			'data_proyek' => $data_proyek
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> 'form_hitung.css',
			'modal' => null,
			'js'	=> 'hitung_ahp.js',
			'view'	=> 'view_form_hitung_proyek'
		];
		
		$this->template_view->load_view($content, $data);
	}

	public function next_step_proyek()
	{
		$id_user = $this->session->userdata('id_user'); 
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id = $this->t_hitung->get_max_id();
		$kat = $this->m_global->single_row('*', ['deleted_at' =>null], 'm_kategori', null, 'urut');

		if ($this->input->post('proyek') == '') {
			$data['inputerror'][] = 'proyek';
            $data['error_string'][] = 'Wajib Memilih proyek';
			$data['status'] = FALSE;
			echo json_encode($data);
			return;
		}
		
		$this->db->trans_begin();
		
		## insert data header
		$data_insert = [
			'id' => $id,
			'id_user' => $id_user,
			'created_at' => $timestamp,
			'id_proyek' => $this->input->post('proyek')
		];
		
		$insert = $this->t_hitung->save($data_insert);
		
		

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['id_hitung'] = $this->enkripsi->enc_dec('encrypt', $id);
			$retval['id_kategori'] = $this->enkripsi->enc_dec('encrypt', $kat->id);
			$retval['pesan'] = 'Proses Perhitungan Gagal';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['id_hitung'] = $this->enkripsi->enc_dec('encrypt', $id);
			$retval['id_kategori'] = $this->enkripsi->enc_dec('encrypt', $kat->id);
			$retval['pesan'] = 'Proses Perhitungan Sukses';
		}

		echo json_encode($retval);
	}

	public function formulir_hitung($id=false)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$id_kat = $this->enkripsi->enc_dec('decrypt', $this->input->get('kategori'));
		$kat = $this->m_kategori->get_by_condition(['id' => $id_kat, 'deleted_at' => null], true);
		
		$data_himpunan = $this->m_global->multi_row('*', ['deleted_at' => null, 'is_sama_penting' => null], 'm_himpunan', NULL, 'id');

		if(!$kat) {
			return redirect('hitung_ahp');
		}

		//cari hipunan 1=1
		$q_himpunan_sama = $this->m_global->single_row('*', ['is_sama_penting' => 1, 'deleted_at' =>null], 'm_himpunan');
		
		## jika data baru (add data)
		if($id == false) {
			$old_data = [];
			$data_hitung = [];
		}else{
			$id = $this->enkripsi->enc_dec('decrypt', $id);
			$data_hitung = $this->m_global->single_row('t_hitung.*, m_proyek.nama_proyek', ['t_hitung.id' => $id, 't_hitung.deleted_at' =>null], 't_hitung', [['table' => 'm_proyek', 'on' => 't_hitung.id_proyek = m_proyek.id']]);

			if(!$data_hitung) {
				return redirect('hitung_ahp');
			}

			//cek di tabel child nya ada apa tidak
			$data_child  = $this->m_global->multi_row('*', ['id_hitung' => $id], 't_hitung_det');
			if($data_child) {
				## cari data lawas (edit) 
				$where = [
					'id_hitung' => $id,
					'id_himpunan !=' => $q_himpunan_sama->id,
					'kode_kategori' => $kat->kode_kategori,
					'flag_proses_kode_kategori' => $kat->kode_kategori,
				];

				$old_data = $this->m_global->multi_row('*', $where, 't_hitung_det', null, 'id');
				//echo $this->db->last_query();exit;
				
			}else{
				$old_data = [];
			}
		}

		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');
		
		for ($i=1; $i <= count($kategori); $i++) { 
			for ($z=1; $z <= $i; $z++) { 
				if($i == $z) {
					continue;
				}
				$retval[$kategori[$z-1]->kode_kategori][] = ['kode'=>$kategori[$i-1]->kode_kategori, 'nama' => $kategori[$i-1]->nama, 'id' => $kategori[$i-1]->id];
			}
		}
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Perhitungan Ahp : ( Proyek '.$data_hitung->nama_proyek.' )',
			'data_user' => $data_user,
			'kategori' => $kategori,
			'step' => $retval,
			'data_himpunan' => $data_himpunan,
			'old_data' => $old_data,
			'kat' => $kat
		);

		
		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// exit;


		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> 'form_hitung.css',
			'modal' => 'modal_hitung_ahp',
			'js'	=> 'hitung_ahp.js',
			'view'	=> 'view_form_hitung'
		];
		
		$this->template_view->load_view($content, $data);
	}

	public function next_step()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_hitung = $this->input->post('id_hitung');
		$id_kategori = $this->input->post('id_kategori');

		## id kategori terpilih
		$data_kategori_row = $this->m_global->single_row('*', ['id' => $id_kategori, 'deleted_at' => null], 'm_kategori');
		
		$id_kategori = $data_kategori_row->id;
		$step_kategori = $data_kategori_row->kode_kategori;
		
		## data kategori
		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');

		##cari himpunan 1 = 1
		$q_himpunan_sama = $this->m_global->single_row('*', ['is_sama_penting' => 1, 'deleted_at' =>null], 'm_himpunan');
		
		for ($i=1; $i <= count($kategori); $i++) { 
			for ($z=1; $z <= $i; $z++) { 
				if($i == $z) {
					continue;
				}

				$step[$kategori[$z-1]->kode_kategori][] = [
					'kode'=>$kategori[$i-1]->kode_kategori, 
					'nama' => $kategori[$i-1]->nama,
					'id' => $kategori[$i-1]->id
				];
			}
		}
		// var_dump($step);exit;

		$old_data = $this->m_global->multi_row('*', [
			'id_hitung' => $id_hitung,
			'id_himpunan !=' => $q_himpunan_sama->id,
			'flag_proses_kode_kategori' => $step_kategori
		], 't_hitung_det', NULL, 'id');

		// echo $this->db->last_query();exit;
		

		//set flag first/last step
		$is_first_step = 'false';
		$is_last_step = 'false';

		## cari posisi step berapa sekarang
		$index_step = 0;
		foreach ($step as $kkk => $vvv) {
			$index_step += 1;
			if($kkk == $step_kategori) {
				break;
			}
		}

		// var_dump($index_step);exit;
		$this->db->trans_begin();
		
		if($old_data) {
			## delete
			$del = $this->m_global->delete(['id_hitung' => $id_hitung, 'flag_proses_id_kategori' => $id_kategori], 't_hitung_det');
		}

		## insert awalan misal ci -> ci, c2 -> c2 berdasarkan kriterianya
		$ins_awal = [
			'id' => $this->t_hitung_det->get_max_id(),
			'id_hitung' => $id_hitung,
			'id_kategori' => $id_kategori,
			'kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
			'id_himpunan' => $q_himpunan_sama->id,
			'id_kategori_tujuan' => $id_kategori,
			'kode_kategori_tujuan' => trim(strtoupper(strtolower($step_kategori))),
			'flag_proses_id_kategori' => $id_kategori,
			'flag_proses_kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
			'created_at' => $timestamp
		];
		
		$insert = $this->t_hitung_det->save($ins_awal);

		foreach ($step[$step_kategori] as $key => $value) {
			### insert
			$data_ins = [
				'id' => $this->t_hitung_det->get_max_id(),
				'id_hitung' => $id_hitung,
				'id_kategori' => $id_kategori,
				'kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
				'id_himpunan' => $this->input->post('himpunan')[$key],
				'id_kategori_tujuan' => $value['id'],
				'kode_kategori_tujuan' => $value['kode'],
				'flag_proses_id_kategori' => $id_kategori,
				'flag_proses_kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
				'created_at' => $timestamp
			];
			
			$insert = $this->t_hitung_det->save($data_ins);

			### insert reverse
			/**
			 * todo : 
			 * 1 .cari reversenya dulu berdasarkan himpunan terpilih 
			 * 2. jika ketemu gunakan reverse tersebut.
			 */

			$q_reverse = $this->m_global->single_row('*', ['id_himpunan_use' => $this->input->post('himpunan')[$key], 'deleted_at' =>null], 't_pasangan_himpunan');

			$data_reverse_ins = [
				'id' => $this->t_hitung_det->get_max_id(),
				'id_hitung' => $id_hitung,
				'id_kategori' => $value['id'],
				'kode_kategori' => $value['kode'],
				'id_himpunan' => $q_reverse->id_himpunan_reverse,
				'id_kategori_tujuan' => $id_kategori,
				'kode_kategori_tujuan' => trim(strtoupper(strtolower($step_kategori))),
				'flag_proses_id_kategori' => $id_kategori,
				'flag_proses_kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
				'created_at' => $timestamp
			];

			$insert = $this->t_hitung_det->save($data_reverse_ins);
		}

		// echo "<pre>";
		// print_r ($data_reverse_ins);
		// echo "</pre>";
		// exit;

		if($index_step == 1) {
			$is_first_step = 'true';
		}else if($index_step == count($step)){
			$is_last_step = 'true';
		}

		if($is_last_step == 'false') {
			if($is_first_step){
				$prev_step = 'false';
				$next_step = $index_step + 1;

				$prev_step_kode = 'false';
				$next_step_kode = 'C'.$next_step;
			}else{
				$prev_step = $index_step - 1;
				$next_step = $index_step + 1;

				$prev_step_kode = 'C'.$prev_step;
				$next_step_kode = 'C'.$next_step;
			}	
		}else{
			$prev_step = $index_step - 1;
			$next_step = 'false';

			$prev_step_kode = 'C'.$prev_step;
			$next_step_kode = 'false';
		}

		$data_step = [
			'id_hitung' => $this->enkripsi->enc_dec('encrypt', $id_hitung),
			'id_kategori' => $id_kategori,
			'index_step' => $index_step,
			'is_first_step' => $is_first_step,
			'is_last_step' => $is_last_step,
			'next_step' => $this->enkripsi->enc_dec('encrypt', $next_step),
			'next_step_kode' => $next_step_kode,
			'prev_step' => $prev_step,
			'prev_step_kode' => $prev_step_kode,
		];

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['data_step'] = null;
			$retval['pesan'] = 'Gagal Melakukan Perhitungan';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['data_step'] = $data_step;
			$retval['pesan'] = 'Sukses Melakukan Perhitungan';
		}

		echo json_encode($retval);
	}

	public function finish_step()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_hitung = $this->input->post('id_hitung');
		$id_kategori = $this->input->post('id_kategori');

		## id kategori terpilih
		$data_kategori_row = $this->m_global->single_row('*', ['id' => $id_kategori, 'deleted_at' => null], 'm_kategori');

		$id_kategori = $data_kategori_row->id;
		$step_kategori = $data_kategori_row->kode_kategori;

		## data kategori
		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');

		##cari himpunan 1 = 1
		$q_himpunan_sama = $this->m_global->single_row('*', ['is_sama_penting' => 1, 'deleted_at' =>null], 'm_himpunan');
		
		for ($i=1; $i <= count($kategori); $i++) {
			for ($z=1; $z <= $i; $z++) { 
				if($i == $z) {
					continue;
				}

				$step[$kategori[$z-1]->kode_kategori][] = [
					'kode'=>$kategori[$i-1]->kode_kategori, 
					'nama' => $kategori[$i-1]->nama,
					'id' => $kategori[$i-1]->id
				];
			}
		}

		$old_data = $this->m_global->multi_row('*', [
			'id_hitung' => $id_hitung,
			'kode_kategori' => $step_kategori, 
			'id_himpunan !=' => $q_himpunan_sama->id,
			'flag_proses_kode_kategori' => $step_kategori
		], 't_hitung_det', NULL, 'id');

		
		// echo "<pre>";
		// print_r ($step);
		// echo "</pre>";
		// exit;
		$this->db->trans_begin();
		
		if($old_data) {
			## delete
			$del = $this->m_global->delete(['id_hitung' => $id_hitung, 'flag_proses_id_kategori' => $id_kategori], 't_hitung_det');
		}

		## insert awalan misal ci -> ci, c2 -> c2 berdasarkan kriterianya
		$ins_awal = [
			'id' => $this->t_hitung_det->get_max_id(),
			'id_hitung' => $id_hitung,
			'id_kategori' => $id_kategori,
			'kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
			'id_himpunan' => $q_himpunan_sama->id,
			'id_kategori_tujuan' => $id_kategori,
			'kode_kategori_tujuan' => trim(strtoupper(strtolower($step_kategori))),
			'flag_proses_id_kategori' => $id_kategori,
			'flag_proses_kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
			'created_at' => $timestamp
		];
		
		$insert = $this->t_hitung_det->save($ins_awal);

		foreach ($step[$step_kategori] as $key => $value) {
			### insert
			$data_ins = [
				'id' => $this->t_hitung_det->get_max_id(),
				'id_hitung' => $id_hitung,
				'id_kategori' => $id_kategori,
				'kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
				'id_himpunan' => $this->input->post('himpunan')[$key],
				'id_kategori_tujuan' => $value['id'],
				'kode_kategori_tujuan' => $value['kode'],
				'flag_proses_id_kategori' => $id_kategori,
				'flag_proses_kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
				'created_at' => $timestamp
			];
			
			$insert = $this->t_hitung_det->save($data_ins);

			### insert reverse
			/**
			 * todo : 
			 * 1 .cari reversenya dulu berdasarkan himpunan terpilih 
			 * 2. jika ketemu gunakan reverse tersebut.
			 */

			$q_reverse = $this->m_global->single_row('*', ['id_himpunan_use' => $this->input->post('himpunan')[$key], 'deleted_at' =>null], 't_pasangan_himpunan');

			$data_reverse_ins = [
				'id' => $this->t_hitung_det->get_max_id(),
				'id_hitung' => $id_hitung,
				'id_kategori' => $value['id'],
				'kode_kategori' => $value['kode'],
				'id_himpunan' => $q_reverse->id_himpunan_reverse,
				'id_kategori_tujuan' => $id_kategori,
				'kode_kategori_tujuan' => trim(strtoupper(strtolower($step_kategori))),
				'flag_proses_id_kategori' => $id_kategori,
				'flag_proses_kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
				'created_at' => $timestamp
			];

			$insert = $this->t_hitung_det->save($data_reverse_ins);

			## insert awalan kategori+1 (1=1)
			$ins_awal_2 = [
				'id' => $this->t_hitung_det->get_max_id(),
				'id_hitung' => $id_hitung,
				'id_kategori' => $value['id'],
				'kode_kategori' => $value['kode'],
				'id_himpunan' => $q_himpunan_sama->id,
				'id_kategori_tujuan' => $value['id'],
				'kode_kategori_tujuan' => $value['kode'],
				'flag_proses_id_kategori' => $id_kategori,
				'flag_proses_kode_kategori' => trim(strtoupper(strtolower($step_kategori))),
				'created_at' => $timestamp
			];
			
			$insert = $this->t_hitung_det->save($ins_awal_2);
		}

		// ## hitung jumlah grand total l,m,u
		$data_tot_himpunan = $this->t_hitung_det->get_nilai_total_himpunan($id_hitung);
		
		$grand_total_lower = 0;
		$grand_total_medium = 0;
		$grand_total_upper = 0;

		foreach ($data_tot_himpunan as $kkk => $vvv) {
			$grand_total_lower += (float)$vvv->total_lower;
			$grand_total_medium += (float)$vvv->total_medium;
			$grand_total_upper += (float)$vvv->total_upper;
		}

		## update
		$data_upd = [
			'total_lower' => $grand_total_lower,
			'total_medium' => $grand_total_medium,
			'total_upper' => $grand_total_upper
		];

		
		// echo "<pre>";
		// print_r ($data_upd);
		// echo "</pre>";
		// exit;

		$upd = $this->m_global->update('t_hitung', $data_upd, ['id' => $id_hitung]);

		#########################################################################################################

		##cek exist sintesis data
		$arr_data_sintesis = $this->t_sintesis->get_by_condition(['id_hitung' => $id_hitung, 'deleted_at' => null]);
		
		if($arr_data_sintesis) {
			## delete
			$del_sintesis = $this->m_global->delete(['id_hitung' => $id_hitung, 'deleted_at' => null], 't_sintesis');
		}

		## hitung sintesis dan input data
		foreach ($kategori as $kk => $vv) {
			$data_sintesis = [
				'id' => $this->t_sintesis->get_max_id(),
				'id_hitung' => $id_hitung,
				'id_kategori' => $vv->id,
				'kode_kategori' => $vv->kode_kategori,
				'sintesis_lower' => (float)$data_tot_himpunan[$kk]->total_lower / (float)$grand_total_upper,
				'sintesis_medium' => (float)$data_tot_himpunan[$kk]->total_medium / (float)$grand_total_medium,
				'sintesis_upper' => (float)$data_tot_himpunan[$kk]->total_upper / (float)$grand_total_lower,
				'created_at' => $timestamp
			];

			$insert = $this->t_sintesis->save($data_sintesis);
			$collection_sintesis[] = $data_sintesis;
		}

		#########################################################################################################
		
		##cek exist vektor data
		$arr_data_vektor = $this->t_hitungan_vektor->get_by_condition(['id_hitung' => $id_hitung, 'deleted_at' => null]);
		
		if($arr_data_vektor) {
			## delete
			$del_vektor = $this->m_global->delete(['id_hitung' => $id_hitung, 'deleted_at' => null], 't_hitungan_vektor');
		}

		$data_vektor = $this->get_hitungan_vektor($collection_sintesis, $kategori);

		foreach ($data_vektor as $k_vtr => $v_vtr) {
			$data_ins_vektor = [
				'id_hitung' => $id_hitung,
				'id_kategori_proses' => $v_vtr['id_kategori_proses'],
				'kode_kategori_proses' => $v_vtr['kode_kategori_proses'],
				'id_kategori' => $v_vtr['id_kategori'],
				'kode_kategori' => $v_vtr['kode_kategori'],
				'nilai_l' => $v_vtr['l'],
				'nilai_m' => $v_vtr['m'],
				'nilai_u' => $v_vtr['u'],
				'bawah' => $v_vtr['bawah'],
				'total' => $v_vtr['total'],
				'hasil' => $v_vtr['hasil'],
				'created_at' => $timestamp
			];

			$insert = $this->t_hitungan_vektor->save($data_ins_vektor);
		}

		#########################################################################################################

		##cek exist normalisasi data
		$arr_data_norm = $this->t_normalisasi->get_by_condition(['id_hitung' => $id_hitung, 'deleted_at' => null]);
		
		if($arr_data_norm) {
			## delete
			$del_norm = $this->m_global->delete(['id_hitung' => $id_hitung, 'deleted_at' => null], 't_normalisasi');
		}

		$data_normalisasi = $this->get_hitungan_normalisasi($data_vektor, $kategori);

		foreach ($data_normalisasi as $k_nor => $v_nor) {
			$data_ins_norm = [
				'id_hitung' => $id_hitung,
				'id_kategori' => $v_nor['id_kategori'],
				'kode_kategori' => $v_nor['kode_kategori'],
				'id_kategori_tujuan' => $v_nor['id_kategori_tujuan'],
				'kode_kategori_tujuan' => $v_nor['kode_kategori_tujuan'],
				'nilai' => $v_nor['nilai'],
				'created_at' => $timestamp
			];

			$insert = $this->t_normalisasi->save($data_ins_norm);
		}


		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['id_hitung'] = $this->enkripsi->enc_dec('encrypt', $id_hitung);
			$retval['pesan'] = 'Proses Perhitungan Gagal';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['id_hitung'] = $this->enkripsi->enc_dec('encrypt', $id_hitung);
			$retval['pesan'] = 'Proses Perhitungan Sukses';
		}

		echo json_encode($retval);
	}

	public function get_hitungan_normalisasi($data_vektor, $kategori)
	{
		foreach ($kategori as $k_kat => $kat) {
			$kode_kat_proses = $kat->kode_kategori;
			$id_kat_proses = $kat->id;
			$flag_is_sama = false; // c1 == c1, c2 == c2, etc
			
			for ($i=0; $i <count($data_vektor); $i++) { 
				if($data_vektor[$i]['id_kategori_proses'] != $kat->id) {
					continue;
				}

				if($flag_is_sama) {
					$rs['nilai'] = $data_vektor[$i]['hasil'];
					$rs['id_kategori'] = $kat->id;
					$rs['kode_kategori'] = $kat->kode_kategori;
					$rs['id_kategori_tujuan'] = $data_vektor[$i]['id_kategori'];
					$rs['kode_kategori_tujuan'] =  $data_vektor[$i]['kode_kategori'];
				}else{
					if ($kat->id == $data_vektor[$i]['id_kategori_proses']) {
						// set 1 == 1
						$rs['nilai'] = 1.000;
						$rs['id_kategori'] = $kat->id;
						$rs['kode_kategori'] = $kat->kode_kategori;
						$rs['id_kategori_tujuan'] = $data_vektor[$i]['id_kategori_proses'];
						$rs['kode_kategori_tujuan'] =  $data_vektor[$i]['kode_kategori_proses'];
						//flag dan decrement
						$flag_is_sama = true;
						$i--;
					}else{
						$rs['nilai'] = $data_vektor[$i]['hasil'];
						$rs['id_kategori'] = $kat->id;
						$rs['kode_kategori'] = $kat->kode_kategori;
						$rs['id_kategori_tujuan'] = $data_vektor[$i]['id_kategori'];
						$rs['kode_kategori_tujuan'] =  $data_vektor[$i]['kode_kategori'];
					}
				}

				$retval[] = $rs;
			}
		}

		return $retval;
	}

	public function get_hitungan_vektor($data_sintesis, $kategori)
	{
		// $data_sintesis = $this->m_global->multi_row('*', ['id_hitung' => 1, 'deleted_at' => null], 't_sintesis', null, 'id');
		// $kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');
		
		foreach ($kategori as $k_kat => $kat) {
			$kode_kat_proses = $kat->kode_kategori;
			$id_kat_proses = $kat->id;

			foreach ($data_sintesis as $k_sin => $sin) {
				if ($kat->id == $sin['id_kategori']) {
					continue;
				}
				
				$data_l = (float)$sin['sintesis_lower'] - (float)$data_sintesis[$k_kat]['sintesis_upper'];
				$data_m = (float)$data_sintesis[$k_kat]['sintesis_medium'] - (float)$data_sintesis[$k_kat]['sintesis_upper'];
				$data_u = (float)$sin['sintesis_medium'] - (float)$sin['sintesis_lower'];
				$bawah = (float)$data_m - (float)$data_u;
				$total = (float)$data_l / $bawah;

				$rs['id_kategori_proses'] = $id_kat_proses;
				$rs['kode_kategori_proses'] = $kode_kat_proses;
				$rs['id_kategori'] = $sin['id_kategori'];
				$rs['kode_kategori'] = $sin['kode_kategori'];
				$rs['l'] = $data_l;
				$rs['m'] = $data_m;
				$rs['u'] = $data_u;
				$rs['bawah'] = $bawah;
				$rs['total'] = $total;

				if($total >= 1.000) {
					$rs['hasil'] = 1.000;
				}else{
					if($total < 0.000) {
						$rs['hasil'] = 0.000;
					}else{
						$rs['hasil'] = $total;
					}
					
				}
			
				$retval[] = $rs;
			}
		}

		return $retval;
	}

	public function delete_data()
	{
		$id_hitung = $this->input->post('id');
		## delete
		$del = $this->m_global->delete(['id' => $id_hitung, 'deleted_at' => null], 't_hitung');
		$del_det = $this->m_global->delete(['id_hitung' => $id_hitung, 'deleted_at' => null], 't_hitung_det');
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Perhitungan Telah dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Perhitungan Telah dihapus';
		}

		echo json_encode($retval);
	}

	///////////////////////////////////////////////////////////////////

	// ===============================================
	private function rule_validasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Wajib Memilih Nama';
            $data['status'] = FALSE;
		}

		if ($this->input->post('kategori') == '') {
			$data['inputerror'][] = 'kategori';
            $data['error_string'][] = 'Wajib Memilih Kategori';
            $data['status'] = FALSE;
		}

        return $data;
	}
	
}
