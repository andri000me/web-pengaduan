<?php
class Petugas_model extends CI_Model
{
    public function get_data_petugas(){
        $this->db->select('*');
        $this->db->from('petugas');
        $this->db->join('login', 'login.id_login = petugas.id_login');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_data_petugas_by_id($id){
        return $this->db->get_where('petugas', ['id_petugas' => $id])->row_array();
    }

    public function get_petugas_id($id){
        return $this->db->get_where('petugas', ['id_login' => $id])->row_array();
    }

    public function tambah_petugas($data)
    {
        $this->db->insert('petugas', $data);
    }

    public function ubah_petugas($data,$id){
        $this->db->where('id_petugas', $id);
        $this->db->update('petugas', $data);
    }

    public function hapus_petugas($id){
        $this->db->set('nama_petugas', $data['nama_petugas']);
        $this->db->set('telp', $data['telp']);
        $this->db->where('id_petugas', $id);
        $this->db->delete('petugas');
    }

    public function get_data_pengaduan(){
        $this->db->select('*');
        $this->db->from('pengaduan a'); 
        $this->db->join('kategori b', 'b.id_kategori=a.id_kategori', 'left');
        $this->db->where('status', 'pending');
        return $this->db->get()->result_array();
    }

    public function get_data_pengaduan_by_id($id_petugas){
        $this->db->select('*');
        $this->db->from('pengaduan a'); 
        $this->db->join('kategori b', 'b.id_kategori=a.id_kategori');
        $this->db->join('tanggapan c', 'c.id_pengaduan=a.id_pengaduan');
        $where = "id_petugas=$id_petugas AND status='approved' OR status='selesai'";
        $this->db->where($where);
        return $this->db->get()->result_array();
    }

    public function update_status($id,$data){
        $this->db->where('id_pengaduan', $id);
        $this->db->update('pengaduan',$data);
    }

    public function simpan_tanggapan($data){
        $this->db->insert('tanggapan', $data);
    }

    public function get_data_tanggapan_by_id($id){
        return $this->db->get_where('tanggapan', ['id_tanggapan' => $id])->row_array();
    }

    public function update_tanggapan($id,$data){
        $this->db->where('id_tanggapan', $id);
        $this->db->update('tanggapan', $data);
    }
    
}
