        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
          <hr/>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <a href="<?= base_url('admin/tambah_kategori'); ?>" class="btn btn-sm btn-primary">
                        Tambah
                    </a>
                </div>
                <div class="float-right">
                    <a href="#" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
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
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; foreach ($data_kategori as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_kategori']; ?></td>
                        <td align="center">
                            <a href="<?= base_url('admin/ubah_kategori/' . $row["id_kategori"]); ?>">Ubah</a>
                            <a href="<?= base_url('admin/hapus_kategori/' . $row["id_kategori"]); ?>">Hapus</a>
                        </td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>