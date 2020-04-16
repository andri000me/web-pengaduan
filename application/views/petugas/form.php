<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <hr/>
    <a href="<?= base_url('petugas/list'); ?>" class="btn btn-secondary">
    Kembali
    </a>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <?= $this->session->flashdata('message'); ?>
                <form method="post" action="<?= base_url('petugas/tanggapan/'.$tanggapan['id_tanggapan']); ?>">
                    <div class="form-group">
                        <input type="hidden" id="id_tanggapan" name="id_tanggapan" value="<?= $tanggapan['id_tanggapan'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="id_pengaduan" name="id_pengaduan" value="<?= $tanggapan['id_pengaduan'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="isi">Tanggapan</label>
                        <textarea class="form-control" id="tanggapan" name="tanggapan"></textarea>
                        <?= form_error('tanggapan', '<small class="text-danger pl-3">', '</small>');
                        ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Kirim
                        </button>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>

</div>