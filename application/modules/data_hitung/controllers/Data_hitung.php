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
								<th>".$v->total_lower."</th>
								<th>".$v->total_medium."</th>
								<th>".$v->total_upper."</th>
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

	

	/////////////////////////

}
