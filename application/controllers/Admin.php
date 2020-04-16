<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->library('form_validation');
        $this->load->library('pdf');
        
        $id = $this->session->userdata('id');
        $this->load->model('Auth_model');
        $this->load->model('Admin_model');
        $this->load->model('Petugas_model');
        $this->load->model('Masyarakat_model');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['level'] = $this->session->userdata('level');
        $data['pending'] = $this->Admin_model->jumlah($status='pending');
        $data['proses'] = $this->Admin_model->jumlah($status='proses');
        $data['approved'] = $this->Admin_model->jumlah($status='approved');
        $data['selesai'] = $this->Admin_model->jumlah($status='selesai');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    // petugas
    public function data_petugas(){
        $data['level'] = $this->session->userdata('level');
        $data['title'] = "Master Data Petugas";
        $data['data_petugas'] = $this->Petugas_model->get_data_petugas();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/master_petugas', $data);
        $this->load->view('templates/footer');
    }
    
    public function tambah_petugas(){
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('telp', 'Telp', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false){
            $data['title'] = "Master Data Petugas / Tambah Data";
            $data['level'] = $this->session->userdata('level');

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tambah_petugas');
            $this->load->view('templates/footer');
        }else{
            $this->_tambah_petugas();
        }
    }

    private function _tambah_petugas(){
        $data = [
            'email' => $this->input->post('email', TRUE),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'level' => 'petugas'
        ];
        $this->Auth_model->tambah_user($data);

        $data_petugas = [
         'nama_petugas' => $this->input->post('nama', TRUE),
         'telp' => $this->input->post('telp', TRUE),
         'id_login' => $this->Auth_model->get_user_terakhir()->ID_LOGIN,
     ];
     $this->Petugas_model->tambah_petugas($data_petugas);

     $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Data Berhasil ditambahkan.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button></div>');
     redirect('admin/data_petugas');
 }

 public function ubah_petugas(){
    $id = $this->uri->segment(3);
    $data['petugas'] = $this->Petugas_model->get_data_petugas_by_id($id);
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('telp', 'Telp', 'trim|required');
    if ($this->form_validation->run() == false) {
        $data['title'] = "Master Data Petugas / Ubah Data";
        $data['level'] = $this->session->userdata('level');
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/ubah_petugas',$data);
        $this->load->view('templates/footer');
    }else{
        $this->_ubah_petugas();
    }
}

private function _ubah_petugas(){
    $id = $this->input->post('id', TRUE);
    $data_petugas = [
     'nama_petugas' => $this->input->post('nama', TRUE),
     'telp' => $this->input->post('telp', TRUE)
 ];
 $this->Petugas_model->ubah_petugas($data_petugas,$id);

 $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Data Berhasil diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span></button></div>');
 redirect('admin/data_petugas');
}

