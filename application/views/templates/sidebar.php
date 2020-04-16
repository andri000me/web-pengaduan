<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>">
        <div class="sidebar-brand-text mx-3">Pengaduan Masyarakat</div>
    </a>

    <hr class="sidebar-divider my-0">
    <?php
    $level = $this->session->userdata('level');
     if ($level == "admin") { ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin') ?>">
                <i class="fas fa-fw fa-home"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Master</span>
            </a>
            <div id="collapseMaster" class="collapse" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('admin/data_petugas') ?>">Data Petugas</a>
                    <a class="collapse-item" href="<?= base_url('admin/data_masyarakat') ?>">Data Masyarakat</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data</span>
            </a>
            <div id="collapseData" class="collapse" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('admin/data_kategori') ?>">Kategori</a>
                    <a class="collapse-item" href="<?= base_url('admin/data_pengaduan') ?>">Pengaduan</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaturan" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pengaturan</span>
            </a>
            <div id="collapsePengaturan" class="collapse" aria-labelledby="HeadingPengaturan" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('auth/ubah_password'); ?>">Ubah Password</a>
                    <a class="collapse-item" href="<?= base_url('auth/logout'); ?>">Keluar</a>
                </div>
            </div>
        </li>
    <?php } elseif ($level == "petugas") { ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('petugas'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Data Pengaduan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('petugas/list'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>My List</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaturan" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pengaturan</span>
            </a>
            <div id="collapsePengaturan" class="collapse" aria-labelledby="HeadingPengaturan" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('auth/ubah_password'); ?>">Ubah Password</a>
                    <a class="collapse-item" href="<?= base_url('auth/logout'); ?>">Keluar</a>
                </div>
            </div>
        </li>
        
    <?php } else { ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('masyarakat'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Form Pengaduan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('masyarakat/list'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>List Pengaduan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaturan" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pengaturan</span>
            </a>
            <div id="collapsePengaturan" class="collapse" aria-labelledby="HeadingPengaturan" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('auth/ubah_password'); ?>">Ubah Password</a>
                    <a class="collapse-item" href="<?= base_url('auth/logout'); ?>">Keluar</a>
                </div>
            </div>
        </li>
    <?php } ?>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->