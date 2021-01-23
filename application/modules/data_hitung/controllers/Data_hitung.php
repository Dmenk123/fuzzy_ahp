<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_hitung extends CI_Controller {
	
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
		$this->load->model('t_normalisasi');
		$this->load->model('t_anggaran');
		$this->load->model('t_anggaran_det');
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
			'title' => 'Hasil Data Perhitungan',
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
			'modal' => null,
			'js'	=> 'data_hitung.js',
			'view'	=> 'view_data_hitung'
		];

		$this->template_view->load_view($content, $data);
	}


	public function list_detail_data($menu_enc)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		$menu = $this->enkripsi->enc_dec('decrypt', $menu_enc);
		if($menu == 'ahp') {
			$table_html = $this->get_tabel_ahp();
		}elseif ($menu == 'sintesis') {
			$table_html = $this->get_tabel_sintesis();
		}elseif ($menu == 'vektor') {
			$table_html = $this->get_tabel_vektor();
		}elseif ($menu == 'tabel_anggaran') {
			$table_html = $this->get_tabel_anggaran();
		}elseif ($menu == 'hitung_anggaran') {
			$table_html = $this->get_hitung_anggaran();
		}elseif ($menu == 'perangkingan') {
			$table_html = $this->get_hitung_rangking();
		}else{
			return redirect('data_hitung');
		}
		
		$data = array(
			'title' => 'Hasil Data Perhitungan',
			'table_html' => $table_html,
			'data_user' => $data_user
		);

		$content = [
			'css' 	=> null,
			'modal' => null,
			'js'	=> 'data_hitung.js',
			'view'	=> 'view_list_data_hitung'
		];

		$this->template_view->load_view($content, $data);
	}

	########################## get tabel data group ###########################
	public function get_tabel_ahp()
	{
		$join = [ 
			['table' => 'm_proyek as p', 'on' => 'h.id_proyek = p.id']
		];

		$data_hitung = $this->m_global->multi_row('h.*, p.nama_proyek, p.tahun_proyek', ['h.deleted_at' => null], 't_hitung as h', $join, 'h.created_at desc');

		$html = "<table class='table table-striped- table-bordered table-hover table-checkable' id='tabel_data'>
			  	<thead>
					<tr>
						<th style='width: 5%;'>No</th>
						<th>Proyek</th>
						<th>Total lower</th>
						<th>Total Medium</th>
						<th>Total Upper</th>
						<th style='width: 5%;'>Aksi</th>
					</tr>
			  	</thead>
			  	<tbody>";
				foreach ($data_hitung as $k => $v) 
				{
					$html .= "<tr>
								<th>".++$k."</th>
								<th>".$v->nama_proyek." [".$v->tahun_proyek."]</th>
								<th>".number_format((float)$v->total_lower, 4)."</th>
								<th>".number_format((float)$v->total_medium, 4)."</th>
								<th>".number_format((float)$v->total_upper, 4)."</th>
								<th>
									<div class='btn-group'>
									<button type='button' class='btn btn-sm btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Opsi</button>
										<div class='dropdown-menu'>
											<a class='dropdown-item' target='_blank' href='".base_url('data_hitung/detail_perhitungan/').$this->enkripsi->enc_dec('encrypt', $v->id)."'>
												<i class='la la-bar-chart-o'></i> Lihat Data
											</a>
										</div>
									</div>
								</th>
							</tr>"; 
				}
		$html .= "</tbody></table>";
		
		$data = array(
			'title' => 'Data Perhitungan AHP',
			'html' => $html
		);

		return $data;
	}

	public function get_tabel_sintesis()
	{
		$data = $this->t_sintesis->get_data_transaksi_sintesis();
		$html = "<table class='table table-striped- table-bordered table-hover table-checkable' id='tabel_data'>
			  	<thead>
					<tr>
						<th style='width: 5%;'>No</th>
						<th>Proyek</th>
						<th style='width: 5%;'>Aksi</th>
					</tr>
			  	</thead>
			  	<tbody>";
				foreach ($data as $k => $v) 
				{
					$html .= "<tr>
								<th>".++$k."</th>
								<th>".$v->nama_proyek." [".$v->tahun_proyek."]</th>
								<th>
									<div class='btn-group'>
									<button type='button' class='btn btn-sm btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Opsi</button>
										<div class='dropdown-menu'>
											<a class='dropdown-item' target='_blank' href='".base_url('data_hitung/detail_sintesis/').$this->enkripsi->enc_dec('encrypt', $v->id_hitung)."'>
												<i class='la la-bar-chart-o'></i> Lihat Data
											</a>
										</div>
									</div>
								</th>
							</tr>"; 
				}
		$html .= "</tbody></table>";
		
		$data = array(
			'title' => 'Data Perhitungan Sintesis Dan Vektor',
			'html' => $html
		);

		return $data;
	}

	public function get_tabel_vektor()
	{
		$data = $this->t_normalisasi->get_data_transaksi_normalisasi();
		$html = "<table class='table table-striped- table-bordered table-hover table-checkable' id='tabel_data'>
			  	<thead>
					<tr>
						<th style='width: 5%;'>No</th>
						<th>Proyek</th>
						<th style='width: 5%;'>Aksi</th>
					</tr>
			  	</thead>
			  	<tbody>";
				foreach ($data as $k => $v) 
				{
					$html .= "<tr>
								<th>".++$k."</th>
								<th>".$v->nama_proyek." [".$v->tahun_proyek."]</th>
								<th>
									<div class='btn-group'>
									<button type='button' class='btn btn-sm btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Opsi</button>
										<div class='dropdown-menu'>
											<a class='dropdown-item' target='_blank' href='".base_url('data_hitung/detail_vektor/').$this->enkripsi->enc_dec('encrypt', $v->id_hitung)."'>
												<i class='la la-bar-chart-o'></i> Lihat Data
											</a>
										</div>
									</div>
								</th>
							</tr>"; 
				}
		$html .= "</tbody></table>";
		
		$data = array(
			'title' => 'Data Perhitungan Vektor Dan Normalisasi',
			'html' => $html
		);

		return $data;
	}

	public function get_tabel_anggaran()
	{
		$data = $this->t_anggaran->get_data_transaksi_anggaran();
		$html = "<table class='table table-striped- table-bordered table-hover table-checkable' id='tabel_data'>
			  	<thead>
					<tr>
						<th style='width: 5%;'>No</th>
						<th>Proyek</th>
						<th style='width: 5%;'>Aksi</th>
					</tr>
			  	</thead>
			  	<tbody>";
				foreach ($data as $k => $v) 
				{
					$html .= "<tr>
								<th>".++$k."</th>
								<th>".$v->nama_proyek." [".$v->tahun_proyek.' s/d '.$v->tahun_akhir_proyek."]</th>
								<th>
									<div class='btn-group'>
									<button type='button' class='btn btn-sm btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Opsi</button>
										<div class='dropdown-menu'>
											<a class='dropdown-item' target='_blank' href='".base_url('data_hitung/detail_tabel_anggaran/').$this->enkripsi->enc_dec('encrypt', $v->id)."?tahun=".$v->tahun_proyek."'>
												<i class='la la-bar-chart-o'></i> Lihat Data
											</a>
										</div>
									</div>
								</th>
							</tr>"; 
				}
		$html .= "</tbody></table>";
		
		$data = array(
			'title' => 'Daftar Proyek',
			'html' => $html
		);

		return $data;
	}

	public function get_hitung_anggaran()
	{
		$data = $this->t_anggaran->get_data_transaksi_anggaran();
		$html = "<table class='table table-striped- table-bordered table-hover table-checkable' id='tabel_data'>
			  	<thead>
					<tr>
						<th style='width: 5%;'>No</th>
						<th>Proyek</th>
						<th style='width: 5%;'>Aksi</th>
					</tr>
			  	</thead>
			  	<tbody>";
				foreach ($data as $k => $v) 
				{
					$html .= "<tr>
								<th>".++$k."</th>
								<th>".$v->nama_proyek." [".$v->tahun_proyek.' s/d '.$v->tahun_akhir_proyek."]</th>
								<th>
									<div class='btn-group'>
									<button type='button' class='btn btn-sm btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Opsi</button>
										<div class='dropdown-menu'>
											<a class='dropdown-item' target='_blank' href='".base_url('data_hitung/detail_hitung_anggaran/').$this->enkripsi->enc_dec('encrypt', $v->id)."?tahun=".$v->tahun_proyek."'>
												<i class='la la-bar-chart-o'></i> Lihat Data
											</a>
										</div>
									</div>
								</th>
							</tr>"; 
				}
		$html .= "</tbody></table>";
		
		$data = array(
			'title' => 'Daftar Proyek',
			'html' => $html
		);

		return $data;
	}

	public function get_hitung_rangking()
	{
		$data = $this->t_anggaran->get_data_transaksi_anggaran();
		$html = "<table class='table table-striped- table-bordered table-hover table-checkable' id='tabel_data'>
			  	<thead>
					<tr>
						<th style='width: 5%;'>No</th>
						<th>Proyek</th>
						<th style='width: 5%;'>Aksi</th>
					</tr>
			  	</thead>
			  	<tbody>";
				foreach ($data as $k => $v) 
				{
					$html .= "<tr>
								<th>".++$k."</th>
								<th>".$v->nama_proyek." [".$v->tahun_proyek.' s/d '.$v->tahun_akhir_proyek."]</th>
								<th>
									<div class='btn-group'>
									<button type='button' class='btn btn-sm btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Opsi</button>
										<div class='dropdown-menu'>
											<a class='dropdown-item' target='_blank' href='".base_url('data_hitung/detail_rangking/').$this->enkripsi->enc_dec('encrypt', $v->id)."?tahun=".$v->tahun_proyek."'>
												<i class='la la-bar-chart-o'></i> Lihat Data
											</a>
										</div>
									</div>
								</th>
							</tr>"; 
				}
		$html .= "</tbody></table>";
		
		$data = array(
			'title' => 'Daftar Proyek',
			'html' => $html
		);

		return $data;
	}
	########################## get tabel data group ###########################


	public function hasil_perhitungan($id)
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$kat = $this->m_kategori->get_by_condition(['id' => $id, 'deleted_at' => null], true);
		
		if(!$kat) {
			return redirect('data_hitung');
		}

		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'hk.id_kategori = k.id'],
			['table' => 'm_proyek as p', 'on' => 'hk.id_proyek = p.id']
		];

		$data_hitung = $this->m_global->multi_row(
			'hk.*, k.nama as nama_kategori, p.nama_proyek, p.tahun_proyek', ['hk.id_kategori' => $id, 'hk.deleted_at' => null], 't_hitung as hk', $join, 'hk.created_at desc');

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Hasil Perhitungan Kategori',
			'data_user' => $data_user,
			'kategori' => $kat,
			'data_hitung' => $data_hitung,
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
			'js'	=> 'data_hitung.js',
			'view'	=> 'view_hasil_hitung'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail_perhitungan($id_hitung = false)
	{
		$obj_date = new DateTime();
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);

		$data_himpunan_hitung = $this->t_hitung_det->get_data_himpunan_hitung($id_hitung);

		if(!$data_himpunan_hitung) {
			return redirect('data_hitung');
		}

		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');		
		$data_tot_himpunan = $this->t_hitung_det->get_nilai_total_himpunan($id_hitung);
		$data_hitung = $this->t_hitung->get_by_id($id_hitung);
		$arr_data_sintesis = $this->t_sintesis->get_by_condition(['id_hitung' => $id_hitung, 'deleted_at' => null]);

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Detail Perhitungan',
			'data_user' => $data_user,
			'data_himpunan_hitung' => $data_himpunan_hitung,
			'data_tot_himpunan' => $data_tot_himpunan,
			'data_hitung' => $data_hitung,
			'kategori' => $kategori,
			'arr_data_sintesis' => $arr_data_sintesis
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
			'css' 	=> null,
			'modal' => null,
			'js'	=> 'data_hitung.js',
			'view'	=> 'view_detail_hitung'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail_sintesis($id_hitung)
	{
		$obj_date = new DateTime();
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'hv.id_kategori_proses = k.id']
		];

		$data = $this->m_global->multi_row('hv.*, k.nama as nama_kategori', ['hv.id_hitung' => $id_hitung, 'hv.deleted_at' => null], 't_hitungan_vektor hv', $join, 'hv.id_kategori_proses asc, hv.kode_kategori asc');

		if(!$data) {
			return redirect('data_hitung');
		}

		$arr_data_sintesis = $this->t_sintesis->get_by_condition(['id_hitung' => $id_hitung, 'deleted_at' => null]);
	
		if(!$arr_data_sintesis) {
			return redirect('data_hitung');
		}

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Detail Perhitungan Sintesis',
			'data_sintesis' => $arr_data_sintesis,
			'data_user' => $data_user,
			'data' => $data
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
			'js'	=> 'data_hitung.js',
			'view'	=> 'view_detail_sintesis'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail_vektor($id_hitung)
	{
		$obj_date = new DateTime();
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'tn.id_kategori = k.id']
		];

		$data = $this->m_global->multi_row('tn.*, k.nama as nama_kategori', ['tn.id_hitung' => $id_hitung, 'tn.deleted_at' => null], 't_normalisasi tn', $join, 'tn.id_kategori asc, tn.kode_kategori_tujuan asc');
		

		if(!$data) {
			return redirect('data_hitung');
		}

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Detail Perhitungan Normalisasi',
			'data_user' => $data_user,
			'data' => $data
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
			'js'	=> 'data_hitung.js',
			'view'	=> 'view_detail_normalisasi'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail_tabel_anggaran($id_anggaran)
	{
		$obj_date = new DateTime();
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);
	
		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		//cek di tabel child nya ada apa tidak
		$data_child  = $this->m_global->multi_row('*', ['id_anggaran' => $id_anggaran], 't_anggaran_det');
		
		$tahun = $this->input->get('tahun');
			
		if($tahun == "") {
			$tahun =  $data_anggaran->tahun_proyek;
		}

		if($data_child) {
			## cari data lawas (edit) 
			$where = [
				'id_anggaran' => $id_anggaran,
				'tahun' => $tahun
			];

			$join = [ 
				['table' => 'm_kriteria', 'on' => 't_anggaran_det.id_kriteria = m_kriteria.id'],
				['table' => 'm_satuan', 'on' => 't_anggaran_det.id_satuan = m_satuan.id'],
			];

			$old_data = $this->m_global->multi_row('t_anggaran_det.*, m_kriteria.nama as nama_kriteria, m_satuan.nama as nama_satuan', $where, 't_anggaran_det', $join, 'urut');
			// echo $this->db->last_query();
			// exit;
			
		}

		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');

		$data = array(
			'title' => 'Detail Tabel Anggaran : ( Proyek '.$data_anggaran->nama_proyek.' )',
			'data_user' => $data_user,
			'kategori' => $kategori,
			'data_anggaran' => $data_anggaran,
			'data' => $old_data,
			'tahun' => $tahun
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
			'js'	=> 'data_hitung.js',
			'view'	=> 'view_detail_tabel_anggaran'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail_hitung_anggaran($id_anggaran)
	{
		$obj_date = new DateTime();
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);
	
		if(!$data_anggaran) {
			return redirect('data_hitung');
		}
		

		$data_json = json_decode($data_anggaran->data_json);

		$tahun = $this->input->get('tahun');
			
		if($tahun == "") {
			$tahun =  $data_anggaran->tahun_proyek;
		}

		
		// $join = [ 
		// 	['table' => 'm_kriteria', 'on' => 't_anggaran_det.id_kriteria = m_kriteria.id'],
		// 	['table' => 'm_satuan', 'on' => 't_anggaran_det.id_satuan = m_satuan.id'],
		// ];

		$data_bobot = $this->m_global->multi_row('t_bobot_proses.*', ['id_anggaran' => $id_anggaran], 't_bobot_proses', null, 'kode asc, tahun asc');

		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');

		$data = array(
			'title' => 'Detail Pehitungan Anggaran : ( Proyek '.$data_anggaran->nama_proyek.' )',
			'data_user' => $data_user,
			'kategori' => $kategori,
			'data_anggaran' => $data_anggaran,
			'data_bobot' => $data_bobot,
			'tahun' => $tahun,
			'data' => $data_json
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
			'css' 	=> null,
			'modal' => null,
			'js'	=> 'data_hitung.js',
			'view'	=> 'view_detail_hitung_anggaran'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail_rangking($id_anggaran)
	{
		$obj_date = new DateTime();
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);
	
		if(!$data_anggaran) {
			return redirect('data_hitung');
		}
		
		$data_json = json_decode($data_anggaran->data_json);

		$tahun = $this->input->get('tahun');
			
		if($tahun == "") {
			$tahun =  $data_anggaran->tahun_proyek;
		}

		$data_bobot = $this->m_global->multi_row('t_bobot_proses.*', ['id_anggaran' => $id_anggaran], 't_bobot_proses', null, 'kode asc, tahun asc');

		## hitung bobot per kategori dan simpan ke array
		$kode_bobot = '';
		$counter_kolom = 0;
		$arr_tahun = [];
		foreach ($data_bobot as $kkk => $vvv) {
			if($vvv->kode != $kode_bobot){
				$counter_kolom++;
			}

			$kode_bobot = $vvv->kode;
		}

		// assign kolom tahun
		foreach ($data_bobot as $kkk => $vvv) {
			if (!in_array($vvv->tahun, $arr_tahun)){
			  array_push($arr_tahun, $vvv->tahun);
			}
		}

		for ($z=0; $z < count($arr_tahun); $z++) {
			$arr_bbt = [];
			foreach ($data_bobot as $k => $v) {
				if($arr_tahun[$z] == $v->tahun) {
					$arr_bbt[] = $v->bobot;
				}
			}

			$arr_bobot[] = $arr_bbt;
		}

		$kode_bobot = $data_bobot[0]->kode; 
		$jumlah_bobot = 0;
		$arr_bbt = [];

		foreach ($data_bobot as $k => $v) {

			if($kode_bobot == $v->kode) {
				$jumlah_bobot += $v->bobot;
			}else{
				$arr_bbt[] = $jumlah_bobot;

				//reset
				$jumlah_bobot = 0;
				//assign bobot
				$jumlah_bobot += $v->bobot;
			}

			$kode_bobot = $v->kode;
		}
		// tambahan kolom 
		$arr_bbt[] = $jumlah_bobot;
		//assign ke array bobot
		$arr_bobot[] = $arr_bbt;

		#### ambil data hitung 
		$data_hitung = $this->m_global->single_row('*', ['id_proyek' => $data_anggaran->id_proyek, 'deleted_at' => null], 't_hitung');
		
		#### data normalisasi_ahp
		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'tn.id_kategori = k.id']
		];
		
		$normalisasi_ahp = $this->m_global->multi_row('tn.*, k.nama as nama_kategori', ['tn.id_hitung' => $data_hitung->id, 'tn.deleted_at' => null], 't_normalisasi tn', $join, 'tn.id_kategori asc, tn.kode_kategori_tujuan asc');

		## cari data fuzzy simpan ke array
		$fuzzy = [];
		foreach ($normalisasi_ahp as $kkk => $vvv) { 
			if($vvv->kode_kategori_tujuan == 'C1') {
				$fuzzy[] = $vvv->nilai;
			}
		}
		
		$data = array(
			'title' => 'Normalisasi Bobot & Perangkingan : ( Proyek '.$data_anggaran->nama_proyek.' )',
			'data_user' => $data_user,
			'data_anggaran' => $data_anggaran,
			'data_bobot' => $data_bobot,
			'hasil_bobot' => $arr_bobot,
			'tahun' => $tahun,
			'data' => $data_json,
			'fuzzy' => $fuzzy
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
			'js'	=> 'data_hitung.js',
			'view'	=> 'view_detail_rangking'
		];

		$this->template_view->load_view($content, $data);
	}

	///////////////////////// excel pdf
	public function download_excel_ahp($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		$data_himpunan_hitung = $this->t_hitung_det->get_data_himpunan_hitung($id_hitung);
		$data_hitung = $this->t_hitung->get_by_id($id_hitung);

		if(!$data_himpunan_hitung) {
			return redirect('data_hitung');
		}
		
		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');	
		$data_tot_himpunan = $this->t_hitung_det->get_nilai_total_himpunan($id_hitung);

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();

		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA100')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);
		
		$sheet = $spreadsheet->getActiveSheet();
		
		//set cell A1
		$sheet->getCell('A1')->setValue('');		
		
		$idx = 1;
		foreach ($kategori as $k => $v) {
			$cellAwal = $this->angka_ke_huruf($idx);
			$cellAkhir = $this->angka_ke_huruf($idx+2);

			$spreadsheet->setActiveSheetIndex(0)->mergeCells($cellAwal.'1:'.$cellAkhir.'1');
			$sheet->getCell($cellAwal.'1')->setValue($v->nama.' '.$v->kode_kategori);
			
			$idx += 3;
		}
		
		//merging by kategori
		$cellAwal = $this->angka_ke_huruf($idx);
		$cellAkhir = $this->angka_ke_huruf($idx+2);
		$spreadsheet->setActiveSheetIndex(0)->mergeCells($cellAwal.'1:'.$cellAkhir.'1');
		$sheet->getCell($cellAwal.'1')->setValue('Total');

		//set cell A2
		$sheet->getCell('A2')->setValue('');

		$idx = 1;
		foreach ($kategori as $kk => $vv) {
			$cellnya = $this->angka_ke_huruf($idx);
			$sheet->setCellValue($cellnya.'2', 'l');

			$cellnya = $this->angka_ke_huruf($idx+1);
			$sheet->setCellValue($cellnya.'2', 'm');

			$cellnya = $this->angka_ke_huruf($idx+2);
			$sheet->setCellValue($cellnya.'2', 'u');

			$idx += 3;
		}

		//kolom total
		$cellnya = $this->angka_ke_huruf($idx);
		$sheet->setCellValue($cellnya.'2', 'l');

		$cellnya = $this->angka_ke_huruf($idx+1);
		$sheet->setCellValue($cellnya.'2', 'm');

		$cellnya = $this->angka_ke_huruf($idx+2);
		$sheet->setCellValue($cellnya.'2', 'u');
		
		$startRow = 3;
		$row = $startRow;
		$idx_tbl = 0;
		//$counter_kolom = 0;

		foreach ($kategori as $kkk => $vvv) {
			
			//$counter_kolom = 0;
			foreach ($data_himpunan_hitung as $key => $val) {
				if($val->kode_kategori == $vvv->kode_kategori) {
					//$yoyok[] = $val->kode_kategori;
					//$yahya[] = $vvv->kode_kategori;
					if($idx_tbl == 0){
						$cellnya = $this->angka_ke_huruf($idx_tbl);
						$sheet->setCellValue($cellnya.''.($row+$kkk), $vvv->kode_kategori);
					
						//$counter_kolom++;
						$idx_tbl += 1;
					}

					if(number_format((float)$val->lower_val, 4) == '1.0000' && number_format((float)$val->medium_val, 4) == '1.0000' && number_format((float)$val->upper_val, 4) == '1.0000'){
						## color red
						$cellnya = $this->angka_ke_huruf($idx_tbl);
						$sheet->getStyle($cellnya.''.($row+$kkk))->getNumberFormat()->setFormatCode('0.0000');
						$sheet->getStyle($cellnya.''.($row+$kkk))->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
						$sheet->setCellValue($cellnya.''.($row+$kkk), number_format((float)$val->lower_val, 4));

						$cellnya = $this->angka_ke_huruf($idx_tbl+1);
						$sheet->getStyle($cellnya.''.($row+$kkk))->getNumberFormat()->setFormatCode('0.0000');
						$sheet->getStyle($cellnya.''.($row+$kkk))->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
						$sheet->setCellValue($cellnya.''.($row+$kkk), number_format((float)$val->medium_val, 4));

						$cellnya = $this->angka_ke_huruf($idx_tbl+2);
						$sheet->getStyle($cellnya.''.($row+$kkk))->getNumberFormat()->setFormatCode('0.0000');
						$sheet->getStyle($cellnya.''.($row+$kkk))->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
						$sheet->setCellValue($cellnya.''.($row+$kkk), number_format((float)$val->upper_val, 4));

						}else{
						$cellnya = $this->angka_ke_huruf($idx_tbl);
						$sheet->getStyle($cellnya.''.($row+$kkk))->getNumberFormat()->setFormatCode('0.0000');
						$sheet->setCellValue($cellnya.''.($row+$kkk), number_format((float)$val->lower_val, 4));

						$cellnya = $this->angka_ke_huruf($idx_tbl+1);
						$sheet->getStyle($cellnya.''.($row+$kkk))->getNumberFormat()->setFormatCode('0.0000');
						$sheet->setCellValue($cellnya.''.($row+$kkk), number_format((float)$val->medium_val, 4));

						$cellnya = $this->angka_ke_huruf($idx_tbl+2);
						$sheet->getStyle($cellnya.''.($row+$kkk))->getNumberFormat()->setFormatCode('0.0000');
						$sheet->setCellValue($cellnya.''.($row+$kkk), number_format((float)$val->upper_val, 4));
					}

					//$yahya[] = $row;
			
					## increment biar ga kenek kondisi
					$idx_tbl += 3;
					continue;
				}
				## reset
				$idx_tbl = 0;
			}
			
			//total
			$cellnya = $this->angka_ke_huruf((count($kategori)*3)+1);
			$sheet->getStyle($cellnya.''.($row+$kkk))->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.($row+$kkk), number_format((float)$data_tot_himpunan[$kkk]->total_lower, 4));
			
			//total
			$cellnya = $this->angka_ke_huruf((count($kategori)*3)+2);
			$sheet->getStyle($cellnya.''.($row+$kkk))->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.($row+$kkk), number_format((float)$data_tot_himpunan[$kkk]->total_medium, 4));

			//total
			$cellnya = $this->angka_ke_huruf((count($kategori)*3)+3);
			$sheet->getStyle($cellnya.''.($row+$kkk))->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.($row+$kkk), number_format((float)$data_tot_himpunan[$kkk]->total_upper, 4));
		}

		//grand total merge
		$cellAkhir = $this->angka_ke_huruf((count($kategori)*3));
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A'.(count($kategori)+3).':'.$cellAkhir.''.(count($kategori)+3));
		$sheet->getCell('A'.(count($kategori)+3))->setValue('Grand Total');

		//grand total value
		//total
		$cellnya = $this->angka_ke_huruf((count($kategori)*3)+1);
		$sheet->getStyle($cellnya.''.(count($kategori)+3))->getNumberFormat()->setFormatCode('0.0000');
		$sheet->setCellValue($cellnya.''.(count($kategori)+3), number_format((float)$data_hitung->total_lower, 4));
		
		//total
		$cellnya = $this->angka_ke_huruf((count($kategori)*3)+2);
		$sheet->getStyle($cellnya.''.(count($kategori)+3))->getNumberFormat()->setFormatCode('0.0000');
		$sheet->setCellValue($cellnya.''.(count($kategori)+3), number_format((float)$data_hitung->total_medium, 4));

		//total
		$cellnya = $this->angka_ke_huruf((count($kategori)*3)+3);
		$sheet->getStyle($cellnya.''.(count($kategori)+3))->getNumberFormat()->setFormatCode('0.0000');
		$sheet->setCellValue($cellnya.''.(count($kategori)+3), number_format((float)$data_hitung->total_upper, 4));
		
		
		$filename = 'tabel-ahp'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		
	}

	public function download_excel_sintesis($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		$arr_data_sintesis = $this->t_sintesis->get_by_condition(['id_hitung' => $id_hitung, 'deleted_at' => null]);
	
		if(!$arr_data_sintesis) {
			return redirect('data_hitung');
		}
		
		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();

		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA100')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);
		
		$sheet = $spreadsheet->getActiveSheet();
		
		//set cell A1
		$sheet->getCell('A1')->setValue('');
		$sheet->getCell('B1')->setValue('l');
		$sheet->getCell('C1')->setValue('m');
		$sheet->getCell('D1')->setValue('u');		

		$startRow = 2;
		$row = $startRow;
		$idx_tbl = 0;
		//$counter_kolom = 0;

		foreach ($arr_data_sintesis as $k => $v) {

			$cellnya = $this->angka_ke_huruf($idx_tbl);
			$sheet->getCell($cellnya.''.$row)->setValue($v->kode_kategori);
			
			$cellnya = $this->angka_ke_huruf($idx_tbl+1);
			$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.$row, number_format((float)$v->sintesis_lower, 4));

			$cellnya = $this->angka_ke_huruf($idx_tbl+2);
			$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.$row, number_format((float)$v->sintesis_medium, 4));

			$cellnya = $this->angka_ke_huruf($idx_tbl+3);
			$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.$row, number_format((float)$v->sintesis_upper, 4));

			$row++;
		}	
		
		$filename = 'tabel-sintesis'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		
	}

	public function download_excel_hitung_vektor($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);

		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'hv.id_kategori_proses = k.id']
		];

		$data = $this->m_global->multi_row('hv.*, k.nama as nama_kategori', ['hv.id_hitung' => $id_hitung, 'hv.deleted_at' => null], 't_hitungan_vektor hv', $join, 'hv.id_kategori_proses asc, hv.kode_kategori asc');

		if(!$data) {
			return redirect('data_hitung');
		}

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();

		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA100')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);
		
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:E1');
		$sheet->getCell('A1')->setValue('');

		$sheet->getCell('F1')->setValue('Bawah');
		$sheet->getCell('G1')->setValue('Total');
		$sheet->getCell('h1')->setValue('');	

		$startRow = 2;
		$row = $startRow;
		$idx_tbl = 0;
		$flag_kode_kat = 'XXX'; 
		foreach ($data as $k => $v) {
			if($v->kode_kategori_proses != $flag_kode_kat) {
				$flag_kode_kat = $v->kode_kategori_proses;
				$cellnya = $this->angka_ke_huruf($idx_tbl);
				$sheet->getCell($cellnya.''.$row)->setValue($v->kode_kategori_proses);
			}else{
				$cellnya = $this->angka_ke_huruf($idx_tbl);
				$sheet->getCell($cellnya.''.$row)->setValue('');
			}

			$cellnya = $this->angka_ke_huruf($idx_tbl+1);
			$sheet->getCell($cellnya.''.$row)->setValue($v->kode_kategori);

			$cellnya = $this->angka_ke_huruf($idx_tbl+2);
			$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.$row, number_format((float)$v->nilai_l, 4));

			$cellnya = $this->angka_ke_huruf($idx_tbl+3);
			$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.$row, number_format((float)$v->nilai_m, 4));

			$cellnya = $this->angka_ke_huruf($idx_tbl+4);
			$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.$row, number_format((float)$v->nilai_u, 4));

			$cellnya = $this->angka_ke_huruf($idx_tbl+5);
			$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.$row, number_format((float)$v->bawah, 4));

			$cellnya = $this->angka_ke_huruf($idx_tbl+6);
			$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.0000');
			$sheet->setCellValue($cellnya.''.$row, number_format((float)$v->hasil, 4));

			$row++;
		}

		$filename = 'tabel-proses-vektor'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');

	}

	public function download_excel_vektor($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		
		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'tn.id_kategori = k.id']
		];

		$data = $this->m_global->multi_row('tn.*, k.nama as nama_kategori', ['tn.id_hitung' => $id_hitung, 'tn.deleted_at' => null], 't_normalisasi tn', $join, 'tn.id_kategori asc, tn.kode_kategori_tujuan asc');

		$data_kat = $this->db->from('m_kategori')->where(['deleted_at' => null])->order_by('urut', 'ASC')->get()->result();

		if(!$data) {
			return redirect('data_hitung');
		}
		
		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();

		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA100')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);
		
		$sheet = $spreadsheet->getActiveSheet();

		//set cell A1
		$sheet->getCell('A1')->setValue('');
		
		foreach ($data_kat as $key => $value) {
			$cellnya = $this->angka_ke_huruf($key+1);
			$sheet->getCell($cellnya.'1')->setValue($value->nama.' '.$value->kode_kategori);
		}

		$startRow = 2;
		$row = $startRow;
		$idx_tbl = 0;
		$total_min = 0;
		foreach ($data_kat as $kk => $vv) {

			foreach ($data as $keys => $val) {
				if($val->kode_kategori == $vv->kode_kategori) {
					if($idx_tbl == 0){
						$cellnya = $this->angka_ke_huruf($idx_tbl);
						$sheet->getCell($cellnya.''.$row)->setValue($val->kode_kategori);
						$idx_tbl++;
					}

					if($val->kode_kategori_tujuan == $vv->kode_kategori){
						## color red
						$cellnya = $this->angka_ke_huruf($idx_tbl);
						$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.0000');
						$sheet->getStyle($cellnya.''.$row)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
						$sheet->setCellValue($cellnya.''.$row, number_format((float)$val->nilai, 4));
					}else{
						$cellnya = $this->angka_ke_huruf($idx_tbl);
						$sheet->getStyle($cellnya.''.($row))->getNumberFormat()->setFormatCode('0.0000');
						$sheet->setCellValue($cellnya.''.($row), number_format((float)$val->nilai, 4));
					}

					if($val->kode_kategori_tujuan == 'C1') {
						$total_min += number_format((float)$val->nilai, 4);
					}

					## increment biar ga kenek kondisi
                    $idx_tbl++;
                    continue;
				}

				## reset
				$idx_tbl = 0;
			}

			$row++;
		}

		$filename = 'tabel-vektor'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function download_excel_fuzzy($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		
		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'tn.id_kategori = k.id']
		];

		$data = $this->m_global->multi_row('tn.*, k.nama as nama_kategori', ['tn.id_hitung' => $id_hitung, 'tn.deleted_at' => null], 't_normalisasi tn', $join, 'tn.id_kategori asc, tn.kode_kategori_tujuan asc');

		$data_kat = $this->db->from('m_kategori')->where(['deleted_at' => null])->order_by('urut', 'ASC')->get()->result();

		if(!$data) {
			return redirect('data_hitung');
		}

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();

		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA100')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);
		
		$sheet = $spreadsheet->getActiveSheet();
		
		//set cell A1
		$sheet->getCell('A1')->setValue('');
		$sheet->getCell('B1')->setValue('DEFUZZIFIKASI');
		$sheet->getCell('C1')->setValue('W=NORMALISASI');

		$total_min = 0;
		foreach ($data_kat as $kk => $vv) {
			foreach ($data as $key => $val) {
				if($val->kode_kategori == $vv->kode_kategori) {
				 	if($val->kode_kategori_tujuan == 'C1') {
						$total_min += number_format((float)$val->nilai, 4);
					}
				  
				  	continue;
				}
			}
		}

		$startRow = 2;
		$row = $startRow;
		$idx_tbl = 0;

		foreach ($data as $kkk => $vvv) {
			if($vvv->kode_kategori_tujuan == 'C1') {
				if($kkk == 0) {
					$spreadsheet->setActiveSheetIndex(0)->mergeCells('A'.$row.':A'.(count($data_kat)+1));
					$sheet->getCell('A'.$row)->setValue('MIN');
				}

				$cellnya = $this->angka_ke_huruf($idx_tbl+1);
				$sheet->getStyle($cellnya.''.($row))->getNumberFormat()->setFormatCode('0.0000');
				$sheet->setCellValue($cellnya.''.($row), number_format((float)$vvv->nilai, 4));

				$cellnya = $this->angka_ke_huruf($idx_tbl+2);
				$sheet->getStyle($cellnya.''.($row))->getNumberFormat()->setFormatCode('0.0000');
				$sheet->setCellValue($cellnya.''.($row), number_format((float)$vvv->nilai/(float)$total_min, 4));

				$row++;
			}
		} 

		$filename = 'tabel-fuzzy'.time();
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function download_excel_anggaran($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);
	
		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');

		$arr_thn = [];

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();

		for ($i=(int)$data_anggaran->tahun_proyek; $i <= (int)$data_anggaran->tahun_akhir_proyek; $i++) 
		{ 
			//cek di tabel child nya ada apa tidak
			$data_child  = $this->m_global->multi_row('*', ['id_anggaran' => $id_anggaran], 't_anggaran_det');
			
			$tahun = $i;
			
			if($data_child) {
				## cari data lawas (edit) 
				$where = [
					'id_anggaran' => $id_anggaran,
					'tahun' => $tahun
				];
	
				$join = [ 
					['table' => 'm_kriteria', 'on' => 't_anggaran_det.id_kriteria = m_kriteria.id'],
					['table' => 'm_satuan', 'on' => 't_anggaran_det.id_satuan = m_satuan.id'],
				];
	
				$data = $this->m_global->multi_row('t_anggaran_det.*, m_kriteria.nama as nama_kriteria, m_satuan.nama as nama_satuan', $where, 't_anggaran_det', $join, 'urut');
				// echo $this->db->last_query();
				// exit;

				// Zero based, so set the second tab as active sheet
				$spreadsheet->setActiveSheetIndex($i - (int)$data_anggaran->tahun_proyek);
				
				## setelah sheet index di set, fungsi getActiveSheet akan sesuai index
				$spreadsheet
					->getActiveSheet()
					->getStyle('A1:AA100')
					->getNumberFormat()
					->setFormatCode($number_format_obj::FORMAT_TEXT);

				$sheet = $spreadsheet->getActiveSheet();
				
				$startRow = 1;
				$row = $startRow;
				$idx_tbl = 0;
				$no = 1;
		
				foreach ($kategori as $k => $v) {
					
					$grand_total_kat = 0;
					
					$sheet->getCell('A'.$row)->setValue('#');
					$sheet->getCell('B'.$row)->setValue('Kategori');
					$sheet->getCell('C'.$row)->setValue('Uraian');
					$sheet->getCell('D'.$row)->setValue('Satuan');
					$sheet->getCell('E'.$row)->setValue('Qty');
					$sheet->getCell('F'.$row)->setValue('Harga Satuan');
					$sheet->getCell('G'.$row)->setValue('Harga Total');
					// increment
					$row++;

					foreach ($data as $kk => $vv) {
						$kat_ini = $data[$kk]->id_kategori;

						if(count($data)-1 == $kk) {
							$kat_next = $data[$kk]->id_kategori;
						}else{
							$kat_next = $data[$kk+1]->id_kategori;
						}

						if($kat_ini != $kat_next) {
							$is_kolom_total = true;
						}else{
							if(count($data)-1 == $kk) {
							  $is_kolom_total = true;
							}else{
							  $is_kolom_total = false;
							}
						}
						
						if($v->id == $vv->id_kategori) {
							$grand_total_kat += $vv->harga_total;

							$cellnya = $this->angka_ke_huruf($idx_tbl);
							$sheet->getCell($cellnya . '' . $row)->setValue($no++);
							$aa[] = $vv;

							$cellnya = $this->angka_ke_huruf($idx_tbl + 1);
							$sheet->getCell($cellnya . '' . $row)->setValue($v->nama);

							$cellnya = $this->angka_ke_huruf($idx_tbl + 2);
							$sheet->getCell($cellnya . '' . $row)->setValue($vv->nama_kriteria);

							$cellnya = $this->angka_ke_huruf($idx_tbl + 3);
							$sheet->getCell($cellnya . '' . $row)->setValue($vv->nama_satuan);

							$cellnya = $this->angka_ke_huruf($idx_tbl + 4);
							$sheet->getStyle($cellnya . '' . $row)->getNumberFormat()->setFormatCode('0.00');
							$sheet->setCellValue($cellnya . '' . $row, number_format((float)$vv->qty, 2, ',', '.'));

							$cellnya = $this->angka_ke_huruf($idx_tbl + 5);
							$sheet->getStyle($cellnya . '' . $row)->getNumberFormat()->setFormatCode('0.00');
							$sheet->setCellValue($cellnya . '' . $row, number_format((float)$vv->harga_satuan, 2, ',', '.'));

							$cellnya = $this->angka_ke_huruf($idx_tbl + 6);
							$sheet->getStyle($cellnya . '' . $row)->getNumberFormat()->setFormatCode('0.00');
							$sheet->setCellValue($cellnya . '' . $row, number_format((float)$vv->harga_total, 2, ',', '.'));							
							
							// increment
							$row++;

							if($is_kolom_total) {
								//merging
								$spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
								$sheet->getCell('A'.$row)->setValue('Total');

								$cellnya = $this->angka_ke_huruf($idx_tbl+6);
								$sheet->getStyle($cellnya.''.$row)->getNumberFormat()->setFormatCode('0.00');
								$sheet->setCellValue($cellnya.''.$row, number_format((float)$grand_total_kat, 2,',','.'));
								
								// increment
								$row++;
							}
						}
					}
				}

				$spreadsheet->getActiveSheet()->setTitle('Tahun ' . $i);
				$spreadsheet->createSheet();				
			}
		} // end looping tahun

		$filename = 'tabel-data-anggaran' . time();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function download_excel_total_anggaran($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);
	
		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$data_json = json_decode($data_anggaran->data_json);
		$tahun =  $data_anggaran->tahun_proyek;

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();
						
		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA100')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);

		$sheet = $spreadsheet->getActiveSheet();
		
		$startRow = 1;
		$row = $startRow;
		$idx_tbl = 0;
		$no = 1;
		$jumlah_kolom = (count($data_json) / 2);
		$grand_total_thn = 0;
		
		$sheet->getCell('A'.$row)->setValue('#');
		$sheet->getCell('B'.$row)->setValue('Tahun');
		$idx_tbl = 2;
		for ($i=0; $i < $jumlah_kolom; $i++) { 
			$cellnya = $this->angka_ke_huruf($idx_tbl);
			$sheet->getCell($cellnya . '' . $row)->setValue($data_json[$i]->kode_kategori);
			$idx_tbl++;
		}

		$cellnya = $this->angka_ke_huruf($idx_tbl);
		$sheet->getCell($cellnya . '' . $row)->setValue('Total');
		// reset index
		$idx_tabel = 0;
		//increment row
		$row++;
		//set flag
		$flag_tahun = $tahun;
		$is_kolom_akhir = false;

		$sheet->getCell('A'.$row)->setValue('A'.$no++);
		$sheet->getCell('B'.$row)->setValue($tahun);	
		$idx_tbl = 2;
		foreach ($data_json as $kk => $vv) {
			if($flag_tahun == $vv->tahun) {
				### cek apakah kolom terakhir. untuk kolom grand total
				if($kk == (count($data_json)-1)){
					$is_kolom_akhir = true;
				}else{
					## jika tahun loop == tahun+1 loop
					if($vv->tahun == $data_json[$kk+1]->tahun){
						$is_kolom_akhir = false;
					}else{
						$is_kolom_akhir = true;
					}
				}

				$grand_total_thn += $vv->total;
				
				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$vv->total, 2,',','.'));

				if($is_kolom_akhir == true) {
					$cellnya = $this->angka_ke_huruf($idx_tbl++);
					$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$grand_total_thn, 2,',','.'));
				}
			}else{
				$idx_tbl = 0;
				$row++;
				$flag_tahun = $vv->tahun;
				$grand_total_thn = 0;
				
				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue('A'.$no++);

				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue($vv->tahun);

				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$vv->total, 2,',','.'));
			}
		}

		$filename = 'total-anggaran' . time();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function download_excel_hitung_bobot($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);
	
		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$data_json = json_decode($data_anggaran->data_json);
		$data_bobot = $this->m_global->multi_row('t_bobot_proses.*', ['id_anggaran' => $id_anggaran], 't_bobot_proses', null, 'kode asc, tahun asc');
		$tahun =  $data_anggaran->tahun_proyek;

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();
						
		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA100')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);

		$sheet = $spreadsheet->getActiveSheet();
		
		$startRow = 1;
		$row = $startRow;
		$idx_tbl = 0;
		$no = 1;

		$is_first_header = true;
		$flag_kode = '';
		$flag_tahun = $data_bobot[0]->tahun;

		foreach ($data_bobot as $k => $v) {
			if($flag_kode != $v->kode) {
				if($is_first_header == false) {
					$spreadsheet->setActiveSheetIndex(0)->mergeCells('A'.$row.':E'.$row);
					$sheet->getCell('A'.$row)->setValue('');
					$row++;
				}

				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue($v->kode);

				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue('MAX');

				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue('MIN');

				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue('MAX-MIN');

				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue('BOBOT (W)');
				
				//reset index
				$idx_tbl = 0;
				$row++;
			}	

			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue($v->nilai_awal);

			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue($v->max);

			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue($v->min);

			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue($v->max_min);

			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$v->bobot, 10,',','.'));

			//reset index
			$idx_tbl = 0;
			$row++;
			$flag_kode = $v->kode;
			$is_first_header = false; 
		}

		$filename = 'proses_perhitungan_bobot' . time();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function download_excel_hasil_bobot($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);
	
		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$data_json = json_decode($data_anggaran->data_json);
		$data_bobot = $this->m_global->multi_row('t_bobot_proses.*', ['id_anggaran' => $id_anggaran], 't_bobot_proses', null, 'kode asc, tahun asc');
		$tahun =  $data_anggaran->tahun_proyek;

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();
						
		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA100')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);

		$sheet = $spreadsheet->getActiveSheet();
		
		$startRow = 1;
		$row = $startRow;
		$idx_tbl = 0;
		$no = 1;
		$counter_kolom = 0;
		$kode_bobot = '';
		$arr_tahun = [];

		foreach ($data_bobot as $kkk => $vvv) {
			if($vvv->kode != $kode_bobot){
				$counter_kolom++;
			}

			$kode_bobot = $vvv->kode;
		}

		// assign kolom tahun
		foreach ($data_bobot as $kkk => $vvv) {
			if (!in_array($vvv->tahun, $arr_tahun)){
			  array_push($arr_tahun, $vvv->tahun);
			}
		}

		$cellnya = $this->angka_ke_huruf($idx_tbl++);
		$sheet->getCell($cellnya . '' . $row)->setValue('#');

		for ($i=1; $i <= $counter_kolom; $i++) { 
			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue('C'.$i);
		}

		$row++;
		$idx_tbl = 0;

		for ($z=0; $z < count($arr_tahun); $z++) {
			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue('A'.($z+1));

			foreach ($data_bobot as $k => $v) {
				if($arr_tahun[$z] == $v->tahun) {
					$cellnya = $this->angka_ke_huruf($idx_tbl++);
					$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$v->bobot, 4,',','.'));
				}
			}

			$row++;
			$idx_tbl = 0;
		}

		$cellnya = $this->angka_ke_huruf($idx_tbl++);
		$sheet->getCell($cellnya . '' . $row)->setValue('JUMLAH');

		$kode_bobot = $data_bobot[0]->kode; 
		$jumlah_bobot = 0;
		foreach ($data_bobot as $k => $v) {
			if($kode_bobot == $v->kode) {
				$jumlah_bobot += $v->bobot;
			}else{
				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$jumlah_bobot, 4,',','.'));
				
				//reset
				$jumlah_bobot = 0;
				//assign bobot
				$jumlah_bobot += $v->bobot;
			}

			$kode_bobot = $v->kode;
		}

		// tambahan kolom 
		$cellnya = $this->angka_ke_huruf($idx_tbl++);
		$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$jumlah_bobot, 4,',','.'));
		
		$filename = 'proses_hasil_bobot' . time();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function download_excel_hasil_rangking($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);
	
		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$data_json = json_decode($data_anggaran->data_json);
		$data_bobot = $this->m_global->multi_row('t_bobot_proses.*', ['id_anggaran' => $id_anggaran], 't_bobot_proses', null, 'kode asc, tahun asc');
		$tahun =  $data_anggaran->tahun_proyek;

		$spreadsheet = $this->excel->spreadsheet_obj();
		$writer = $this->excel->xlsx_obj($spreadsheet);
		$number_format_obj = $this->excel->number_format_obj();
		
		## hitung bobot per kategori dan simpan ke array
		$kode_bobot = '';
		$counter_kolom = 0;
		$arr_tahun = [];
		foreach ($data_bobot as $kkk => $vvv) {
			if($vvv->kode != $kode_bobot){
				$counter_kolom++;
			}

			$kode_bobot = $vvv->kode;
		}

		// assign kolom tahun
		foreach ($data_bobot as $kkk => $vvv) {
			if (!in_array($vvv->tahun, $arr_tahun)){
			  array_push($arr_tahun, $vvv->tahun);
			}
		}

		for ($z=0; $z < count($arr_tahun); $z++) {
			$arr_bbt = [];
			foreach ($data_bobot as $k => $v) {
				if($arr_tahun[$z] == $v->tahun) {
					$arr_bbt[] = $v->bobot;
				}
			}

			$arr_bobot[] = $arr_bbt;
		}

		$kode_bobot = $data_bobot[0]->kode; 
		$jumlah_bobot = 0;
		$arr_bbt = [];

		foreach ($data_bobot as $k => $v) {

			if($kode_bobot == $v->kode) {
				$jumlah_bobot += $v->bobot;
			}else{
				$arr_bbt[] = $jumlah_bobot;

				//reset
				$jumlah_bobot = 0;
				//assign bobot
				$jumlah_bobot += $v->bobot;
			}

			$kode_bobot = $v->kode;
		}
		// tambahan kolom 
		$arr_bbt[] = $jumlah_bobot;
		//assign ke array bobot
		$arr_bobot[] = $arr_bbt;

		#### ambil data hitung 
		$data_hitung = $this->m_global->single_row('*', ['id_proyek' => $data_anggaran->id_proyek, 'deleted_at' => null], 't_hitung');
		
		#### data normalisasi_ahp
		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'tn.id_kategori = k.id']
		];
		
		$normalisasi_ahp = $this->m_global->multi_row('tn.*, k.nama as nama_kategori', ['tn.id_hitung' => $data_hitung->id, 'tn.deleted_at' => null], 't_normalisasi tn', $join, 'tn.id_kategori asc, tn.kode_kategori_tujuan asc');

		## cari data fuzzy simpan ke array
		$fuzzy = [];
		foreach ($normalisasi_ahp as $kkk => $vvv) { 
			if($vvv->kode_kategori_tujuan == 'C1') {
				$fuzzy[] = $vvv->nilai;
			}
		}

		$spreadsheet
			->getActiveSheet()
			->getStyle('A1:AA100')
			->getNumberFormat()
			->setFormatCode($number_format_obj::FORMAT_TEXT);

		$sheet = $spreadsheet->getActiveSheet();
		
		$startRow = 1;
		$row = $startRow;
		$idx_tbl = 0;
		$no = 1;
		$counter_kolom = 0;
		$arr_tahun = [];
		$arr_kode = [];
		$kode_bobot = '';
		

		##############################################################
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A'.$row.':H'.$row);
		$sheet->getCell('A'.$row++)->setValue('Tabel Normalisasi');
		$idx_tbl = 0;
		##############################################################

		$cellnya = $this->angka_ke_huruf($idx_tbl++);
		$sheet->getCell($cellnya . '' . $row)->setValue('#');
		
		## hapus duplicate array
		foreach ($data_bobot as $kk => $vv) {
			$arr_kode[] = $vv->kode;
		}
		$arr_kode = array_unique($arr_kode);
		## end hapus duplicate array

		foreach ($arr_kode as $key => $value) {  
			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue($value);
		}
		
		$row++;
		$idx_tbl = 0;
		$flag_tahun = $tahun;
		$arr_total = [];
		
		for ($i=0; $i < count($arr_bobot)-1; $i++) {
			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue($no++);

			for ($z=0; $z < count($arr_bobot[$i]); $z++) { 
				$arr_total[$i][$z] = (float)$arr_bobot[$i][$z] / $arr_bobot[count($arr_bobot)-1][$z]; 

				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$arr_bobot[$i][$z] / $arr_bobot[count($arr_bobot)-1][$z], 4,',','.'));
			}

			$row++;
			$idx_tbl = 0;
		}

		$final_total_array = [];
		foreach ($arr_total as $kkk => $vvv) {
			foreach ($vvv as $id => $value) {
			  //$final_total_array[$id] += $value;
			  array_key_exists( $id, $final_total_array ) ? $final_total_array[$id] += $value : $final_total_array[$id] = $value;
			}
		}

		$cellnya = $this->angka_ke_huruf($idx_tbl++);
		$sheet->getCell($cellnya . '' . $row)->setValue('Jumlah');

		foreach ($final_total_array as $kkkk => $vvvv) {
			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$vvvv, 4,',','.'));
		}

		$row++;

		##############################################################
		$sheet->getCell('A'.$row++)->setValue('');
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A'.$row.':H'.$row);
		$sheet->getCell('A'.$row)->setValue('Proses Perhitungan Rangking');
		##############################################################
		
		$row++;
		$idx_tbl = 0;
		$kode_bobot = '';
		$no = 1;
		
		$cellnya = $this->angka_ke_huruf($idx_tbl++);
		$sheet->getCell($cellnya . '' . $row)->setValue('#');
		
		foreach ($arr_kode as $key => $value) {  
			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue($value);
		}

		$row++;
		$idx_tbl = 0;
		foreach ($fuzzy as $k => $v) {
			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$v, 4,',','.'));
		}

		$row++;
		$idx_tbl = 0;
		for ($i=0; $i < count($arr_bobot)-1; $i++) { 
			
			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue($no++);

			for ($z=0; $z < count($arr_bobot[$i]); $z++) {
				$cellnya = $this->angka_ke_huruf($idx_tbl++);
				$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$arr_bobot[$i][$z] / $arr_bobot[count($arr_bobot)-1][$z], 4,',','.'));
			}

			$row++;
			$idx_tbl = 0;
		}

		##############################################################
		$sheet->getCell('A'.$row++)->setValue('');
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A'.$row.':H'.$row);
		$sheet->getCell('A'.$row)->setValue('Hasil Rangking');
		##############################################################

		$row++;
		$idx_tbl = 0;
		$kode_bobot = '';
		$no = 1;
		
		$sheet->getCell('A' . $row)->setValue('#');
		$sheet->getCell('B' . $row)->setValue('TOTAL SKOR');
		$sheet->getCell('C' . $row)->setValue('RANGKING');
		$row++;
		
		for ($i=0; $i < count($arr_bobot)-1; $i++) { 
			// assign array rangking untuk di sorting
			$skor_raw = 0;
			for ($z=0; $z < count($arr_bobot[$i]); $z++) {
				$skor_raw += (((float)$arr_bobot[$i][$z] / $arr_bobot[count($arr_bobot)-1][$z]) * $fuzzy[$z]);
			}

			$arr_skor[] = $skor_raw;
		}

		//sorting
		asort($arr_skor);
		// buat array, pakai value sebagai key untuk mencari rangking
		$nomor = 1;
		foreach ($arr_skor as $key => $value) {
		  $arr_rangking[number_format((float)$value, 4,',','.')] = $nomor++;
		}

		for ($i=0; $i < count($arr_bobot)-1; $i++) { 
			$skor = 0;

			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue('A'.$no++);

			for ($z=0; $z < count($arr_bobot[$i]); $z++) {
				$skor += (((float)$arr_bobot[$i][$z] / $arr_bobot[count($arr_bobot)-1][$z]) * $fuzzy[$z]);
			}

			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue(number_format((float)$skor, 4,',','.'));

			$cellnya = $this->angka_ke_huruf($idx_tbl++);
			$sheet->getCell($cellnya . '' . $row)->setValue($arr_rangking[number_format((float)$skor, 4,',','.')]);

			$row++;
			$idx_tbl = 0;
		}

		$filename = 'proses_hasil_rangking' . time();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	########################################################

	public function cetak_data_ahp($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		$data_himpunan_hitung = $this->t_hitung_det->get_data_himpunan_hitung($id_hitung);
		$data_hitung = $this->t_hitung->get_by_id($id_hitung);

		if(!$data_himpunan_hitung) {
			return redirect('data_hitung');
		}
		
		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');	
		$data_tot_himpunan = $this->t_hitung_det->get_nilai_total_himpunan($id_hitung);

		$retval = [
			'data_tot_himpunan' => $data_tot_himpunan,
			'kategori' => $kategori,
			'data_hitung' => $data_hitung,
			'data_himpunan_hitung' => $data_himpunan_hitung,
			'title' => 'Perhitungan AHP'
		];
		
		$this->load->view('view_pdf_ahp', $retval);
		$html = $this->load->view('view_pdf_ahp', $retval, true);
	    $filename = 'tabel-ahp-'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'landscape');
	}

	public function cetak_data_sintesis($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		$arr_data_sintesis = $this->t_sintesis->get_by_condition(['id_hitung' => $id_hitung, 'deleted_at' => null]);

		if(!$arr_data_sintesis) {
			return redirect('data_hitung');
		}

		$retval = [
			'arr_data_sintesis' => $arr_data_sintesis,
			'title' => 'Perhitungan Sintesis'
		];
		
		$this->load->view('view_pdf_sintesis', $retval);
		$html = $this->load->view('view_pdf_sintesis', $retval, true);
	    $filename = 'tabel-sintesis-'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'landscape');
	}

	public function cetak_data_hitung_vektor($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'hv.id_kategori_proses = k.id']
		];

		$data = $this->m_global->multi_row('hv.*, k.nama as nama_kategori', ['hv.id_hitung' => $id_hitung, 'hv.deleted_at' => null], 't_hitungan_vektor hv', $join, 'hv.id_kategori_proses asc, hv.kode_kategori asc');

		if(!$data) {
			return redirect('data_hitung');
		}

		$retval = [
			'data' => $data,
			'title' => 'Proses Perhitungan Vektor'
		];
		
		$this->load->view('view_pdf_hitung_vektor', $retval);
		$html = $this->load->view('view_pdf_hitung_vektor', $retval, true);
	    $filename = 'tabel-hitung-vektor-'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'landscape');
	}

	public function cetak_data_vektor($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'tn.id_kategori = k.id']
		];

		$data = $this->m_global->multi_row('tn.*, k.nama as nama_kategori', ['tn.id_hitung' => $id_hitung, 'tn.deleted_at' => null], 't_normalisasi tn', $join, 'tn.id_kategori asc, tn.kode_kategori_tujuan asc');

		$data_kat = $this->db->from('m_kategori')->where(['deleted_at' => null])->order_by('urut', 'ASC')->get()->result();

		if(!$data) {
			return redirect('data_hitung');
		}

		$retval = [
			'data' => $data,
			'data_kat' => $data_kat,
			'title' => 'Data Vektor'
		];
		
		$this->load->view('view_pdf_vektor', $retval);
		$html = $this->load->view('view_pdf_vektor', $retval, true);
	    $filename = 'tabel-hitung-vektor-'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'landscape');
	}

	public function cetak_data_fuzzy($id_hitung = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
				
		if($id_hitung == false) {
			return redirect('data_hitung');
		}

		$id_hitung = $this->enkripsi->enc_dec('decrypt', $id_hitung);
		
		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'tn.id_kategori = k.id']
		];

		$data = $this->m_global->multi_row('tn.*, k.nama as nama_kategori', ['tn.id_hitung' => $id_hitung, 'tn.deleted_at' => null], 't_normalisasi tn', $join, 'tn.id_kategori asc, tn.kode_kategori_tujuan asc');

		$data_kat = $this->db->from('m_kategori')->where(['deleted_at' => null])->order_by('urut', 'ASC')->get()->result();

		$total_min = 0;
		foreach ($data_kat as $kk => $vv) {
			foreach ($data as $key => $val) {
				if($val->kode_kategori == $vv->kode_kategori) {
				 	if($val->kode_kategori_tujuan == 'C1') {
						$total_min += number_format((float)$val->nilai, 4);
					}
				  
				  	continue;
				}
			}
		}

		if(!$data) {
			return redirect('data_hitung');
		}

		$retval = [
			'data' => $data,
			'data_kat' => $data_kat,
			'total_min' => $total_min,
			'title' => 'Data Defuzzifikasi'
		];
		
		$this->load->view('view_pdf_fuzzy', $retval);
		$html = $this->load->view('view_pdf_fuzzy', $retval, true);
	    $filename = 'tabel-defuzzifikasi-'.time();
	    $this->lib_dompdf->generate($html, $filename, true, 'A4', 'landscape');
	}

	public function cetak_data_anggaran($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		
		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);

		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$kategori = $this->m_global->multi_row('*', ['deleted_at' => null], 'm_kategori', NULL, 'urut');
		$html = '';
		for ($i=(int)$data_anggaran->tahun_proyek; $i <= (int)$data_anggaran->tahun_akhir_proyek; $i++) 
		{
			//cek di tabel child nya ada apa tidak
			$data_child  = $this->m_global->multi_row('*', ['id_anggaran' => $id_anggaran], 't_anggaran_det');
			
			$tahun = $i;
			if($data_child) {
				## cari data lawas (edit) 
				$where = [
					'id_anggaran' => $id_anggaran,
					'tahun' => $tahun
				];

				$join = [ 
					['table' => 'm_kriteria', 'on' => 't_anggaran_det.id_kriteria = m_kriteria.id'],
					['table' => 'm_satuan', 'on' => 't_anggaran_det.id_satuan = m_satuan.id'],
				];
	
				$data = $this->m_global->multi_row('t_anggaran_det.*, m_kriteria.nama as nama_kriteria, m_satuan.nama as nama_satuan, m_satuan.kode as kode_satuan', $where, 't_anggaran_det', $join, 'urut');
			}

			$retval = [
				'data' => $data,
				'kategori' => $kategori,
				'title' => 'Tabel Data Anggaran '.$data_anggaran->tahun_proyek.' s/d '.$data_anggaran->tahun_akhir_proyek,
				'nama_proyek' => $data_anggaran->nama_proyek,
				'tahun_proyek' => $i
			];

			$as[] = $retval;

			$html .= $this->load->view('view_pdf_tabel_anggaran', $retval, true);
		}
		
		$this->load->view('view_pdf_tabel_anggaran', $retval);
		$filename = 'tabel-anggaran-'.$tahun.'-'.time();
		$this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	public function cetak_data_perhitungan_anggaran($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		
		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);

		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$data_json = json_decode($data_anggaran->data_json);
		$tahun =  $data_anggaran->tahun_proyek;

		$html = '';

		$retval = [
			'data' => $data_json,
			//'data_json' => $data_json,
			'title' => 'Total Anggaran '.$data_anggaran->tahun_proyek.' s/d '.$data_anggaran->tahun_akhir_proyek,
			'nama_proyek' => $data_anggaran->nama_proyek,
			'tahun' => $tahun
		];


		//$this->load->view('view_pdf_total_anggaran', $retval);
		$filename = 'total-anggaran-'.time();
		$html .= $this->load->view('view_pdf_total_anggaran', $retval, true);
		$this->lib_dompdf->generate($html, $filename, true, 'A4', 'landscape');
	}

	public function cetak_perhitungan_bobot($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		
		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);

		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$data_json = json_decode($data_anggaran->data_json);
		$data_bobot = $this->m_global->multi_row('t_bobot_proses.*', ['id_anggaran' => $id_anggaran], 't_bobot_proses', null, 'kode asc, tahun asc');
		$tahun =  $data_anggaran->tahun_proyek;

		$html = '';

		$retval = [
			'data' => $data_json,
			'data_bobot' => $data_bobot,
			'title' => 'Total Anggaran '.$data_anggaran->tahun_proyek.' s/d '.$data_anggaran->tahun_akhir_proyek,
			'nama_proyek' => $data_anggaran->nama_proyek,
			'tahun' => $tahun
		];


		//$this->load->view('view_pdf_proses_bobot', $retval);
		$filename = 'proses-bobot-'.time();
		$html .= $this->load->view('view_pdf_proses_bobot', $retval, true);
		$this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}

	public function cetak_hasil_bobot($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		
		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);

		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$data_json = json_decode($data_anggaran->data_json);
		$data_bobot = $this->m_global->multi_row('t_bobot_proses.*', ['id_anggaran' => $id_anggaran], 't_bobot_proses', null, 'kode asc, tahun asc');
		$tahun =  $data_anggaran->tahun_proyek;

		$html = '';

		$retval = [
			'data' => $data_json,
			'data_bobot' => $data_bobot,
			'title' => 'Total Anggaran '.$data_anggaran->tahun_proyek.' s/d '.$data_anggaran->tahun_akhir_proyek,
			'nama_proyek' => $data_anggaran->nama_proyek,
			'tahun' => $tahun
		];


		// $this->load->view('view_pdf_hasil_bobot', $retval);
		$filename = 'hasil-bobot-'.time();
		$html .= $this->load->view('view_pdf_hasil_bobot', $retval, true);
		$this->lib_dompdf->generate($html, $filename, true, 'A4', 'landscape');
	}

	public function cetak_hasil_rangking($id_anggaran = false)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
		
		if($id_anggaran == false) {
			return redirect('data_hitung');
		}

		$id_anggaran = $this->enkripsi->enc_dec('decrypt', $id_anggaran);

		$data_anggaran = $this->m_global->single_row('t_anggaran.*, m_proyek.nama_proyek, m_proyek.tahun_proyek, m_proyek.tahun_akhir_proyek, m_proyek.durasi_tahun', ['t_anggaran.id' => $id_anggaran, 't_anggaran.deleted_at' =>null], 't_anggaran', [['table' => 'm_proyek', 'on' => 't_anggaran.id_proyek = m_proyek.id']]);

		if(!$data_anggaran) {
			return redirect('data_hitung');
		}

		$data_json = json_decode($data_anggaran->data_json);
		$data_bobot = $this->m_global->multi_row('t_bobot_proses.*', ['id_anggaran' => $id_anggaran], 't_bobot_proses', null, 'kode asc, tahun asc');
		$tahun =  $data_anggaran->tahun_proyek;

		## hitung bobot per kategori dan simpan ke array
		$kode_bobot = '';
		$counter_kolom = 0;
		$arr_tahun = [];
		foreach ($data_bobot as $kkk => $vvv) {
			if($vvv->kode != $kode_bobot){
				$counter_kolom++;
			}

			$kode_bobot = $vvv->kode;
		}

		// assign kolom tahun
		foreach ($data_bobot as $kkk => $vvv) {
			if (!in_array($vvv->tahun, $arr_tahun)){
			  array_push($arr_tahun, $vvv->tahun);
			}
		}

		for ($z=0; $z < count($arr_tahun); $z++) {
			$arr_bbt = [];
			foreach ($data_bobot as $k => $v) {
				if($arr_tahun[$z] == $v->tahun) {
					$arr_bbt[] = $v->bobot;
				}
			}

			$arr_bobot[] = $arr_bbt;
		}

		$kode_bobot = $data_bobot[0]->kode; 
		$jumlah_bobot = 0;
		$arr_bbt = [];

		foreach ($data_bobot as $k => $v) {

			if($kode_bobot == $v->kode) {
				$jumlah_bobot += $v->bobot;
			}else{
				$arr_bbt[] = $jumlah_bobot;

				//reset
				$jumlah_bobot = 0;
				//assign bobot
				$jumlah_bobot += $v->bobot;
			}

			$kode_bobot = $v->kode;
		}

		// tambahan kolom 
		$arr_bbt[] = $jumlah_bobot;
		//assign ke array bobot
		$arr_bobot[] = $arr_bbt;

		#### ambil data hitung 
		$data_hitung = $this->m_global->single_row('*', ['id_proyek' => $data_anggaran->id_proyek, 'deleted_at' => null], 't_hitung');
		
		#### data normalisasi_ahp
		$join = [ 
			['table' => 'm_kategori as k', 'on' => 'tn.id_kategori = k.id']
		];
		
		$normalisasi_ahp = $this->m_global->multi_row('tn.*, k.nama as nama_kategori', ['tn.id_hitung' => $data_hitung->id, 'tn.deleted_at' => null], 't_normalisasi tn', $join, 'tn.id_kategori asc, tn.kode_kategori_tujuan asc');

		## cari data fuzzy simpan ke array
		$fuzzy = [];
		foreach ($normalisasi_ahp as $kkk => $vvv) { 
			if($vvv->kode_kategori_tujuan == 'C1') {
				$fuzzy[] = $vvv->nilai;
			}
		}

		$html = '';

		$retval = [
			'data' => $data_json,
			'fuzzy' => $fuzzy,
			'data_bobot' => $data_bobot,
			'hasil_bobot' => $arr_bobot,
			'data_anggaran' => $data_anggaran,
			'title' => 'Total Anggaran '.$data_anggaran->tahun_proyek.' s/d '.$data_anggaran->tahun_akhir_proyek,
			'nama_proyek' => $data_anggaran->nama_proyek,
			'tahun' => $tahun
		];


		// $this->load->view('view_pdf_hasil_rangking', $retval);
		$filename = 'hasil-rangking-'.time();
		$html .= $this->load->view('view_pdf_hasil_rangking', $retval, true);
		$this->lib_dompdf->generate($html, $filename, true, 'A4', 'potrait');
	}


	public function angka_ke_huruf($angka)
	{
		foreach (range('A', 'Z') as $char) {
			$arr[] =  $char;
		}

		return $arr[$angka];
	}

}
