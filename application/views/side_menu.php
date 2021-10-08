<!-- Main Sidebar Container -->

<?php

if (!isset($active_main_tab))
    $active_main_tab = '';
//die();
?>

<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?php echo base_url() ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Kethmi Holdings</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library  -->

                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>dashboard"
                       class="nav-link <?php if ($active_tab == 'Dashboard') echo "active" ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php if ($active_main_tab == 'Administration') echo "menu-open" ?> ">
                    <a href="#" class="nav-link <?php if ($active_main_tab == 'Administration') echo "active" ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Administration
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="<?php echo base_url() ?>user/user"
                               class="nav-link <?php if ($active_tab == 'user_list') echo "active" ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url() ?>user/user/user_group_list"
                               class="nav-link <?php if ($active_tab == 'group_list') echo "active" ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Groups</p>
                            </a>
                        </li>

                    </ul>
                </li>
<!--                <li class="nav-item has-treeview ">-->
<!--                    <a href="#" class="nav-link --><?php //if ($active_tab == 'invoice') echo "active" ?><!--">-->
<!--                        <i class="nav-icon fas fa-list-alt"></i>-->
<!--                        <p>-->
<!--                            Invoice-->
<!--                            <i class="right fas fa-angle-left"></i>-->
<!--                        </p>-->
<!--                    </a>-->
<!--                    <ul class="nav nav-treeview ">-->
<!--                        <li class="nav-item">-->
<!--                            <a href="--><?php //echo base_url() ?><!--invoice"-->
<!--                               class="nav-link --><?php //if ($active_tab == 'Invoice') echo "active" ?><!--">-->
<!--                                <i class="far fa-circle nav-icon"></i>-->
<!--                                <p>Generate Invoice</p>-->
<!--                            </a>-->
<!--                        </li>-->
<!---->
<!--                    </ul>-->
<!--                </li>-->
<!-- 
                <li class="nav-item has-treeview <?php if ($active_main_tab == 'add_sku' || $active_tab == 'view_sku') echo "menu-open" ?> ">
                    <a href="#"
                       class="nav-link <?php if ($active_main_tab == 'add_sku' || $active_tab == 'view_sku') echo "active" ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            SKU
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url() ?>add_sku"
                               class="nav-link <?php if ($active_tab == 'add_sku') echo "active" ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create SKU</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url() ?>view_sku"
                               class="nav-link <?php if ($active_tab == 'view_sku') echo "active" ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View SKU</p>
                            </a>
                        </li>


                    </ul>
                </li> -->
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>suppliers"
                       class="nav-link <?php if ($active_tab == 'suppliers') echo "active" ?>">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Suppliers
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php if ($active_main_tab == 'Inventory' || $active_tab == 'item_update') echo "menu-open" ?> ">
                    <a href="#"
                       class="nav-link <?php if ($active_main_tab == 'Inventory' || $active_tab == 'item_update') echo "active" ?>">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url() ?>inventory"
                               class="nav-link <?php if ($active_tab == 'Inventory') echo "active" ?>">
                                <p>
                                    View Inventory
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url() ?>add_stock"
                               class="nav-link <?php if ($active_tab == 'add_stock') echo "active" ?>">
                                <p>
                                    Add Stock
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview ">

                </li>
<!--                <li class="nav-item has-treeview ">-->
<!--                    <a href="--><?php //echo base_url() ?><!--invoicelist"-->
<!--                       class="nav-link --><?php //if ($active_tab == 'InvoiceList') echo "active" ?><!--">-->
<!--                        <i class="nav-icon fa fa-sticky-note"></i>-->
<!--                        <p>-->
<!--                            Invoice List-->
<!--                        </p>-->
<!--                    </a>-->
<!--                </li>-->
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>item_create"
                       class="nav-link <?php if ($active_tab == 'item_create') echo "active" ?>">
                        <i class="nav-icon fa fa-hourglass-start"></i>
                        <p>
                            Item Create
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>item_list"
                       class="nav-link <?php if ($active_tab == 'item_list') echo "active" ?>">
                        <i class="nav-icon fa fa-plus"></i>
                        <p>
                            Item List
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>itemsaleshistory"
                       class="nav-link <?php if ($active_tab == 'Itemsaleshistory') echo "active" ?>">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>
                            Item Sales History
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>dashboard/salestransaction"
                       class="nav-link <?php if ($active_tab == 'Salestransaction') echo "active" ?>">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Sales Transaction
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>dashboard/order_list"
                       class="nav-link <?php if ($active_tab == 'order_list') echo "active" ?>">
                        <i class="nav-icon fa fa-briefcase"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php if ($active_main_tab == 'salesreport' || $active_tab == 'inventoryreport' || $active_tab == 'purchase_order_report') echo "menu-open" ?> ">
                    <a href="#"
                       class="nav-link <?php if ($active_main_tab == 'salesreport' || $active_tab == 'inventoryreport' || $active_tab == 'purchase_order_report') echo "active" ?>">
                        <i class="nav-icon fa fa-file-alt"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url() ?>dashboard/salesreport"
                            class="nav-link <?php if ($active_tab == 'salesreport') echo "active" ?>">
                                <i class="nav-icon fa fa-file-alt"></i>
                                <p>
                                    Sales Report
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url() ?>dashboard/inventoryreport"
                            class="nav-link <?php if ($active_tab == 'inventoryreport') echo "active" ?>">
                                <i class="nav-icon fa fa-file-alt"></i>
                                <p>
                                    Inventory Report
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url() ?>dashboard/purchase_order_report"
                            class="nav-link <?php if ($active_tab == 'purchase_order_report') echo "active" ?>">
                                <i class="nav-icon fa fa-file-alt"></i>
                                <p>
                                    Purchase Order Report
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                
                

                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>GRN"
                       class="nav-link <?php if ($active_tab == 'GRN') echo "active" ?>">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            GRN
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>delivery_note"
                       class="nav-link <?php if ($active_tab == 'delivetynote') echo "active" ?>">
                        <i class="nav-icon fas fa-envelope-open"></i>
                        <p>
                            Delivery Note
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="<?php echo base_url() ?>supplier_invoice"
                       class="nav-link <?php if ($active_tab == 'supplier_invoice') echo "active" ?>">
                        <i class="nav-icon fa fa-credit-card"></i>
                        <p>
                            Supplier Invoice
                        </p>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<body class="hold-transition sidebar-mini layout-fixed">
