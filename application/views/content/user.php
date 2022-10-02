<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Pengguna CRM
            <small>Pengguna CRM PT Smart</small><br /><br />
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-tambah-user">Tambah Data Pengguna</button>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Pengguna CRM PT Smart</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table-lead" class="table table-bordered table-striped table-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $i = 0;
                                foreach ($user->result() as $data) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data->user_username ?></td>
                                        <td><?php echo $data->usr_role_name ?></td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-user-<?php echo $i ?>" title="Edit Data"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger" onclick="hapusUser(<?php echo $data->user_id ?>)" title="Hapus Data"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php $i++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>71
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!--modal tambah-->
        <div class="modal fade" id="modal-tambah-user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Tambah Data Pengguna CRM</h4><br />
                        <div id="alert_add_user"></div>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Username *</label>
                            <input type="text" id="username_tambah" name="username" placeholder="Contoh: nama@smart.id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role *</label>
                            <select id="role_tambah" name="role" class="form-control" required>
                                <?php foreach ($role->result() as $data_role) { ?>
                                    <option value="<?php echo $data_role->usr_role_id ?>"><?php echo ucwords($data_role->usr_role_name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password *</label>
                            <input type="password" id="pass_tambah" name="pass" class="form-control" placeholder="password" required>
                        </div>
                        <div class="form-group">
                            <label for="repass">Retype Password *</label>
                            <input type="password" id="repass_tambah" name="repass" class="form-control" placeholder="password" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="tambahUser()">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal tambah-->

        <!--modal edit-->
        <?php
        $j = 0;
        foreach ($user->result() as $user_edit) { ?>
            <div class="modal fade" id="modal-edit-user-<?php echo $j ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Data Pengguna</h4><br />
                            <div id="alert_user_ubah"></div>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="username">Username *</label>
                                <input type="text" id="username_ubah_<?php echo $j ?>" name="username" placeholder="Contoh: nama@smart.id" class="form-control" value="<?php echo $user_edit->user_username ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select id="role_ubah_<?php echo $j ?>" name="role" class="form-control" required>
                                    <?php foreach ($role->result() as $data_role) {
                                        if ($user_edit->usr_role_id == $data_role->usr_role_id) { ?>
                                            <option value="<?php echo $data_role->usr_role_id ?>" selected><?php echo ucwords($data_role->usr_role_name) ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $data_role->usr_role_id ?>"><?php echo ucwords($data_role->usr_role_name) ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" id="pass_ubah_<?php echo $j ?>" name="pass" class="form-control" placeholder="kosongkan jika tidak ingin mengubah password">
                            </div>
                            <div class="form-group">
                                <label for="repass">Retype Password</label>
                                <input type="password" id="repass_ubah_<?php echo $j ?>" name="repass" class="form-control" placeholder="kosongkan jika tidak ingin mengubah password">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="ubahUser('<?php echo $user_edit->user_id ?>','<?php echo $j ?>')">Simpan</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php $j++;
        }
        ?>
        <!-- /.modal edit-->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->