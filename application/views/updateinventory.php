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
                            <li class="breadcrumb-item active">Add items to Inventory</li>
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
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" action="<?php echo base_url()?>save_item_inventory" method="post">
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
                                        <div class="col-sm-4 col-form-label" style="text-align:center;">Add items to Inventory
                                        </div>
                                        <div class="col-sm-4"></div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">SKU Code</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="sku_code" name="sku_code">
                                                <?php foreach ($skus->result() as $sku) { ?>
                                                    <option value="<?php echo $sku->id ?>"><?php echo $sku->sku_code . '-' . $sku->sku_name ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-6 col-form-label">Item Code</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="item_code" name="item_code">
                                                <?php foreach ($items->result() as $item) { ?>
                                                    <option value="<?php echo $item->id ?>"><?php echo $item->item_code . '-' . $item->item_name ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">Purchase Qty</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="qty" placeholder="100"
                                                   name="qty" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">Purchase Price
                                            (Rs.)</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="price" placeholder="900"
                                                   name="price" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">Purchase Date</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="date" name="date" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">Profit Margin
                                            Type</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="profit_type" name="profit_type">
                                                <option>Amount</option>
                                                <option>Percentage</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">Profit Margin</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="profit_margin"
                                                   name="profit_margin" value="0" placeholder="5" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-6 col-form-label">Selling</label>
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control" id="selling_price"
                                                   name="selling_price" placeholder="945">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="form-group row">

                                        <div class="col-sm-6">

                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-secondary">Cancel</button>
                                            <button type="submit" class="btn btn-secondary">Save</button>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-sm-2"></div>
                </div>


            </div>
        </section>

    </div>
    <!-- /.content-wrapper -->
</div>





