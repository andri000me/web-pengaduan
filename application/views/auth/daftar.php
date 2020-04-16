<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Daftar</h1>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form method="post" action="<?= base_url('auth/daftar'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="Nomor Induk Kependudukan" value="<?= set_value('nik'); ?>">
                                        <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="telp" name="telp" placeholder="No Telp." value="<?= set_value('telp'); ?>">
                                        <?= form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group ">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>');
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Daftar
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <span><a class="small float-left" href="<?= base_url('auth'); ?>"> Sudah punya akun ? </a></span>
                                    </div>
                                </form>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>