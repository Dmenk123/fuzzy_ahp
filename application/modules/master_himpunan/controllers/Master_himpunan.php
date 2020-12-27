<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_Himpunan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_himpunan');
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
			'title' => 'Pengelolaan Data Himpunan',
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
			'modal' => 'modal_master_himpunan',
			'js'	=> 'master_himpunan.js',
			'view'	=> 'view_master_himpunan'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_data()
	{
		$list = $this->m_himpunan->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $val->nama;
			$row[] = $val->lower_txt;
			$row[] = $val->medium_txt;
			$row[] = $val->upper_txt;
			$row[] = number_format((float)$val->lower_val, 4);
			$row[] = number_format((float)$val->medium_val, 4);
			$row[] = number_format((float)$val->upper_val, 4);
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_data(\''.$val->id.'\')">
							<i class="la la-pencil"></i> Edit
						</button>
						<button class="dropdown-item" onclick="delete_data(\''.$val->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';	

			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_himpunan->count_all(),
			"recordsFiltered" => $this->m_himpunan->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function hitung_pecahan()
	{
		$upper = trim($this->input->post('upper'));
		$medium = trim($this->input->post('medium'));
		$lower = trim($this->input->post('lower'));
		
		if( strpos( $upper, '/' ) !== false) {
			$arr_up = explode('/', $upper);
			$retval['upper'] =(int)$arr_up[0] / (int)$arr_up[1];
		}else{
			$retval['upper'] = (int)$upper;
		}

		if( strpos( $medium, '/' ) !== false) {
			$arr_med = explode('/', $medium);
			$retval['medium'] =(int)$arr_med[0] / (int)$arr_med[1];
		}else{
			$retval['medium'] = (int)$medium;
		}

		if( strpos( $lower, '/' ) !== false) {
			$arr_low = explode('/', $lower);
			$retval['lower'] =(int)$arr_low[0] / (int)$arr_low[1];
		}else{
			$retval['lower'] = (int)$lower;
		}

		echo json_encode($retval);
	}

	public function edit_data()
	{
		$this->load->library('Enkripsi');
		$id = $this->input->post('id');
		$oldData = $this->m_himpunan->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}
			
		$data = array(
			'old_data' => $oldData
		);
		
		echo json_encode($data);
	}

	public function add_data_himpunan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama_himp = trim($this->input->post('nama_himp'));
		$lower_txt_himp = trim($this->input->post('lower_txt_himp'));
		$medium_txt_himp = trim($this->input->post('medium_txt_himp'));
		$upper_txt_himp = trim($this->input->post('upper_txt_himp'));
		$lower_val_himp = trim($this->input->post('lower_val_himp'));
		$medium_val_himp = trim($this->input->post('medium_val_himp'));
		$upper_val_himp = trim($this->input->post('upper_val_himp'));

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$data_himpunan = [
			'id' => $this->m_himpunan->get_max_id(),
			'nama' => $nama_himp,
			'lower_txt' => $lower_txt_himp,
			'medium_txt' => $medium_txt_himp,
			'upper_txt' => $upper_txt_himp,
			'lower_val' => $lower_val_himp,
			'medium_val' => $medium_val_himp,
			'upper_val' => $upper_val_himp,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_himpunan->save($data_himpunan);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Himpunan';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Himpunan';
		}

		echo json_encode($retval);
	}

	public function update_data_himpunan()
	{
		$id = $this->input->post('id_himp');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		$arr_valid = $this->rule_validasi();

		$nama_himp = trim($this->input->post('nama_himp'));
		$lower_txt_himp = trim($this->input->post('lower_txt_himp'));
		$medium_txt_himp = trim($this->input->post('medium_txt_himp'));
		$upper_txt_himp = trim($this->input->post('upper_txt_himp'));
		$lower_val_himp = trim($this->input->post('lower_val_himp'));
		$medium_val_himp = trim($this->input->post('medium_val_himp'));
		$upper_val_himp = trim($this->input->post('upper_val_himp'));

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();
		
		$data_himpunan = [
			'nama' => $nama_himp,
			'lower_txt' => $lower_txt_himp,
			'medium_txt' => $medium_txt_himp,
			'upper_txt' => $upper_txt_himp,
			'lower_val' => $lower_val_himp,
			'medium_val' => $medium_val_himp,
			'upper_val' => $upper_val_himp,
			'updated_at' => $timestamp
		];

		$where = ['id' => $id];
		$update = $this->m_himpunan->update($where, $data_himpunan);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master Himpunan';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master Himpunan';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_data()
	{
		$id = $this->input->post('id');
		$del = $this->m_himpunan->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Himpunan dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Himpunan dihapus';
		}

		echo json_encode($retval);
	}

	public function edit_status_user($id)
	{
		$input_status = $this->input->post('status');
		// jika aktif maka di set ke nonaktif / "0"
		$status = ($input_status == "aktif") ? $status = 0 : $status = 1;
			
		$input = array('status' => $status);

		$where = ['id' => $id];

		$this->m_user->update($where, $input);

		if ($this->db->affected_rows() == '1') {
			$data = array(
				'status' => TRUE,
				'pesan' => "Status User berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE
			);
		}

		echo json_encode($data);
	}

	// ===============================================
	private function rule_validasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_himp') == '') {
			$data['inputerror'][] = 'nama_himp';
            $data['error_string'][] = 'Wajib Memilih Nama';
            $data['status'] = FALSE;
		}

		if ($this->input->post('lower_txt_himp') == '') {
			$data['inputerror'][] = 'lower_txt_himp';
            $data['error_string'][] = 'Wajib Memilih Lower';
            $data['status'] = FALSE;
		}

		if ($this->input->post('medium_txt_himp') == '') {
			$data['inputerror'][] = 'medium_txt_himp';
            $data['error_string'][] = 'Wajib Memilih Medium';
            $data['status'] = FALSE;
		}

		if ($this->input->post('upper_txt_himp') == '') {
			$data['inputerror'][] = 'upper_txt_himp';
            $data['error_string'][] = 'Wajib Memilih Upper';
            $data['status'] = FALSE;
		}

		if ($this->input->post('lower_val_himp') == '') {
			$data['inputerror'][] = 'lower_val_himp';
            $data['error_string'][] = 'Wajib Memilih Lower';
            $data['status'] = FALSE;
		}

		if ($this->input->post('medium_val_himp') == '') {
			$data['inputerror'][] = 'medium_val_himp';
            $data['error_string'][] = 'Wajib Memilih Medium Value';
            $data['status'] = FALSE;
		}

		if ($this->input->post('upper_val_himp') == '') {
			$data['inputerror'][] = 'upper_val_himp';
            $data['error_string'][] = 'Wajib Memilih Upper Value';
            $data['status'] = FALSE;
		}

        return $data;
	}

	private function konfigurasi_upload_img($nmfile)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = './files/img/user_img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '4000';//in KB (4MB)
		$config['max_width']  = '0';//zero for no limit 
		$config['max_height']  = '0';//zero for no limit
		$config['file_name'] = $nmfile;
		//load library with custom object name alias
		$this->load->library('upload', $config, 'file_obj');
		$this->file_obj->initialize($config);
	}

	private function konfigurasi_image_resize($filename)
	{
		//konfigurasi image lib
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = './files/img/user_img/'.$filename;
	    $config['create_thumb'] = FALSE;
	    $config['maintain_ratio'] = FALSE;
	    $config['new_image'] = './files/img/user_img/'.$filename;
	    $config['overwrite'] = TRUE;
	    $config['width'] = 450; //resize
	    $config['height'] = 500; //resize
	    $this->load->library('image_lib',$config); //load image library
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();
	}

	private function konfigurasi_image_thumb($filename, $gbr)
	{
		//konfigurasi image lib
	    $config2['image_library'] = 'gd2';
	    $config2['source_image'] = './files/img/user_img/'.$filename;
	    $config2['create_thumb'] = TRUE;
	 	$config2['thumb_marker'] = '_thumb';
	    $config2['maintain_ratio'] = FALSE;
	    $config2['new_image'] = './files/img/user_img/thumbs/'.$filename;
	    $config2['overwrite'] = TRUE;
	    $config2['quality'] = '60%';
	 	$config2['width'] = 45;
	 	$config2['height'] = 45;
	    $this->load->library('image_lib',$config2); //load image library
	    $this->image_lib->initialize($config2);
	    $this->image_lib->resize();
	    return $output_thumb = $gbr['raw_name'].'_thumb'.$gbr['file_ext'];	
	}

	private function seoUrl($string) {
	    //Lower case everything
	    $string = strtolower($string);
	    //Make alphanumeric (removes all other characters)
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    //Clean up multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);
	    return $string;
	}
}
