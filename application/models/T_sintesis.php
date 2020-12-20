<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class T_sintesis extends CI_Model
{
	var $table = 't_sintesis';
	
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

	public function get_data_transaksi_sintesis()
	{
		$this->db->select('t_sintesis.*, m_proyek.nama_proyek, m_proyek.tahun_proyek');
		$this->db->from('t_sintesis');
		$this->db->join('t_hitung', 't_sintesis.id_hitung = t_hitung.id', 'left');
		$this->db->join('m_proyek', 't_sintesis.id_hitung = m_proyek.id', 'left');
		$this->db->where('t_sintesis.deleted_at', null);
		$this->db->group_by('t_sintesis.id_hitung');		
		$query = $this->db->get();
		return $query->result();
	}
}