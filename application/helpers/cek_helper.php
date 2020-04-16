<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('id')) {
        redirect('auth');
    } else {
        $level = $ci->session->userdata('level');
        $akses = $ci->uri->segment(1);
        if ($level == "admin") {
            if ($akses <> "admin") {
                redirect('auth/blocked');
            }
        } elseif ($level == "petugas") {
            if ($akses <> "petugas") {
                redirect('auth/blocked');
            }
        } else {
            if ($akses <> "masyarakat") {
                redirect('auth/blocked');
            }
        }
    }
}
