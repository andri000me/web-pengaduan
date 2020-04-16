<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
          <hr/>
    <a href="<?= base_url('admin/data_kategori'); ?>" class="btn btn-sm btn-secondary">
    Kembali
    </a>
        <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <?= $this->session->flashdata('message'); ?>
                                <form method="post" action="<?= base_url('admin/ubah_kategori'); ?>">
                                    <div class="form-group ">
                                        <input type="hidden" class="form-control form-control-user" id="id" name="id" value="<?= $kategori['id_kategori']; ?>">
                                    </div>
                                    <div class="form-group ">
                                        <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?= $kategori['nama_kategori']; ?>">
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Ubah
                                        </button>
                                    </div>
                                </form>
                                <br>
                            </div>
                        </div>
                    </div>
        </div>

</div>