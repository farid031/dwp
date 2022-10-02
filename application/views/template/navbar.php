<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b>LTE</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url('assets/template/dist/img/user2-160x160.jpg') ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $_SESSION['nama'] ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url('assets/template/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('C_login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo base_url('assets/template/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $_SESSION['nama'] ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <?php if ($this->uri->segment(1) == 'C_beranda') { ?>
                        <li class="active"><a href="<?php echo base_url('C_beranda') ?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo base_url('C_beranda') ?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                    <?php } ?>
                    <?php if ($this->uri->segment(1) == 'C_lead') { ?>
                        <li class="active">
                            <a href="<?php echo base_url('C_lead') ?>">
                                <i class="fa fa-user-plus"></i> <span>Lead</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo base_url('C_lead') ?>">
                                <i class="fa fa-user-plus"></i> <span>Lead</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->uri->segment(1) == 'C_produk') { ?>
                        <li class="active">
                            <a href="<?php echo base_url('C_produk') ?>">
                                <i class="fa fa-database"></i> <span>Produk</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo base_url('C_produk') ?>">
                                <i class="fa fa-database"></i> <span>Produk</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->uri->segment(1) == 'C_penawaran') { ?>
                        <li class="active">
                            <a href="<?php echo base_url('C_penawaran') ?>">
                                <i class="fa fa-file"></i> <span>Quotation</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo base_url('C_penawaran') ?>">
                                <i class="fa fa-file"></i> <span>Quotation</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->uri->segment(1) == 'C_persetujuan') { ?>
                        <li class="active">
                            <a href="<?php echo base_url('C_persetujuan') ?>">
                                <i class="fa fa-check"></i> <span>Manager Approval</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo base_url('C_persetujuan') ?>">
                                <i class="fa fa-check"></i> <span>Manager Approval</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?php echo base_url('assets/template/pages/widgets.html') ?>">
                            <i class="fa fa-th"></i> <span>Customer</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>