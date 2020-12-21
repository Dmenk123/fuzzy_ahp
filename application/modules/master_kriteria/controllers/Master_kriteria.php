<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_kriteria extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_kriteria');
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
			'title' => 'Pengelolaan Data Kriteria',
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
			'modal' => 'modal_master_kriteria',
			'js'	=> 'master_kriteria.js',
			'view'	=> 'view_master_kriteria'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_data()
	{
		$list = $this->m_kriteria->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $val->nama;
			$row[] = $val->nama_kategori;
			$row[] = $val->urut;
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
			"recordsTotal" => $this->m_kriteria->count_all(),
			"recordsFiltered" => $this->m_kriteria->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_data()
	{
		$this->load->library('Enkripsi');
		$id = $this->input->post('id');
		$oldData = $this->m_kriteria->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}
			
		$data = array(
			'old_data' => $oldData
		);
		
		echo json_encode($data);
	}

	public function add_data_kriteria()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama = trim(strtoupper(strtolower($this->input->post('nama'))));
		$id_kategori = $this->input->post('kategori');
		$urut_kriteria = $this->input->post('urut');
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$exist_urut = $this->m_kriteria->get_by_condition(['id_kategori' => $id_kategori, 'urut' => $urut_kriteria, 'deleted_at' => null], true);

		if($exist_urut) {
			$data['inputerror'][] = 'urut';
            $data['error_string'][] = 'Urut Kriteria dengan Kategori ini sudah ada. Mohon pilih yang lain';
			$data['status'] = FALSE;
			echo json_encode($data);
			return;
		}

		$data_ins = [
			'id' => $this->m_kriteria->get_max_id(),
			'id_kategori' => $id_kategori,
			'nama' => $nama,
			'urut' => $urut_kriteria,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_kriteria->save($data_ins);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Kriteria';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Kriteria';
		}

		echo json_encode($retval);
	}

	public function update_data_kriteria()
	{
		$id = $this->input->post('id');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		$arr_valid = $this->rule_validasi();
		
		$nama = trim(strtoupper(strtolower($this->input->post('nama'))));
		$id_kategori = $this->input->post('kategori');
		$urut_kriteria = $this->input->post('urut');

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();
		
		$data_upd = [
			'nama' => $nama,
			'id_kategori' => $id_kategori,
			'urut' => $urut_kriteria,
			'updated_at' => $timestamp
		];

		$where = ['id' => $id];
		$update = $this->m_kriteria->update($where, $data_upd);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master kriteria';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master kriteria';
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
		$del = $this->m_kriteria->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master kriteria dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master kriteria dihapus';
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

		if ($this->input->post('urut') == '') {
			$data['inputerror'][] = 'urut';
            $data['error_string'][] = 'Wajib Memilih Urut Kriteria';
            $data['status'] = FALSE;
		}

        return $data;
	}
}
