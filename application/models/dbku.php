<?php

class Dbku extends Model {

	var $table_name = '';
	var $primary_key = '';
	
	function Dbku()
	{
		parent::Model();	
	}
	
	function initialize($tab, $prim = NULL)
	{
		$this->table_name = $tab;
		if ($prim == NULL)
		{
			// put your custom default primary key name format here
			$this->primary_key = $tab . '_id';
		}
		else
		{
			$this->primary_key = $prim;
		}
	}
	
	function query($q)
	{
		return $this->db->query($q)->result();
	}
	
	function get($id = NULL, $limit = NULL, $isArray = FALSE, $orderby = NULL)
	{
		if ($id == NULL)
		{
			if ($orderby != NULL)
			{
				if ($orderby == 'random')
					$this->db->order_by($this->primary_key, 'random');
				else
					$this->db->order_by($orderby, 'ASC');
			}
			return $this->db->get($this->table_name)->result();
		} 
		else
		{
			return $this->get_where($this->primary_key, $id, $limit, $isArray, $orderby);
		}
		
	}
	
	function get_where($col, $cond, $limit = NULL, $isArray = FALSE, $orderby = NULL)
	{
		$this->db->where($col, $cond);
		
		if ($limit != NULL)
		{
			$this->db->limit($limit);
		}
		
		if ($orderby != NULL)
		{
			if ($orderby == 'random')
				$this->db->order_by($this->primary_key, 'random');
			else
				$this->db->order_by($orderby, 'ASC');
		}
		
		$query = $this->db->get($this->table_name);
		
		if ($isArray)
		{
			return $query->result_array();
		}
		return $query->result();
	}
	
	function get_where_like($cond, $val)
	{
		$this->db->like($cond, $val);
		
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}
	
	function getOne($id)
	{
		return $this->getOne_where($this->primary_key, $id);
	}
	
	function getOne_where($col, $cond)
	{
		if($this->isExist($col, $cond))
		{
			$arr = $this->get_where($col, $cond, 1);
			return $arr[0];
		}
		else
		{
			return FALSE;
		}
	}
	
	function insert($arr)
	{
		$this->db->insert($this->table_name, $arr);
	}
	function update($id, $arr)
	{
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $arr);
	}
	function delete($id)
	{
		$this->db->where($this->primary_key, $id);
		$this->db->delete($this->table_name);
	}
	function delete_where($col, $cond)
	{
		$this->db->where($col, $cond);
		$this->db->delete($this->table_name);
	}
	
	function count($cond = NULL, $val = NULL)
	{
		if ($cond != NULL)
		{
			$this->db->where($cond, $val);
		} 

		$query = $this->db->get($this->table_name);
		
		return $query->num_rows();
	}
	

	function isExist($cond, $val)
	{
		if ($this->count($cond, $val) > 0)
		{ 
			return TRUE;
		}
		return FALSE;
	}
	
}