<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class T_hitung_det extends CI_Model
{
	var $table = 't_hitung_det';
	
	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
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

	public function softdelete_by_id($id)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$where = ['id' => $id];
		$data = ['deleted_at' => $timestamp];
		return $this->db->update($this->table, $data, $where);
	}
		
	public function get_max_id()
	{
		$q = $this->db->query("SELECT MAX(id) as kode_max from $this->table");
		$kd = "";
		if($q->num_rows()>0){
			$kd = $q->row();
			return (int)$kd->kode_max + 1;
		}else{
			return '1';
		} 
	}

	public function get_nilai_total_himpunan($id_hitung)
	{
		$this->db->select('h_det.kode_kategori, sum(hp.lower_val) as total_lower, sum(hp.medium_val) as total_medium, sum(hp.upper_val) as total_upper');
		$this->db->from($this->table.' as h_det');
		$this->db->join('m_himpunan hp', 'h_det.id_himpunan = hp.id', 'left');
		$this->db->where(['h_det.id_hitung' => $id_hitung, 'hp.deleted_at' => null]);
		$this->db->group_by('h_det.kode_kategori');
		$this->db->order_by('h_det.kode_kategori', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_himpunan_hitung($id_hitung)
	{
		$this->db->select('h_det.id, h_det.id_himpunan, h_det.kode_kategori, hp.lower_val, hp.medium_val, hp.upper_val, h_det.kode_kategori_tujuan, h_det.flag_proses_kode_kategori, hp.nama, hp.lower_txt, hp.medium_txt, hp.upper_txt, ka.nama as nama_kategori');
		$this->db->from($this->table.' as h_det');
		$this->db->join('m_himpunan hp', 'h_det.id_himpunan = hp.id', 'left');
		$this->db->join('t_hitung h', 'h_det.id_hitung = h.id', 'left');
		$this->db->join('m_kategori ka', 'h_det.id_kategori = ka.id', 'left');
		$this->db->where(['h_det.id_hitung' => $id_hitung, 'hp.deleted_at' => null]);
		$this->db->order_by('h_det.kode_kategori ASC, h_det.kode_kategori_tujuan ASC');
		$query = $this->db->get();
		return $query->result();
	}
}