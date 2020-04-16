        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
          <hr/>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-right">
                    <a href="<?= base_url('admin/print_data_masyarakat'); ?>" class="btn btn-sm btn-secondary shadow-sm" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Telp.</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; foreach ($data_masyarakat as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nik']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['telp']; ?></td>
                        <td align="center">
                            <a href="<?= base_url('admin/hapus_masyarakat/' . $row["nik"]); ?>">Hapus</a>
                        </td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>