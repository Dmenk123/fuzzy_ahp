<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class T_normalisasi extends CI_Model
{
	var $table = 't_normalisasi';
	
	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	public function get_by_condition($where, $is_single = false)
	{
		$this->db->from($this->table);
		$this->db->where($where);
		$query = $this->db->get();
		if($is_single) {
			return $query->row();
		}else{
			return $query->result();
		}
	}

	public function save($data)
	{
		return $this->db->insert($this->table, $data);	
	}

	public function update($where, $data)
	{
		return $this->db->update($this->table, $data, $where);
	}

	public function get_data_transaksi_normalisasi()
	{
		$this->db->select('t_normalisasi.*, m_proyek.nama_proyek, m_proyek.tahun_proyek');
		$this->db->from('t_normalisasi');
		$this->db->join('t_hitung', 't_normalisasi.id_hitung = t_hitung.id', 'left');
		$this->db->join('m_proyek', 't_normalisasi.id_hitung = m_proyek.id', 'left');
		$this->db->where('t_normalisasi.deleted_at', null);
		$this->db->group_by('t_normalisasi.id_hitung');		
		$query = $this->db->get();
		return $query->result();
	}

}