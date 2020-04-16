        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
          <hr/>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="float-right">
                    <a href="<?= base_url('admin/print_data_pengaduan'); ?>" target="_blank" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
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
                      <th>Tanggal</th>
                      <th>Kategori</th>
                      <th>Isi</th>
                      <th>Status</th>
                      <th>Petugas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($data_pengaduan as $row) : ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $row['nama']; ?></td>
                      <td><?= $row['tanggal_pengaduan']; ?></td>
                      <td><?= $row['nama_kategori']; ?></td>
                      <td><?= $row['isi_pengaduan']; ?></td>
                      <td>
                        <?php 
                        if($row['status']=="proses"){ ?>
                          <a href="<?= base_url("admin/approved/".$row['id_pengaduan']); ?>" class="btn btn-success">approv</a>
                        <?php } elseif($row['status']=="selesai"){ ?>
                            <a href="<?= base_url('admin/detail/'.$row['id_pengaduan']); ?>" class="btn btn-info">Cek</a>
                          <?php }else{
                            echo $row["status"]; 
                          }
                          ?>
                        </td>
                        <td><?= $row['nama_petugas']; ?></td>                        
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>