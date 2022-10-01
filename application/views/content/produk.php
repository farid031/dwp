<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Produk
            <small>Produk PT Smart</small><br /><br />
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-tambah-produk">Tambah Data Produk</button>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Produk PT Smart</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table-produk" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $i = 0;
                                foreach ($produk->result() as $data) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data->produk_label ?></td>
                                        <td><?php echo 'Rp'.number_format($data->produk_harga, 0, ',', '.').',-' ?></td>
                                        <td><button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-produk-<?php echo $i++ ?>">Edit</button> <button class="btn btn-danger" onclick="hapusProduk(<?php echo $data->produk_id ?>)">Hapus</button></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!--modal tambah-->
        <div class="modal fade" id="modal-tambah-produk">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" action="<?php echo base_url('C_produk/tambah_produk'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Tambah Data Produk</h4>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" id="nama_produk" name="nama_produk" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="harga_produk">Harga Produk</label>
                                <input type="number" id="harga_produk" name="harga_produk" class="form-control">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal tambah-->

        <!--modal edit-->
        <?php
        $j = 0;
        foreach ($produk->result() as $produk_edit) { ?>
            <div class="modal fade" id="modal-edit-produk-<?php echo $j++ ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" method="post" action="<?php echo base_url('C_produk/ubah_produk/' . $produk_edit->produk_id); ?>" enctype="multipart/form-data" accept-charset="utf-8">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data Calon Customer</h4>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama_produk">Nama Perusahaan</label>
                                    <input type="text" id="nama_produk" name="nama_produk" value="<?php echo $produk_edit->produk_label ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="harga_produk">harga</label>
                                    <input type="numeric" id="harga_produk" name="harga_produk" value="<?php echo $produk_edit->produk_harga ?>" class="form-control">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        <?php }
        ?>
        <!-- /.modal Edit-->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->