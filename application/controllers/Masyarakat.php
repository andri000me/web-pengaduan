<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masyarakat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        $this->load->model('Masyarakat_model');
    }

    public function index()
    {
        $id = $this->session->userdata('id');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('isi', 'Isi', 'trim|required');
        // $this->form_validation->set_rules('attachment', '', 'callback_attachment_check');
        if ($this->form_validation->run() == false) {
        $data['level'] = $this->session->userdata('level');
            $data['title'] = "Form Pengaduan";
            $data['kategori'] = $this->Admin_model->get_data_kategori();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('masyarakat/index', $data);
            $this->load->view('templates/footer');
        }else{
            // $config['upload_path']          = './assets/upload/';
            // $config['allowed_types']        = 'pdf';
            // $config['max_size']             = 2048;
            // $config['file_name'] = $nim . ".pdf";

            // $this->load->library('upload', $config);
            // if (!$this->upload->do_upload('attachment')) {
            //     echo $this->upload->display_errors();
            // } else {
            //     $file = $this->upload->data();
            $masyarakat = $this->Masyarakat_model->get_nik($id);
            $data=[
                'id_kategori' => $this->input->post('kategori', TRUE),
                'nik' => $masyarakat['nik'],
                'tanggal_pengaduan' => $this->input->post('tanggal', TRUE),
                'isi_pengaduan' => $this->input->post('isi', TRUE),
                'file' => $this->_upload(),
            ];

            $this->Masyarakat_model->simpan_pengaduan($data);

            $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissible fade show" role="alert"> Data Berhasil ditambahkan.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
            redirect('masyarakat/list');
        }
        // }
    }

    public function list(){
        $id = $this->session->userdata('id');
        $masyarakat = $this->Masyarakat_model->get_nik($id);
        $data['level'] = $this->session->userdata('level');
        $data['title'] = "List Data Pengaduan";
        $data['data_pengaduan'] = $this->Masyarakat_model->get_data_pengaduan($masyarakat['nik']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('masyarakat/list', $data);
        $this->load->view('templates/footer');
    }

    private function _upload()
    {
        $config['upload_path']          = './assets/upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = time();
        $config['overwrite']            = true;
        $config['max_size']             = 1024;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('attachment')) {
            return $this->upload->data("file_name");
        }
        print_r($this->upload->display_errors());

        return "default.jpg";
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
}
