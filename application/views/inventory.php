<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark" style="float:right;">Product Inventory</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Inventory</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="<?php echo base_url() ?>inventory" method="get" class="form-horizontal">
                            <div class="row">
                                <div class="col-sm-3">
                                    <!-- text input -->
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">From Date</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="from" placeholder=""
                                                   name="from"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">To Date</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="to" placeholder="" name="to">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Search by</label>
                                        <div class="col-sm-8">
                                            <select id="search_by" class="form-control" name="search_by">
                                                <option value="item">Item</option>
                                                <option value="price">Price</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <div class="col-sm-8">
                                            <select id="param" class="form-control cbItem" style="display:inline;"
                                                    name="param">
                                                <option value="">Select</option>
                                                <?php
                                                foreach ($items->result() as $row) {
                                                    ?>
                                                        <option><?php echo $row->item_code; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            <input type="text" class="form-control txtPrice" id="param2"
                                                   placeholder="Price"
                                                   style="display:none;" name="param2"/>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="submit" class="form-control btn-secondary" placeholder="Email"
                                                   value="Search"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Product Name</th>
                                        <th>Item Group(s)</th>
                                        <th>SKU</th>
                                        <th>On Hand QTY</th>
                                        <th>Reorder Level</th>
                                        <th>Unit Type</th>
                                        <th>Unit Price Rs.</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($inventory->result() as $row) {
                                        ?>
                                        <tr>
                                        <td><?php echo $row->item_code; ?></td>
                                        <td><?php echo $row->item_name; ?></td>
                                        <td><?php echo $row->sku_name; ?></td>
                                        <td><?php echo $row->sku_code; ?></td>
                                        <td><?php echo $row->qty; ?></td>
                                        <td><?php echo $row->re_order_level; ?></td>
                                        <td><?php echo $row->unit_type; ?></td>
                                        <td><?php echo $row->selling_price; ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Product Name</th>
                                        <th>Item Group(s)</th>
                                        <th>SKU</th>
                                        <th>On Hand QTY</th>
                                        <th>Reorder Level</th>
                                        <th>Unit Type</th>
                                        <th>Unit Price Rs.</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>

</body>
</html>


