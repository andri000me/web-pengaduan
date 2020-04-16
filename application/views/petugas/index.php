        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
          <hr/>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-right">
                    <p>print</p>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <?= $this->session->flashdata('message'); ?>
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>kategori</th>
                          <th>Isi Pengaduan</th>
                          <th>Tanggal</th>
                          <th>Status</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php $no=1; foreach ($data_pengaduan as $row) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_kategori']; ?></td>
                        <td><?= $row['isi_pengaduan']; ?></td>
                        <td><?= $row['tanggal_pengaduan']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td>
                            <a href="<?= base_url('petugas/ambil/'.$row["id_pengaduan"]); ?>" class="btn btn-success">ambil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>

</div>