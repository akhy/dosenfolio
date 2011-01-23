<?php

class Konfig_mod extends Model {
	var $table = 'konfig';
	
	function Konfig_mod()
	{
		parent::Model();
	}
	
	function get($key)
	{
		$this->db->where('key', $key);
		$query = $this->db->get($this->table);
		
		if ($query->num_rows() > 0)
		{
			$rows = $query->result();
			$row = $rows[0];
			return $row->value;
		}
		else
		{
			return FALSE;
		}
		
	}
	function set($key, $value)
	{
		$arr = array('value' => $value);
		$this->db->where('key', $key);
		$this->db->update($this->table, $arr);
	}
}