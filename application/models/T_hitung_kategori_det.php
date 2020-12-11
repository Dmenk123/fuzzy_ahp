<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class T_hitung_kategori_det extends CI_Model
{
	var $table = 't_hitung_kategori_det';
	
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
		$this->db->select('hk_det.kode_kriteria, Round(sum(hp.lower_val), 4) as total_lower, Round(sum(hp.medium_val), 4) as total_medium, Round(sum(hp.upper_val), 4) as total_upper');
		$this->db->from($this->table.' as hk_det');
		$this->db->join('m_himpunan hp', 'hk_det.id_himpunan = hp.id', 'left');
		$this->db->where(['hk_det.id_hitung_kategori' => $id_hitung, 'hp.deleted_at' => null]);
		$this->db->group_by('hk_det.kode_kriteria');
		$this->db->order_by('hk_det.kode_kriteria', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_himpunan_hitung($id_hitung)
	{
		$this->db->select('hk_det.id, hk_det.id_himpunan, hk_det.kode_kriteria, hp.lower_val, hp.medium_val, hp.upper_val, hk_det.kode_kriteria_tujuan, hk_det.flag_proses_kode_kriteria, hp.nama, hp.lower_txt, hp.medium_txt, hp.upper_txt, ka.nama as nama_kategori, kr.nama as nama_kriteria');
		$this->db->from($this->table.' as hk_det');
		$this->db->join('m_himpunan hp', 'hk_det.id_himpunan = hp.id', 'left');
		$this->db->join('t_hitung_kategori hk', 'hk_det.id_hitung_kategori = hk.id', 'left');
		$this->db->join('m_kategori ka', 'hk.id_kategori = ka.id', 'left');
		$this->db->join('m_kriteria kr', 'hk_det.id_kriteria = kr.id', 'left');
		$this->db->where(['hk_det.id_hitung_kategori' => $id_hitung, 'hp.deleted_at' => null]);
		$this->db->order_by('hk_det.kode_kriteria ASC, hk_det.kode_kriteria_tujuan ASC');
		$query = $this->db->get();
		return $query->result();
	}
}