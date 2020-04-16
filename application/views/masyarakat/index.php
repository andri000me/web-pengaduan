<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <hr/>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <?= $this->session->flashdata('message'); ?>
                <form method="post" action="<?= base_url('masyarakat/index'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori">
                            <option>Pilih Kategori ...</option>
                            <?php foreach ($kategori as $row) : ?>
                                <option value="<?= $row['id_kategori']; ?>"><?= $row['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>');
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                        <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>');
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="isi">Isi Pengaduan</label>
                        <textarea class="form-control" id="isi" name="isi"></textarea>
                        <?= form_error('isi', '<small class="text-danger pl-3">', '</small>');
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control-file" id="attachment" name="attachment">
                        <?= form_error('file', '<small class="text-danger pl-3">', '</small>');
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