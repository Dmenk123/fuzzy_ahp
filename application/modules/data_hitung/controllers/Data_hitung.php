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
			'hk.*, k.nama as nama_kategori, p.nama_proyek, p.tahun_proyek', ['hk.id_kategori' => $id, 'hk.deleted_at' => null], 't_hitung_kategori as hk', $join, 'hk.created_at desc');

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

	public function detail_perhitungan($id_hitung)
	{
		$obj_date = new DateTime();
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);

		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_kategori = $this->input->get('kategori');
		$step_kriteria = $this->input->get('step_kriteria');
		$data_himpunan_hitung = $this->t_hitung_kategori_det->get_data_himpunan_hitung($id_hitung);

		if(!$data_himpunan_hitung) {
			return redirect('data_hitung');
		}

		$kriteria = $this->m_global->multi_row('*', ['id_kategori' => $id_kategori, 'deleted_at' => null], 'm_kriteria', NULL, 'urut');		
		$data_tot_himpunan = $this->t_hitung_kategori_det->get_nilai_total_himpunan($id_hitung);
		$data_hitung = $this->t_hitung_kategori->get_by_id($id_hitung);
		$arr_data_sintesis = $this->t_sintesis->get_by_condition(['id_hitung_kategori' => $id_hitung, 'deleted_at' => null]);

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Detail Perhitungan Perkategori',
			'data_user' => $data_user,
			'data_himpunan_hitung' => $data_himpunan_hitung,
			'data_tot_himpunan' => $data_tot_himpunan,
			'data_hitung' => $data_hitung,
			'kriteria' => $kriteria,
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

		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$id_kategori = $this->input->get('kategori');
		$step_kriteria = $this->input->get('step_kriteria');
		$kriteria = $this->m_global->multi_row('*', ['id_kategori' => $id_kategori, 'deleted_at' => null], 'm_kriteria', NULL, 'urut');		
		$data_tot_himpunan = $this->t_hitung_kategori_det->get_nilai_total_himpunan($id_hitung);
		$data_hitung = $this->t_hitung_kategori->get_by_id($id_hitung);

		for ($i=1; $i <= count($kriteria); $i++) { 

			for ($z=1; $z <= $i; $z++) { 
				
				// if($kriteria[$z-1]->kode_kriteria == 'C1' && $i == 1) {
				// 	continue;
				// }

				if($i == $z) {
					continue;
				}

				$step[$kriteria[$i-1]->kode_kriteria][] = [
					'kode'=>$kriteria[$z-1]->kode_kriteria
				];
			}
		}

		if(!$data_tot_himpunan) {
			return redirect('data_hitung');
		}

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Detail Sintesis',
			'data_user' => $data_user,
			'data_tot_himpunan' => $data_tot_himpunan,
			'data_hitung' => $data_hitung,
			'kriteria' => $kriteria,
			'step' => $step
		);

		
		echo "<pre>";
		print_r ($step);
		echo "</pre>";
		exit;

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

	/////////////////////////

}
