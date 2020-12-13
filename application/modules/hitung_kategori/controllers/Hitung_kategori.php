<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hitung_kategori extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_kriteria');
		$this->load->model('m_kategori');
		$this->load->model('t_hitung_kategori');
		$this->load->model('t_hitung_kategori_det');
		$this->load->model('t_sintesis');
		$this->load->model('m_global');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Formulir Perhitungan',
			'data_user' => $data_user
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_hitung_kategori',
			'js'	=> 'hitung_kategori.js',
			'view'	=> 'view_hitung_kategori'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_perhitungan($id)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$data_kategori = $this->m_global->single_row('*',['id' => $id], 'm_kategori');
		
		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'hk.id_kategori = k.id'],
			['table' => 'm_proyek as p', 'on' => 'hk.id_proyek = p.id']
		];

		$data_hitung = $this->m_global->multi_row(
			'hk.*, k.nama as nama_kategori, p.nama_proyek, p.tahun_proyek', ['hk.id_kategori' => $id, 'hk.deleted_at' => null], 't_hitung_kategori as hk', $join, 'hk.created_at desc');
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Data Perhitungan Kategori '.$data_kategori->nama,
			'data_user' => $data_user,
			'data_hitung' => $data_hitung,
			'data_kategori' => $data_kategori
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => null,
			'js'	=> 'hitung_kategori.js',
			'view'	=> 'view_list_hitung_kategori'
		];

		$this->template_view->load_view($content, $data);
		
	}

	public function formulir_proyek($id=false)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$id_kat = $keri = $this->input->get('kategori');
		$keri = $this->input->get('kriteria');
		$data_proyek = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_proyek', NULL, 'tahun_proyek desc');
		
		$kat = $this->m_kategori->get_by_condition(['id' => $id_kat, 'deleted_at' => null], true);
		if(!$kat) {
			return redirect('hitung_kategori/list_perhitungan/'.$id_kat);
		}

		$kriteria = $this->m_global->multi_row('*', ['id_kategori' => $kat->id, 'deleted_at' => null], 'm_kriteria', NULL, 'urut');

		#flag kriteria cocok
		$is_cocok_kriteria = false;

		foreach ($kriteria as $k => $v) {
			if($v->kode_kriteria == strtoupper(strtolower($keri))){
				$is_cocok_kriteria = true;
			}else{
				continue;
			}
		}

		if($is_cocok_kriteria == false) {
			return redirect('hitung_kategori/list_perhitungan/'.$id_kat);
		}

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Form Perhitungan AHP Kategori '.$kat->nama,
			'data_user' => $data_user,
			'kategori' => $kat,
			'kriteria' => $kriteria,
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
			'js'	=> 'hitung_kategori.js',
			'view'	=> 'view_form_hitung_proyek'
		];
		
		$this->template_view->load_view($content, $data);
	}

	public function formulir_hitung($id=false)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$id_kat = $keri = $this->input->get('kategori');
		$keri = $this->input->get('kriteria');
		
		$kat = $this->m_kategori->get_by_condition(['id' => $id_kat, 'deleted_at' => null], true);
		// var_dump($kat);exit;
		$data_himpunan = $this->m_global->multi_row('*', ['deleted_at' => null, 'is_sama_penting' => null], 'm_himpunan', NULL, 'id');

		if(!$kat) {
			return redirect('hitung_kategori/list_perhitungan/'.$id_kat);
		}
		
		//cari hipunan 1=1
		$q_himpunan_sama = $this->m_global->single_row('*', ['is_sama_penting' => 1, 'deleted_at' =>null], 'm_himpunan');
		
		## jika data baru (add data)
		if($id == false) {
			$old_data = [];
			$data_hitung = [];
		}else{
			$data_hitung = $this->m_global->single_row('t_hitung_kategori.*, m_proyek.nama_proyek', ['t_hitung_kategori.id' => $id, 't_hitung_kategori.deleted_at' =>null], 't_hitung_kategori', [['table' => 'm_proyek', 'on' => 't_hitung_kategori.id_proyek = m_proyek.id']]);

			if(!$data_hitung) {
				return redirect('hitung_kategori/list_perhitungan/'.$id_kat);
			}

			//cek di tabel child nya ada apa tidak
			$data_child  = $this->m_global->multi_row('*', ['id_hitung_kategori' => $id], 't_hitung_kategori_det');
			if($data_child) {
				## cari data lawas (edit) 
				$sel = 'hk_det.*, hk.id_kategori';
				$from = 't_hitung_kategori_det as hk_det';
				$join = [ 
					['table' => 't_hitung_kategori as hk', 'on' => 'hk_det.id_hitung_kategori = hk.id']
				];
				$where = [
					'hk_det.id_hitung_kategori' => $id,
					'hk.id_kategori' => $kat->id,
					'hk_det.id_himpunan !=' => $q_himpunan_sama->id,
					'hk_det.kode_kriteria' => $keri,
					'hk_det.flag_proses_kode_kriteria' => $keri
				];

				$old_data = $this->m_global->multi_row($sel, $where, $from, $join, 'hk_det.id');
				//echo $this->db->last_query();exit;
				
			}else{
				$old_data = [];
			}
		}


		$kriteria = $this->m_global->multi_row('*', ['id_kategori' => $kat->id, 'deleted_at' => null], 'm_kriteria', NULL, 'urut');

		#flag kriteria cocok
		$is_cocok_kriteria = false;

		foreach ($kriteria as $k => $v) {
			if($v->kode_kriteria == strtoupper(strtolower($keri))){
				$is_cocok_kriteria = true;
			}else{
				continue;
			}
		}

		if($is_cocok_kriteria == false) {
			return redirect('hitung_kategori/list_perhitungan/'.$id_kat);
		}
		
		for ($i=1; $i <= count($kriteria); $i++) { 
			for ($z=1; $z <= $i; $z++) { 
				if($i == $z) {
					continue;
				}
				$retval[$kriteria[$z-1]->kode_kriteria][] = ['kode'=>$kriteria[$i-1]->kode_kriteria, 'nama' => $kriteria[$i-1]->nama, 'id' => $kriteria[$i-1]->id];
			}
		}
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Perhitungan Kategori : '.$kat->nama.' ( Proyek '.$data_hitung->nama_proyek.' )',
			'data_user' => $data_user,
			'kategori' => $kat,
			'kriteria' => $kriteria,
			'step' => $retval,
			'data_himpunan' => $data_himpunan,
			'old_data' => $old_data
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
			'modal' => 'modal_hitung_kategori',
			'js'	=> 'hitung_kategori.js',
			'view'	=> 'view_form_hitung'
		];
		
		$this->template_view->load_view($content, $data);
	}

	public function next_step_proyek()
	{
		$id_user = $this->session->userdata('id_user'); 
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_kategori = $this->input->post('id_kategori');
		$step_kriteria = $this->input->post('step_kriteria');
		$id = $this->t_hitung_kategori->get_max_id();

		// ## id kriteria terpilih
		// $data_kriteria_row = $this->m_global->single_row('*', ['id_kategori' => $id_kategori, 'kode_kriteria' => $step_kriteria], 'm_kriteria');
		// $id_kriteria = $data_kriteria_row->id;

		// ## data kriteria
		// $kriteria = $this->m_global->multi_row('*', ['id_kategori' => $id_kategori, 'deleted_at' => null], 'm_kriteria', NULL, 'urut');

		if ($this->input->post('proyek') == '') {
			$data['inputerror'][] = 'proyek';
            $data['error_string'][] = 'Wajib Memilih proyek';
			$data['status'] = FALSE;
			echo json_encode($data);
			return;
		}
		
		$this->db->trans_begin();
		
		## insert awalan misal ci -> ci, c2 -> c2 berdasarkan kriterianya
		$data_insert = [
			'id' => $id,
			'id_kategori' => $id_kategori,
			'id_user' => $id_user,
			'created_at' => $timestamp,
			'id_proyek' => $this->input->post('proyek')
		];
		
		$insert = $this->t_hitung_kategori->save($data_insert);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['id_kategori'] = $id_kategori;
			$retval['id_hitung'] = $id;
			$retval['pesan'] = 'Proses Perhitungan Gagal';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['id_kategori'] = $id_kategori;
			$retval['id_hitung'] = $id;
			$retval['pesan'] = 'Proses Perhitungan Sukses';
		}

		echo json_encode($retval);
	}

	public function next_step()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_hitung = $this->input->post('id_hitung');
		$id_kategori = $this->input->post('id_kategori');
		$step_kriteria = $this->input->post('step_kriteria');

		## id kriteria terpilih
		$data_kriteria_row = $this->m_global->single_row('*', ['id_kategori' => $id_kategori, 'kode_kriteria' => $step_kriteria], 'm_kriteria');
		$id_kriteria = $data_kriteria_row->id;

		## data kriteria
		$kriteria = $this->m_global->multi_row('*', ['id_kategori' => $id_kategori, 'deleted_at' => null], 'm_kriteria', NULL, 'urut');

		##cari himpunan 1 = 1
		$q_himpunan_sama = $this->m_global->single_row('*', ['is_sama_penting' => 1, 'deleted_at' =>null], 'm_himpunan');
		
		for ($i=1; $i <= count($kriteria); $i++) { 
			for ($z=1; $z <= $i; $z++) { 
				if($i == $z) {
					continue;
				}

				$step[$kriteria[$z-1]->kode_kriteria][] = [
					'kode'=>$kriteria[$i-1]->kode_kriteria, 
					'nama' => $kriteria[$i-1]->nama,
					'id' => $kriteria[$i-1]->id
				];
			}
		}

		$old_data = $this->m_global->multi_row('*', [
			'id_hitung_kategori' => $id_hitung,
			'kode_kriteria' => $step_kriteria, 
			'id_himpunan !=' => $q_himpunan_sama->id,
			'flag_proses_kode_kriteria' => $step_kriteria
		], 't_hitung_kategori_det', NULL, 'id');

		//set flag first/last step
		$is_first_step = 'false';
		$is_last_step = 'false';

		## cari posisi step berapa sekarang
		$index_step = 0;
		foreach ($step as $kkk => $vvv) {
			$index_step += 1;
			if($kkk == $step_kriteria) {
				break;
			}
		}

		// var_dump($index_step);exit;
		$this->db->trans_begin();
		
		if($old_data) {
			## delete
			$del = $this->m_global->delete(['id_hitung_kategori' => $id_hitung, 'flag_proses_id_kriteria' => $id_kriteria], 't_hitung_kategori_det');
		}

		## insert awalan misal ci -> ci, c2 -> c2 berdasarkan kriterianya
		$ins_awal = [
			'id' => $this->t_hitung_kategori_det->get_max_id(),
			'id_hitung_kategori' => $id_hitung,
			'id_kriteria' => $id_kriteria,
			'kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
			'id_himpunan' => $q_himpunan_sama->id,
			'id_kriteria_tujuan' => $id_kriteria,
			'kode_kriteria_tujuan' => trim(strtoupper(strtolower($step_kriteria))),
			'flag_proses_id_kriteria' => $id_kriteria,
			'flag_proses_kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
			'created_at' => $timestamp
		];
		
		$insert = $this->t_hitung_kategori_det->save($ins_awal);

		foreach ($step[$step_kriteria] as $key => $value) {
			### insert
			$data_ins = [
				'id' => $this->t_hitung_kategori_det->get_max_id(),
				'id_hitung_kategori' => $id_hitung,
				'id_kriteria' => $id_kriteria,
				'kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
				'id_himpunan' => $this->input->post('himpunan')[$key],
				'id_kriteria_tujuan' => $value['id'],
				'kode_kriteria_tujuan' => $value['kode'],
				'flag_proses_id_kriteria' => $id_kriteria,
				'flag_proses_kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
				'created_at' => $timestamp
			];
			
			$insert = $this->t_hitung_kategori_det->save($data_ins);

			### insert reverse
			/**
			 * todo : 
			 * 1 .cari reversenya dulu berdasarkan himpunan terpilih 
			 * 2. jika ketemu gunakan reverse tersebut.
			 */

			$q_reverse = $this->m_global->single_row('*', ['id_himpunan_use' => $this->input->post('himpunan')[$key], 'deleted_at' =>null], 't_pasangan_himpunan');
			$data_reverse_ins = [
				'id' => $this->t_hitung_kategori_det->get_max_id(),
				'id_hitung_kategori' => $id_hitung,
				'id_kriteria' => $value['id'],
				'kode_kriteria' => $value['kode'],
				'id_himpunan' => $q_reverse->id_himpunan_reverse,
				'id_kriteria_tujuan' => $id_kriteria,
				'kode_kriteria_tujuan' => trim(strtoupper(strtolower($step_kriteria))),
				'flag_proses_id_kriteria' => $id_kriteria,
				'flag_proses_kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
				'created_at' => $timestamp
			];

			$insert = $this->t_hitung_kategori_det->save($data_reverse_ins);
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
			'id_hitung' => $id_hitung,
			'id_kategori' => $id_kategori,
			'index_step' => $index_step,
			'is_first_step' => $is_first_step,
			'is_last_step' => $is_last_step,
			'next_step' => $next_step,
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
		$step_kriteria = $this->input->post('step_kriteria');

		## id kriteria terpilih
		$data_kriteria_row = $this->m_global->single_row('*', ['id_kategori' => $id_kategori, 'kode_kriteria' => $step_kriteria], 'm_kriteria');
		$id_kriteria = $data_kriteria_row->id;

		## data kriteria
		$kriteria = $this->m_global->multi_row('*', ['id_kategori' => $id_kategori, 'deleted_at' => null], 'm_kriteria', NULL, 'urut');

		##cari himpunan 1 = 1
		$q_himpunan_sama = $this->m_global->single_row('*', ['is_sama_penting' => 1, 'deleted_at' =>null], 'm_himpunan');
		
		for ($i=1; $i <= count($kriteria); $i++) { 
			for ($z=1; $z <= $i; $z++) { 
				if($i == $z) {
					continue;
				}

				$step[$kriteria[$z-1]->kode_kriteria][] = [
					'kode'=>$kriteria[$i-1]->kode_kriteria, 
					'nama' => $kriteria[$i-1]->nama,
					'id' => $kriteria[$i-1]->id
				];
			}
		}

		$old_data = $this->m_global->multi_row('*', [
			'id_hitung_kategori' => $id_hitung,
			'kode_kriteria' => $step_kriteria, 
			'id_himpunan !=' => $q_himpunan_sama->id,
			'flag_proses_kode_kriteria' => $step_kriteria
		], 't_hitung_kategori_det', NULL, 'id');

		
		// echo "<pre>";
		// print_r ($step);
		// echo "</pre>";
		// exit;
		$this->db->trans_begin();
		
		if($old_data) {
			## delete
			$del = $this->m_global->delete(['id_hitung_kategori' => $id_hitung, 'flag_proses_id_kriteria' => $id_kriteria], 't_hitung_kategori_det');
		}

		## insert awalan misal ci -> ci, c2 -> c2 berdasarkan kriterianya
		$ins_awal = [
			'id' => $this->t_hitung_kategori_det->get_max_id(),
			'id_hitung_kategori' => $id_hitung,
			'id_kriteria' => $id_kriteria,
			'kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
			'id_himpunan' => $q_himpunan_sama->id,
			'id_kriteria_tujuan' => $id_kriteria,
			'kode_kriteria_tujuan' => trim(strtoupper(strtolower($step_kriteria))),
			'flag_proses_id_kriteria' => $id_kriteria,
			'flag_proses_kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
			'created_at' => $timestamp
		];
		
		$insert = $this->t_hitung_kategori_det->save($ins_awal);

		foreach ($step[$step_kriteria] as $key => $value) {
			### insert
			$data_ins = [
				'id' => $this->t_hitung_kategori_det->get_max_id(),
				'id_hitung_kategori' => $id_hitung,
				'id_kriteria' => $id_kriteria,
				'kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
				'id_himpunan' => $this->input->post('himpunan')[$key],
				'id_kriteria_tujuan' => $value['id'],
				'kode_kriteria_tujuan' => $value['kode'],
				'flag_proses_id_kriteria' => $id_kriteria,
				'flag_proses_kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
				'created_at' => $timestamp
			];
			
			$insert = $this->t_hitung_kategori_det->save($data_ins);

			### insert reverse
			/**
			 * todo : 
			 * 1 .cari reversenya dulu berdasarkan himpunan terpilih 
			 * 2. jika ketemu gunakan reverse tersebut.
			 */

			$q_reverse = $this->m_global->single_row('*', ['id_himpunan_use' => $this->input->post('himpunan')[$key], 'deleted_at' =>null], 't_pasangan_himpunan');
			$data_reverse_ins = [
				'id' => $this->t_hitung_kategori_det->get_max_id(),
				'id_hitung_kategori' => $id_hitung,
				'id_kriteria' => $value['id'],
				'kode_kriteria' => $value['kode'],
				'id_himpunan' => $q_reverse->id_himpunan_reverse,
				'id_kriteria_tujuan' => $id_kriteria,
				'kode_kriteria_tujuan' => trim(strtoupper(strtolower($step_kriteria))),
				'flag_proses_id_kriteria' => $id_kriteria,
				'flag_proses_kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
				'created_at' => $timestamp
			];

			$insert = $this->t_hitung_kategori_det->save($data_reverse_ins);

			## insert awalan kriteria+1 (1=1)
			$ins_awal_2 = [
				'id' => $this->t_hitung_kategori_det->get_max_id(),
				'id_hitung_kategori' => $id_hitung,
				'id_kriteria' => $value['id'],
				'kode_kriteria' => $value['kode'],
				'id_himpunan' => $q_himpunan_sama->id,
				'id_kriteria_tujuan' => $value['id'],
				'kode_kriteria_tujuan' => $value['kode'],
				'flag_proses_id_kriteria' => $id_kriteria,
				'flag_proses_kode_kriteria' => trim(strtoupper(strtolower($step_kriteria))),
				'created_at' => $timestamp
			];
			
			$insert = $this->t_hitung_kategori_det->save($ins_awal_2);
		}

		// ## hitung jumlah grand total l,m,u
		$data_tot_himpunan = $this->t_hitung_kategori_det->get_nilai_total_himpunan($id_hitung);
		
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

		$upd = $this->m_global->update('t_hitung_kategori', $data_upd, ['id' => $id_hitung]);

		##cek exist sintesis data
		$arr_data_sintesis = $this->t_sintesis->get_by_condition(['id_hitung_kategori' => $id_hitung, 'deleted_at' => null]);
		
		if($arr_data_sintesis) {
			## delete
			$del_sintesis = $this->m_global->delete(['id_hitung_kategori' => $id_hitung, 'deleted_at' => null], 't_sintesis');
		}

		## hitung sintesis dan input data
		foreach ($kriteria as $kk => $vv) {
			$data_sintesis = [
				'id' => $this->t_sintesis->get_max_id(),
				'id_hitung_kategori' => $id_hitung,
				'id_kriteria' => $vv->id,
				'kode_kriteria' => $vv->kode_kriteria,
				'sintesis_lower' => round((float)$data_tot_himpunan[$kk]->total_lower / (float)$grand_total_upper, 4),
				'sintesis_medium' => round((float)$data_tot_himpunan[$kk]->total_medium / (float)$grand_total_medium, 4),
				'sintesis_upper' => round((float)$data_tot_himpunan[$kk]->total_upper / (float)$grand_total_lower, 4),
				'created_at' => $timestamp
			];

			$insert = $this->t_sintesis->save($data_sintesis);
		}
		
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['id_kategori'] = $id_kategori;
			$retval['id_hitung'] = $id_hitung;
			$retval['pesan'] = 'Proses Perhitungan Gagal';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['id_kategori'] = $id_kategori;
			$retval['id_hitung'] = $id_hitung;
			$retval['pesan'] = 'Proses Perhitungan Sukses';
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
