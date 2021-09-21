<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add New Item</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2"></div>

                    <div class="col-sm-8">

                        <div class="card card-info">

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" action="<?php echo base_url()?>save_item" method="post">
                                <div class="card-body">

                                    <?php if ($msg) { ?>

                                        <div class="alert <?php echo $alert_type ?> alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                            <?php echo $msg ?>
                                        </div>

                                    <?php } ?>

                                    <div class="form-group row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4" style="text-align:center;">Create Item</div>
                                        <div class="col-sm-4"></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <label for="lblItemName" class="col-sm-4 col-form-label">Item Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="name"
                                                   placeholder="Item Name" name="name" required>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <label for="lblskucode" class="col-sm-4 col-form-label">SKU Code</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="sku" name="sku">
                                                <?php foreach ($skus->result() as $skus) { ?>
                                                    <option value="<?php echo $skus->id ?>"><?php echo $skus->sku_code . '-' . $skus->sku_name ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <label for="lblsuppliercode" class="col-sm-4 col-form-label">Supplier
                                            Code</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="supplier" name="supplier">
                                                <?php foreach ($suppliers->result() as $supplier) { ?>
                                                    <option value="<?php echo $supplier->id ?>"><?php echo $supplier->supplier_code.'-'.$supplier->supplier_name ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <label for="lblunittype" class="col-sm-4 col-form-label">Unit Type</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="unit_type" name="unit_type">
                                                <?php foreach ($unit_types->result() as $unit) { ?>
                                                    <option value="<?php echo $unit->type ?>"><?php echo $unit->type ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <label for="lblItemName" class="col-sm-4 col-form-label">Re-Order level</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="re_order_level"
                                                   placeholder="Re order Level" name="re_order_level" required>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <label for="lblstatus" class="col-sm-4 col-form-label">Status</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="col-sm-4"></div>
                                            <button type="button" class="col-sm-8 btn btn-danger" style="float:right;">
                                                Cancel
                                            </button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="submit" class="col-sm-8 btn btn-primary">Save</button>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <!-- /.card-footer -->
                            </form>
                        </div>

                    </div>

                    <div class="col-sm-2"></div>

                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->




