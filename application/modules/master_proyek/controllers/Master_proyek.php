<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_proyek extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_user');
		$this->load->model('m_proyek');
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
			'title' => 'Pengelolaan Data Proyek',
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
			'modal' => 'modal_master_proyek',
			'js'	=> 'master_proyek.js',
			'view'	=> 'view_master_proyek'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_data()
	{
		$list = $this->m_proyek->get_datatables();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $val->nama_proyek;
			$row[] = $val->keterangan_proyek;
			$row[] = $val->tahun_proyek;
			$row[] = $val->tahun_akhir_proyek;
			$row[] = $val->durasi_tahun.' Tahun';
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_data(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-pencil"></i> Edit
						</button>
						<button class="dropdown-item" onclick="delete_data(\''.$this->enkripsi->enc_dec('encrypt', $val->id).'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';	

			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_proyek->count_all(),
			"recordsFiltered" => $this->m_proyek->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_data()
	{
		$this->load->library('Enkripsi');
		$id = $this->enkripsi->enc_dec('decrypt', $this->input->post('id'));
		$oldData = $this->m_proyek->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}
			
		$data = array(
			'old_data' => $oldData
		);
		
		echo json_encode($data);
	}

	public function add_data_proyek()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$nama = trim($this->input->post('nama'));
		$keterangan = trim($this->input->post('keterangan'));
		$tahun_awal = $this->input->post('tahun_awal');
		$tahun_akhir = $this->input->post('tahun_akhir');
		$selisih_tahun = (int)$tahun_akhir - (int)$tahun_awal;
		
		if($selisih_tahun >= 0) {
			$durasi_tahun = $selisih_tahun + 1;
		}else{
			$data['inputerror'][] = 'tahun_awal';
            $data['error_string'][] = 'Mohon Periksa Pemilihan Tahun Awal';
			$data['status'] = FALSE;

			$data['inputerror'][] = 'tahun_akhir';
            $data['error_string'][] = 'Mohon Periksa Pemilihan Tahun Akhir';
			$data['status'] = FALSE;
			echo json_encode($data);
			return;
		}

		$data_ins = [
			'id' => $this->m_proyek->get_max_id(),
			'nama_proyek' => $nama,
			'keterangan_proyek' => $keterangan,
			'tahun_proyek' => $tahun_awal,
			'tahun_akhir_proyek' => $tahun_akhir,
			'durasi_tahun' => $durasi_tahun,
			'created_at' => $timestamp
		];
		
		$insert = $this->m_proyek->save($data_ins);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan Proyek Baru';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan Proyek Baru';
		}

		echo json_encode($retval);
	}

	public function update_data_proyek()
	{
		$id = $this->input->post('id');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$nama = trim($this->input->post('nama'));
		$keterangan = trim($this->input->post('keterangan'));
		$tahun_awal = $this->input->post('tahun_awal');
		$tahun_akhir = $this->input->post('tahun_akhir');
		$selisih_tahun = (int)$tahun_akhir - (int)$tahun_awal;

		if($selisih_tahun >= 0) {
			$durasi_tahun = $selisih_tahun + 1;
		}else{
			$data['inputerror'][] = 'tahun_awal';
            $data['error_string'][] = 'Mohon Periksa Pemilihan Tahun Awal';
			$data['status'] = FALSE;

			$data['inputerror'][] = 'tahun_akhir';
            $data['error_string'][] = 'Mohon Periksa Pemilihan Tahun Akhir';
			$data['status'] = FALSE;
			echo json_encode($data);
			return;
		}

		$this->db->trans_begin();
		
		$data_upd = [
			'nama_proyek' => $nama,
			'keterangan_proyek' => $keterangan,
			'tahun_proyek' => $tahun_awal,
			'tahun_akhir_proyek' => $tahun_akhir,
			'durasi_tahun' => $durasi_tahun,
			'updated_at' => $timestamp
		];

		$where = ['id' => $id];
		$update = $this->m_proyek->update($where, $data_upd);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master proyek';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master proyek';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_data()
	{
		$this->load->library('Enkripsi');
		$id = $this->enkripsi->enc_dec('decrypt', $this->input->post('id'));

		$del = $this->m_proyek->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Proyek dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Proyek dihapus';
		}

		echo json_encode($retval);
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

		if ($this->input->post('keterangan') == '') {
			$data['inputerror'][] = 'keterangan';
            $data['error_string'][] = 'Wajib Memilih Keterangan';
            $data['status'] = FALSE;
		}

		if ($this->input->post('tahun_awal') == '') {
			$data['inputerror'][] = 'tahun_awal';
            $data['error_string'][] = 'Wajib Memilih Tahun Awal';
            $data['status'] = FALSE;
		}

		if ($this->input->post('tahun_akhir') == '') {
			$data['inputerror'][] = 'tahun_akhir';
            $data['error_string'][] = 'Wajib Memilih Tahun Akhir';
            $data['status'] = FALSE;
		}

        return $data;
	}
}
