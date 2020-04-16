        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
          <hr/>

          <!-- DataTales Example -->
          
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="float-left">
                <p>print</p>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <td colspan="2" align="center">Pengaduan</td>
                      </thead>
                      <tbody>
                        <tr>
                          <td width="30%">Tanggal</td>
                          <td width="70%"><?= $detail['tanggal_pengaduan'] ?></td>
                        </tr>
                        <tr>
                          <td width="30%">Kategori</td>
                          <td width="70%"><?= $detail['nama_kategori'] ?></td>
                        </tr>
                        <tr>
                          <td width="30%">Pengaduan</td>
                          <td width="70%"><?= $detail['isi_pengaduan'] ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <td colspan="2" align="center">Tanggapan</td>
                      </thead>
                      <tbody>
                        <tr>
                          <td width="30%">Tanggal</td>
                          <td width="70%"><?= $detail['tanggal_tanggapan'] ?></td>
                        </tr>
                        <tr>
                          <td width="30%">Tanggapan</td>
                          <td width="70%"><?= $detail['isi_tanggapan'] ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>