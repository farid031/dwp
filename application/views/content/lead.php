<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Calon Customer
            <small>Calon customer PT Smart</small><br /><br />
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-tambah-lead">Tambah Data Lead</button>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Calon customer PT Smart</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table-lead" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat</th>
                                    <th>Nama PIC</th>
                                    <th>No. Telp PIC</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $this->load->model('M_data');
                                $no = 1;
                                $i = 0;
                                foreach ($lead->result() as $data) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data->cust_name ?></td>
                                        <td><?php echo $data->cust_alamat ?></td>
                                        <td><?php echo $data->cust_pic_name ?></td>
                                        <td><?php echo $data->cust_pic_telp ?></td>
                                        <td><?php echo $data->stat_cust_label ?></td>
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal-input-penawaran-<?php echo $i ?>" title="Tambah Penawaran"><i class="fa fa-plus"></i></button> <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-lead-<?php echo $i ?>" title="Edit Data"><i class="fa fa-edit"></i></button> <button class="btn btn-danger" onclick="hapusLead(<?php echo $data->cust_id ?>)" title="Hapus Data"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                <?php $i++;}
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat</th>
                                    <th>Nama PIC</th>
                                    <th>No. Telp PIC</th>
                                    <th>Status</th>
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
        <div class="modal fade" id="modal-tambah-lead">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" action="<?php echo base_url('C_lead/tambah_lead'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Tambah Data Calon Customer</h4>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_lead">Nama Perusahaan</label>
                                <input type="text" id="nama_lead" name="nama_lead" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alamat_lead">Alamat</label>
                                <input type="text" id="alamat_lead" name="alamat_lead" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_pic">Nama PIC</label>
                                <input type="text" id="nama_pic" name="nama_pic" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="no_telp_pic">No. Telp PIC</label>
                                <input type="text" id="no_telp_pic" name="no_telp_pic" class="form-control">
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
        <!-- /.modal tambah-->

        <!--modal edit-->
        <?php
        $j = 0;
        foreach ($lead->result() as $lead_edit) { ?>
            <div class="modal fade" id="modal-edit-lead-<?php echo $j++ ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form role="form" method="post" action="<?php echo base_url('C_lead/ubah_lead/' . $lead_edit->cust_id); ?>" enctype="multipart/form-data" accept-charset="utf-8">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data Calon Customer</h4>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama_lead">Nama Perusahaan</label>
                                    <input type="text" id="nama_lead" name="nama_lead" value="<?php echo $lead_edit->cust_name ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="alamat_lead">Alamat</label>
                                    <input type="text" id="alamat_lead" name="alamat_lead" value="<?php echo $lead_edit->cust_alamat ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nama_pic">Nama PIC</label>
                                    <input type="text" id="nama_pic" name="nama_pic" value="<?php echo $lead_edit->cust_pic_name ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="no_telp_pic">No. Telp PIC</label>
                                    <input type="text" id="no_telp_pic" name="no_telp_pic" value="<?php echo $lead_edit->cust_pic_telp ?>" class="form-control">
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
        <!-- /.modal edit-->

        <!-- Modal Input Penawaran -->
        <?php
        $z = 0;
        foreach ($lead->result() as $lead_pen) {
            $produk = $this->M_data->getProdukPenawaran($lead_pen->cust_id)->result();
            $produk_ditawarkan = $this->M_data->getProdukPenawaranCust($lead_pen->cust_id)->result(); ?>
            <div class="modal fade" id="modal-input-penawaran-<?php echo $z; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Tambah Penawaran Produk ke <?php echo $lead_pen->cust_name ?></h4>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_katalog">Nama Produk *</label>
                                <select id="produk_penawaran_<?php echo $z ?>" class="form-control" data-placeholder="Pilih Produk" style="width: 100%;">
                                    <?php foreach ($produk as $data) { ?>
                                        <option value="<?php echo $data->produk_id; ?>"><?php echo $data->produk_label . ' | Rp' . number_format($data->produk_harga, 0, ',', '.'); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_katalog">Harga Yang Ditawar *</label>
                                <input type="number" id="harga_ditawar_<?php echo $z ?>" class="form-control" data-placeholder="Masukkan harga yang ditawar oleh calon cuatomer" style="width: 100%;" />
                            </div>
                            <div class="form-group">
                                <button onclick="simpanPenawaran('<?php echo $lead_pen->cust_id ?>-<?php echo $z ?>')" class="btn btn-primary">Simpan</button>
                            </div>

                            <table id="table_produk_penawaran" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Harga Produk Yang Ditawar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($produk_ditawarkan as $data) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data->produk_label; ?></td>
                                            <td><?php echo 'Rp'.number_format($data->produk_harga, 0, ',', '.').',-' ?></td>
                                            <td><?php echo 'Rp' . number_format($data->pen_det_harga, 0, ',', '.').',-'; ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-xs" title="Hapus Produk" onclick="hapusProdukPenawaran('<?php echo $data->pen_det_id ?>')"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Harga Produk Yang Ditawar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php $z++;
        }
        ?>
        <!-- End Modal Input Penawaran -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->