public function hapus_petugas()
{
    $id = $this->uri->segment(3);
    $this->Petugas_model->hapus_petugas($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Data Berhasil dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button></div>');
    redirect('admin/data_petugas');
}

    // masyarakat
public function data_masyarakat(){
    $data['level'] = $this->session->userdata('level');
    $data['title'] = "Master Data masyarakat";
    $data['data_masyarakat'] = $this->Masyarakat_model->get_data_masyarakat();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/master_masyarakat', $data);
    $this->load->view('templates/footer');
}

public function hapus_masyarakat()
{
    $nik = $this->uri->segment(3);
    $this->Masyarakat_model->hapus_masyarakat($nik);
    $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Data Berhasil dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button></div>');
    redirect('admin/data_masyarakat');
}

    // Data Kategory
public function data_kategori(){
    $data['level'] = $this->session->userdata('level');
    $data['title'] = "Data Kategori";
    $data['data_kategori'] = $this->Admin_model->get_data_kategori();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/data_kategori', $data);
    $this->load->view('templates/footer');
}

public function tambah_kategori(){
  $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
  if ($this->form_validation->run() == false) {
    $data['level'] = $this->session->userdata('level');
    $data['title'] = "Data Kategori / Tambah Data";
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/tambah_kategori');
    $this->load->view('templates/footer');
}else{
    $this->_tambah_kategori();
}
}

private function _tambah_kategori(){
  $data = [
     'nama_kategori' => $this->input->post('nama', TRUE),
 ];
 $this->Admin_model->tambah_kategori($data);

 $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Data Berhasil ditambahkan.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button></div>');
 redirect('admin/data_kategori');
}

public function ubah_kategori(){
    $id = $this->uri->segment(3);
    $data['kategori'] = $this->Admin_model->get_data_kategori_by_id($id);
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    if ($this->form_validation->run() == false) {
        $data['level'] = $this->session->userdata('level');
        $data['title'] = "Data Kategori / Ubah Data";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/ubah_kategori',$data);
        $this->load->view('templates/footer');
    }else{
        $this->_ubah_kategori();
    }
}

private function _ubah_kategori(){
    $id = $this->input->post('id',TRUE);
    $data = [
        'nama_kategori' => $this->input->post('nama', TRUE),
    ];
    $this->Admin_model->ubah_kategori($data,$id);
    
    $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Data Berhasil diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span></button></div>');
    redirect('admin/data_kategori');
}

public function hapus_kategori()
{
    $id = $this->uri->segment(3);
    $this->Admin_model->hapus_kategori($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Data Berhasil dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button></div>');
    redirect('admin/data_kategori');
}

    // data pengaduan
public function data_pengaduan(){
    $data['level'] = $this->session->userdata('level');
    $data['title'] = "Data Pengaduan";
    $data['data_pengaduan'] = $this->Admin_model->get_data_pengaduan();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/data_pengaduan', $data);
    $this->load->view('templates/footer');
}

public function approved(){
    $id = $this->uri->segment(3);
    $this->Admin_model->approved($id);
    redirect('admin/data_pengaduan');
}

public function detail($id){
    $id_pengaduan = $this->uri->segment(3);
    $data['level'] = $this->session->userdata('level');
    $data['title'] = "Detail Pengaduan";
    $data['detail'] = $this->Masyarakat_model->get_detail_data_pengaduan($id_pengaduan);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('masyarakat/detail', $data);
    $this->load->view('templates/footer');
}

public function print_data_masyarakat()
{
    $header = array('NIK', 'Nama', 'Telp');
    $data = $this->Masyarakat_model->get_data_masyarakat();

    $pdf = new FPDF('l','mm','A5');
    $pdf->SetFont('Arial','',14);
    $pdf->AddPage();
    // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');
    // Header
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(190,7,'PENGADUAN MASYARAKAT',0,1,'C');
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,7,'DAFTAR MASYARAKAT',0,1,'C');
    $pdf->SetFont('Arial','',12);
    $w = array(40, 100, 40);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $pdf->Cell($w[0],6,$row['nik'],'LR',0,'L',$fill);
        $pdf->Cell($w[1],6,$row['nama'],'LR',0,'L',$fill);
        $pdf->Cell($w[2],6,$row['telp'],'LR',0,'R',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }
    // Closing line
    $pdf->Cell(array_sum($w),0,'','T');
    $pdf->Output();
}

public function print_data_petugas()
{
    $header = array('No.', 'Nama', 'Telp');
    $data = $this->Petugas_model->get_data_petugas();

    $pdf = new FPDF('l','mm','A5');
    $pdf->SetFont('Arial','',14);
    $pdf->AddPage();
    // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');
    // Header
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(190,7,'PENGADUAN MASYARAKAT',0,1,'C');
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,7,'DAFTAR PETUGAS',0,1,'C');
    $pdf->SetFont('Arial','',12);
    $w = array(10, 100, 40);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    
    // Data
    $fill = false;
    $no=1;
    foreach($data as $row)
    {
        $pdf->Cell($w[0],6,$no++,'LR',0,'C',$fill);
        $pdf->Cell($w[1],6,$row['nama_petugas'],'LR',0,'L',$fill);
        $pdf->Cell($w[2],6,$row['telp'],'LR',0,'R',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }
    // Closing line
    $pdf->Cell(array_sum($w),0,'','T');
    $pdf->Output();
}

public function print_data_pengaduan()
{
    $header = array('No.', 'Kategori', 'Pengaduan','Tanggal','Status');
    $data = $this->Admin_model->get_data_pengaduan();

    $pdf = new FPDF('l','mm','A5');
    $pdf->SetFont('Arial','',14);
    $pdf->AddPage();
    // Colors, line width and bold font
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');
    // Header
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(190,7,'PENGADUAN MASYARAKAT',0,1,'C');
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,7,'DAFTAR PENGADUAN',0,1,'C');
    $pdf->SetFont('Arial','',12);
    $w = array(10, 30, 90, 30, 30);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $pdf->Ln();
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    
    // Data
    $fill = false;
    $no=1;
    foreach($data as $row)
    {
        $pdf->Cell($w[0],6,$no++,'LR',0,'C',$fill);
        $pdf->Cell($w[1],6,$row['nama_kategori'],'LR',0,'L',$fill);
        $pdf->Cell($w[2],6,$row['isi_pengaduan'],'LR',0,'L',$fill);
        $pdf->Cell($w[3],6,$row['tanggal_pengaduan'],'LR',0,'R',$fill);
        $pdf->Cell($w[4],6,$row['status'],'LR',0,'L',$fill);
        $pdf->Ln();
        $fill = !$fill;
    }
    // Closing line
    $pdf->Cell(array_sum($w),0,'','T');
    $pdf->Output();
}


}
