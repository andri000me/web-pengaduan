<?php
class Admin_model extends CI_Model
{
    public function get_data_kategori(){
        $query = $this->db->get('kategori')->result_array();
        return $query;
    }
    
    public function tambah_kategori($data)
    {
        $this->db->insert('kategori', $data);
    }

    public function get_data_kategori_by_id($id){
        return $this->db->get_where('kategori', ['id_kategori' => $id])->row_array();
    }

    public function ubah_kategori($data,$id){
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori', $data);
    }

    public function hapus_kategori($id){
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');
    }

    public function get_data_pengaduan(){
    $this->db->select('*');
    $this->db->from('pengaduan a'); 
    $this->db->join('kategori b', 'b.id_kategori=a.id_kategori', 'left');
    $this->db->join('masyarakat c', 'c.nik=a.nik', 'left');
    $this->db->join('tanggapan d', 'd.id_pengaduan=a.id_pengaduan', 'left');
    $this->db->join('petugas e', 'e.id_petugas=d.id_petugas', 'left');
    $this->db->order_by("a.tanggal_pengaduan", "asc");
    return $this->db->get()->result_array();
    }

    public function approved($id){
        $data = [
            'status' => 'approved'
        ];
        $this->db->where('id_pengaduan', $id);
        $this->db->update('pengaduan', $data);
    }

    public function jumlah($status){
        return $this->db->where('status', $status)->from("pengaduan")->count_all_results();
    }
}
