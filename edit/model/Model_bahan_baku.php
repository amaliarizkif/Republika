<?php

Class Model_bahan_baku extends CI_Model {
	function __construct(){
		$this->load->database();
	}

	function get_bahan(){
		$query = $this->db->get('bahan_baku');
		return $query->result_array();
	}

	function select_data(){
		$bahan_baku = $this->db
		->select('id_bahan_baku, nama, alamat, no_telp, email, bukti, total_produksi, kategori.kategori, barang_bahan, bahan_baku.provinsi, kota.kota, id_user')
		->from('bahan_baku')
		->join('kategori', 'kategori.kategori = bahan_baku.kategori')
		->join('kota', 'kota.kota = bahan_baku.kota')
		->get();
		return $bahan_baku->result_array();
	}
	
	function tambah_bahan_baku($data){
		$this->db->insert('bahan_baku', $data);
	}

	function hapus_bahan_baku($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}

	function edit_bahan_baku($where,$table){		
	return $this->db->get_where($table,$where);
	}

	function update_bahan_baku($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

  function update_ban($setdata, $where){
    $query = $this->db->query("UPDATE `tampil` SET `sell_kursi_studio`= '$setdata' WHERE `id_tampil`='$where'");
    return $query;
  }

	function getPelamar($email)
	{
        $this->db->where('email', $email);
        $this->db->select("*");
        $this->db->from("bahan_baku");
        
        return $this->db->get();
	}

	public function carri($ban)
    {
       if($ban >=3000)
      {
        $this->db->where('total_produksi >=',$ban);
        $query = $this->db->get('bahan_baku');
        return $query->result_array();
      }elseif($ban >=1000 AND $ban <3000)
      {
        $this->db->where('total_produksi <3000 and total_produksi >=1000');
        $query = $this->db->get('bahan_baku');
        return $query->result_array();
      }
      elseif($ban >=500 AND $ban <1000)
      {
        $this->db->where('total_produksi <1000 and total_produksi >=500');
        $query = $this->db->get('bahan_baku');
        return $query->result_array();
      }
      elseif($ban <500)
      {
        $this->db->where('total_produksi <500');
        $query = $this->db->get('bahan_baku');
        return $query->result_array();
      }
    }
   public function carr($keyword)
    {
       $this->db->where('tipe', $keyword);
        $query = $this->db->get('bahan_baku');
        return $query->result_array();
    }
    public function gab(){
      $this->db
      ->where('tipe', $keyword)
      ->where('total_produksi >=',$ban);
        $query = $this->db->get('bahan_baku');
        return $query->result_array();
    }
	  public function carl($rad)
    {
      if($rad == "terbaru")
      {
        $this->db->order_by('jam','asc');
        $query = $this->db->get('bahan_baku');
        return $query->result_array();
      }else{
        $this->db->order_by('jam','desc');
        $query = $this->db->get('bahan_baku');
        return $query->result_array();
      }
      
    }


}

?>