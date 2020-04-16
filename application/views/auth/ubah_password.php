<div class="container">
        <div class="col-lg-12">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <?= $this->session->flashdata('message'); ?>
                                <form method="post" action="<?= base_url('auth/ubah_password'); ?>">
                                    <div class="form-group ">
                                        <input type="password" class="form-control form-control-user" id="password_lama" name="password_lama" placeholder="Password Lama">
                                        <?= form_error('password_lama', '<small class="text-danger pl-3">', '</small>');
                                        ?>
                                    </div>
                                    <div class="form-group ">
                                        <input type="password" class="form-control form-control-user" id="password_baru" name="password_baru" placeholder="Password Baru">
                                        <?= form_error('password_baru', '<small class="text-danger pl-3">', '</small>');
                                        ?>
                                    </div>
                                    <div class="form-group ">
                                        <input type="password" class="form-control form-control-user" id="password_konfirmasi" name="password_konfirmasi" placeholder="Konfirmasi Password Baru">
                                        <?= form_error('password_konfirmasi', '<small class="text-danger pl-3">', '</small>');
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
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