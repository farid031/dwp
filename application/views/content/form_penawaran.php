<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Penawaran Produk Ke <?php echo $lead->cust_name ?><br /><br />
            <button class="btn btn-success btn-sm" onclick="closePage()">Kembali</button>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Penawaran Produk Ke <?php echo $lead->cust_name ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" action="<?php echo base_url('C_lead/simpan_penawaran/' . $this->uri->segment(3)) ?>" method="post">
                            <div class="form-group">
                                <label for="nama_katalog">Nama Produk *</label>
                                <select name="produk_penawaran" id="produk_penawaran" class="form-control" data-placeholder="Pilih Produk" style="width: 100%;">
                                    <?php foreach ($produk->result() as $data) { ?>
                                        <option value="<?php echo $data->produk_id; ?>"><?php echo $data->produk_label . ' | Rp' . number_format($data->produk_harga, 0, ',', '.'); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_katalog">Harga Yang Ditawar *</label>
                                <input type="number" name="harga_ditawar" id="harga_ditawar" class="form-control" data-placeholder="Masukkan harga yang ditawar oleh calon cuatomer" style="width: 100%;" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>

                        <table id="table_produk_penawaran" class="table table-bordered table-striped table-datatable">
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
                                foreach ($produk_ditawarkan->result() as $data) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data->produk_label; ?></td>
                                        <td><?php echo 'Rp' . number_format($data->produk_harga, 0, ',', '.') . ',-' ?></td>
                                        <td><?php echo 'Rp' . number_format($data->pen_det_harga, 0, ',', '.') . ',-'; ?></td>
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->