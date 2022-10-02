<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Penawaran
            <small>penawaran PT Smart</small><br /><br />
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Penawaran PT Smart</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table-produk-ditawarkan" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat</th>
                                    <th>Status Penawaran</th>
                                    <th>Jumlah Produk Yang Ditawarkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $i = 0;
                                foreach ($penawaran->result() as $data) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data->cust_name ?></td>
                                        <td><?php echo $data->cust_alamat ?></td>
                                        <td><?php echo $data->status ?></td>
                                        <td><?php echo $data->jml_produk ?></td>
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal-produk-penawaran-<?php echo $i++ ?>" title="Lihat Produk Yang Ditawarkan"><i class="fa fa-info"></i></button></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat</th>
                                    <th>Status Penawaran</th>
                                    <th>Jumlah Produk Yang Ditawarkan</th>
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

        <!-- Modal Produk Penawaran -->
        <?php
        $z = 0;
        foreach ($penawaran->result() as $pen) {
            $produk = $this->M_data->getProdukPenawaran($pen->cust_id)->result();
            $produk_ditawarkan = $this->M_data->getProdukPenawaranCust($pen->cust_id)->result(); ?>
            <div class="modal fade" id="modal-produk-penawaran-<?php echo $z; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Produk Yang Ditawarkan ke <?php echo $pen->cust_name ?></h4>
                        </div>

                        <div class="modal-body">
                            <table id="table_produk_penawaran" class="table table-bordered table-striped">
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
                                            <td><?php echo $data->produk_harga; ?></td>
                                            <td><?php echo $data->pen_det_harga; ?></td>
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
        <!-- End Modal Produk Penawaran -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->