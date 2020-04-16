        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
          <hr/>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <a href="<?= base_url('admin/tambah_petugas'); ?>" class="btn btn-sm btn-primary" target="_blank">
                        Tambah
                    </a>
                </div>
                <div class="float-right">
                    <a href="<?= base_url('admin/print_data_petugas'); ?>" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?= $this->session->flashdata('message'); ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Telp.</th>
                      <th>Posisi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; foreach ($data_petugas as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_petugas']; ?></td>
                        <td><?= $row['telp']; ?></td>
                        <td><?= $row['level']; ?></td>
                        <td align="center">
                            <a href="<?= base_url('admin/ubah_petugas/' . $row["id_petugas"]); ?>">Ubah</a>
                            <a href="<?= base_url('admin/hapus_petugas/' . $row["id_petugas"]); ?>">Hapus</a>
                        </td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>