<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_anggaran extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_kriteria');
		$this->load->model('m_kategori');
		$this->load->model('m_satuan');
		$this->load->model('t_anggaran');
		$this->load->model('t_anggaran_det');
		$this->load->model('t_bobot_proses');
		$this->load->model('m_global');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		
		$join = [ 
			['table' => 'm_proyek as p', 'on' => 'ta.id_proyek = p.id']
		];

		$data_anggaran = $this->m_global->multi_row(
			'ta.*, p.nama_proyek, p.tahun_proyek, p.tahun_akhir_proyek, p.durasi_tahun', ['ta.deleted_at' => null], 't_anggaran as ta', $join, 'ta.created_at desc');
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Data Aggaran Per Project',
			'data_user' => $data_user,
			'data_anggaran' => $data_anggaran
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
			'js'	=> 'form_anggaran.js',
			'view'	=> 'view_list_form_anggaran'
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
			'title' => 'Form Anggaran',
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
			'js'	=> 'form_anggaran.js',
			'view'	=> 'view_form_anggaran_proyek'
		];
		
		$this->template_view->load_view($content, $data);
	}

	public function next_step_proyek()
	{
		$id_user = $this->session->userdata('id_user'); 
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id = $this->t_anggaran->get_max_id();
		$kat = $this->m_global->single_row('*', ['deleted_at' =>null], 'm_kategori', null, 'urut');
		

		if ($this->input->post('proyek') == '') {
			$data['inputerror'][] = 'proyek';
            $data['error_string'][] = 'Wajib Memilih proyek';
			$data['status'] = FALSE;
			echo json_encode($data);
			return;
		}
		
		$proyek = $this->m_global->single_row('*', ['id' =>$this->input->post('proyek'), 'deleted_at' =>null], 'm_proyek', null);

		$this->db->trans_begin();
		
		## insert data header
		$data_insert = [
			'id' => $id,
			'id_user' => $id_user,
			'created_at' => $timestamp,
			'id_proyek' => $this->input->post('proyek')
		];
		
		$insert = $this->t_anggaran->save($data_insert);
		
		

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['id_anggaran'] = $this->enkripsi->enc_dec('encrypt', $id);
			$retval['tahun_proyek'] = $proyek->tahun_proyek;
			$retval['id_kategori'] = $this->enkripsi->enc_dec('encrypt', $kat->id);
			$retval['pesan'] = 'Proses Hitung Anggaran Gagal';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['id_anggaran'] = $this->enkripsi->enc_dec('encrypt', $id);
			$retval['tahun_proyek'] = $proyek->tahun_proyek;
			$retval['id_kategori'] = $this->enkripsi->enc_dec('encrypt', $kat->id);
			$retval['pesan'] = 'Proses Hitung Anggaran Sukses';
		}

		echo json_encode($retval);
	}

	public function formulir_anggaran($id=false)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$id_kat = $this->enkripsi->enc_dec('decrypt', $this->input->get('kategori'));
		$kat = $this->m_kategori->get_by_condition(['id' => $id_kat, 'deleted_at' => null], true);
		$kriteria = $this->m_kriteria->get_by_condition(['deleted_at' => null]);
		$tahun = $this->input->get('tahun');

		if(!$kat) {
			return redirect('form_anggaran');
		}

		## jika data baru (add data)
		if($id == false) {
			$old_data = [];
			$data_anggaran = [];
		}else{
			$id = $this->enkripsi->enc_dec('decrypt', $id);
			$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);
			// echo $this->db->last_query();
			// exit;
			if(!$data_anggaran) {
				return redirect('form_anggaran');
			}

			//cek di tabel child nya ada apa tidak
			$data_child  = $this->m_global->multi_row('*', ['id_anggaran' => $id], 't_anggaran_det');
			if($data_child) {
				## cari data lawas (edit) 
				$where = [
					'id_anggaran' => $id,
					'tahun' => $tahun
				];

				$join = [ 
					['table' => 'm_kriteria', 'on' => 't_anggaran_det.id_kriteria = m_kriteria.id']
				];

				$old_data = $this->m_global->multi_row('t_anggaran_det.*, m_kriteria.nama as nama_kriteria', $where, 't_anggaran_det', $join, 'urut');
				// echo $this->db->last_query();
				// exit;
				
			}else{
				$old_data = [];
			}
		}

		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');
		$satuan = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_satuan');
		
		// for ($i=1; $i <= count($kategori); $i++) { 
		// 	for ($z=1; $z <= $i; $z++) { 
		// 		if($i == $z) {
		// 			continue;
		// 		}
		// 		$retval[$kategori[$z-1]->kode_kategori][] = ['kode'=>$kategori[$i-1]->kode_kategori, 'nama' => $kategori[$i-1]->nama, 'id' => $kategori[$i-1]->id];
		// 	}
		// }
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Perhitungan Anggaran : ( Proyek '.$data_anggaran->nama_proyek.' )',
			'data_user' => $data_user,
			'kategori' => $kategori,
			'anggaran' => $data_anggaran,
			'kriteria' => $kriteria,
			'old_data' => $old_data,
			'satuan' => $satuan,
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
			'modal' => null,
			'js'	=> 'form_anggaran.js',
			'view'	=> 'view_form_anggaran'
		];
		
		$this->template_view->load_view($content, $data);
	}

	public function next_step()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_anggaran = $this->input->post('id_anggaran');
		$id_kategori = $this->input->post('id_kategori');
		$tahun_anggaran = $this->input->post('tahun_anggaran');

		$jumlah_form = count($this->input->post('f_qty')); 
		
		//loop filter yg ada value
		for ($i=0; $i < $jumlah_form; $i++) {
			if($this->input->post('f_qty')[$i] != '') {
				$arr_kolom[] = $i;
			}
		}

		// var_dump($arr_kolom);exit;
		
		$old_data = $this->m_global->multi_row('*', ['id_anggaran' => $id_anggaran,'tahun =' => $tahun_anggaran], 't_anggaran_det');
		
		$this->db->trans_begin();
		
		if($old_data) {
			## delete
			$del = $this->m_global->delete(['id_anggaran' => $id_anggaran, 'tahun' => $tahun_anggaran], 't_anggaran_det');
		}

		foreach ($arr_kolom as $key => $value) {
			### insert
			$data_ins = [
				'id' => $this->t_anggaran_det->get_max_id(),
				'id_anggaran' => $id_anggaran,
				'tahun' => $tahun_anggaran,
				'id_kategori' => $this->input->post('f_id_kategori')[$value],
				'kode_kategori' => $this->input->post('f_kode_kategori')[$value],
				'id_kriteria' => $this->input->post('f_id_kriteria')[$value],
				'urut' => $key+1,
				'id_satuan' => $this->input->post('f_satuan')[$value],
				'qty' => (float)$this->input->post('f_qtyraw')[$value],
				'harga_satuan' => (float)$this->input->post('f_hargaraw')[$value],
				'harga_total' => (float)$this->input->post('f_harga_totraw')[$value],
				'created_at' => $timestamp
			];

			$insert = $this->t_anggaran_det->save($data_ins);

			$kampes[] = $data_ins;
		}

		
		// echo "<pre>";
		// print_r ($kampes);
		// echo "</pre>";
		// exit;
		

		$data_step = [
			'id_anggaran' => $this->enkripsi->enc_dec('encrypt', $id_anggaran),
			'id_kategori' => $this->enkripsi->enc_dec('encrypt', $id_kategori),
			'tahun' => (int)$tahun_anggaran+1
		];

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['data_step'] = null;
			$retval['pesan'] = 'Gagal Pencatatan Anggaran';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['data_step'] = $data_step;
			$retval['pesan'] = 'Sukses Pencatatan Anggaran';
		}

		echo json_encode($retval);
	}

	public function finish_step()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_anggaran = $this->input->post('id_anggaran');
		$id_kategori = $this->input->post('id_kategori');
		$tahun_anggaran = $this->input->post('tahun_anggaran');

		$jumlah_form = count($this->input->post('f_qty')); 

		//loop filter yg ada value
		for ($i=0; $i < $jumlah_form; $i++) {
			if($this->input->post('f_qty')[$i] != '') {
				$arr_kolom[] = $i;
			}
		}

		$old_data = $this->m_global->multi_row('*', ['id_anggaran' => $id_anggaran,'tahun =' => $tahun_anggaran], 't_anggaran_det');

		$this->db->trans_begin();
		
		if($old_data) {
			## delete
			$del = $this->m_global->delete(['id_anggaran' => $id_anggaran, 'tahun' => $tahun_anggaran], 't_anggaran_det');
		}

		foreach ($arr_kolom as $key => $value) {
			### insert
			$data_ins = [
				'id' => $this->t_anggaran_det->get_max_id(),
				'id_anggaran' => $id_anggaran,
				'tahun' => $tahun_anggaran,
				'id_kategori' => $this->input->post('f_id_kategori')[$value],
				'kode_kategori' => $this->input->post('f_kode_kategori')[$value],
				'id_kriteria' => $this->input->post('f_id_kriteria')[$value],
				'urut' => $key+1,
				'id_satuan' => $this->input->post('f_satuan')[$value],
				'qty' => (float)$this->input->post('f_qtyraw')[$value],
				'harga_satuan' => (float)$this->input->post('f_hargaraw')[$value],
				'harga_total' => (float)$this->input->post('f_harga_totraw')[$value],
				'created_at' => $timestamp
			];

			$insert = $this->t_anggaran_det->save($data_ins);
			//$kampes[] = $data_ins;
		}

		
		## ambil data det, sum harga_total by kategori
		$total_harga_kat = $this->t_anggaran_det->ambil_data_tot_harga($id_anggaran, $tahun_anggaran);

		## update ke anggaran
		$json_data_anggaran = json_encode($total_harga_kat);
		$data_upd = ['data_json' => $json_data_anggaran];
		$upd = $this->m_global->update('t_anggaran', $data_upd, ['id' => $id_anggaran]);

		## insert/update ke tabel t_bobot_proses
		$old_data_bobot = $this->m_global->multi_row('*', ['id_anggaran' => $id_anggaran], 't_bobot_proses');
		if($old_data_bobot){
			## delete
			$del_bobot = $this->m_global->delete(['id_anggaran' => $id_anggaran], 't_bobot_proses');
		}

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);

		$data_json = json_decode($data_anggaran->data_json);
		$flag_tahun = $data_json[0]->tahun;
		$is_kolom_akhir = false;

		$idx = 0;
		foreach ($data_json as $k => $v) 
		{
			if($flag_tahun == $v->tahun) {
				$arr_anggaran[$idx]['tahun'] = $v->tahun;
				$arr_anggaran[$idx]['data'][] = $v->total;
			}else{
				$flag_tahun = $v->tahun;
				$arr_anggaran[++$idx]['data'][] = $v->total;
				$arr_anggaran[$idx]['tahun'] = $v->tahun;
			}	
		}

		## loop maneh ben enak ngitunge 
		$idx1 = 0;
		foreach ($arr_anggaran as $kk => $vv) {
			$loop_tahun[] = $vv['tahun'];
			
			for ($i=0; $i < count($vv['data']); $i++) { 
				${"c".($i+1)}[] = $vv['data'][$i];
			}			
		}

		// assign variabel
		$arr_anggaran_fix['tahun'] = $loop_tahun;
		for ($z=0; $z < count($vv['data']); $z++)
		{ 	
			$kolom_anggaran_fix = $z+1;
			$arr_anggaran_fix['C'.$kolom_anggaran_fix] = ${"c".$kolom_anggaran_fix};
		}
		### wes enak ngitunge

		$jml_kolom_tahun = count($arr_anggaran_fix['tahun']);

		## kolom pertama
		for ($y=0; $y < $kolom_anggaran_fix; $y++) { 
			for ($xxx=0; $xxx < $jml_kolom_tahun; $xxx++) { 
				$min = min($arr_anggaran_fix['C'.($y+1)]);
				$max = max($arr_anggaran_fix['C'.($y+1)]);
				$max_min = (float)$max-(float)$min;
				$nilai_awal = $max - $arr_anggaran_fix['C'.($y+1)][$xxx];
				
				$ins_bobot['id'] = $this->t_bobot_proses->get_max_id();
				$ins_bobot['id_anggaran'] = $id_anggaran;
				$ins_bobot['min'] = $min;
				$ins_bobot['max'] = $max;
				$ins_bobot['max_min'] = $max_min;
				$ins_bobot['nilai_awal'] = $nilai_awal;
				$ins_bobot['bobot'] = $nilai_awal/$max_min;
				$ins_bobot['tahun'] = $arr_anggaran_fix['tahun'][$xxx];
				$ins_bobot['kode'] = 'C'.($y+1);
				$ins_bobot['created_at'] = $timestamp;

				//$data_ins_bobot[] = $ins_bobot;
				$this->t_bobot_proses->save($ins_bobot);
			}
			
		}

		// echo "<pre>";
		// print_r ($data_ins_bobot);
		// echo "</pre>";
		// exit;

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['id_anggaran'] = $this->enkripsi->enc_dec('encrypt', $id_anggaran);
			$retval['pesan'] = 'Proses Pencatatan Anggaran Gagal';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['id_anggaran'] = $this->enkripsi->enc_dec('encrypt', $id_anggaran);
			$retval['pesan'] = 'Proses Pencatatan Anggaran Sukses';
		}

		echo json_encode($retval);
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$del = $this->m_global->delete(['id' => $id], 't_anggaran');
		$del_det = $this->m_global->delete(['id_anggaran' => $id], 't_anggaran_det');
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Perhitungan dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Perhitungan Gagal dihapus';
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
