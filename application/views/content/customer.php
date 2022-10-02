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
                                foreach ($customer->result() as $data) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data->cust_name ?></td>
                                        <td><?php echo $data->cust_alamat ?></td>
                                        <td><?php echo $data->cust_pic_name ?></td>
                                        <td><?php echo $data->cust_pic_telp ?></td>
                                        <td><?php echo $data->stat_cust_label ?></td>
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal-input-penawaran-<?php echo $i ?>" title="Produk Yang Dibeli"><i class="fa fa-info"></i></button></td>
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

        <!-- Modal Penawaran -->
        <?php
        $z = 0;
        foreach ($customer->result() as $cust) {
            $produk = $this->M_data->getProdukPenawaran($cust->cust_id)->result();
            $produk_ditawarkan = $this->M_data->getProdukPenawaranCust($cust->cust_id)->result(); ?>
            <div class="modal fade" id="modal-input-penawaran-<?php echo $z; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Data Produk Yang Dibeli Oleh <?php echo $cust->cust_name ?></h4>
                        </div>

                        <div class="modal-body">
                            <table id="table_produk_dibeli" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Harga Produk Yang Ditawar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($produk_ditawarkan as $data) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data->produk_label; ?></td>
                                            <td><?php echo 'Rp'.number_format($data->produk_harga, 0, ',', '.').',-'; ?></td>
                                            <td><?php echo 'Rp'.number_format($data->pen_det_harga, 0, ',', '.').',-'; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Harga Produk Yang Ditawar</th>
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
        <!-- End Modal Penawaran -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->