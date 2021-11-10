<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->

    <!-- /.navbar -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New GRN</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">New GRN</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- text input -->
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-md-4 col-form-label"> Supplier</label>
                                    <div class="col-md-8">
                                    <select id="supplier_id" class="form-control">
                                            <?php foreach ($suppliers->result() as $supplier) { ?>
                                            <option value="<?php echo $supplier->supplier_id ?>">
                                                <?php echo $supplier->supplier_id.'-'.$supplier->supplier_name ?>
                                            </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-md-4 col-form-label">Delivered Date</label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" id="delivered_date" placeholder=""
                                            name="delivered_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-md-4 col-form-label">GRN ID</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="grn_id" placeholder=""
                                            name="grn_id"  value="<?php echo $grn_id ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- text input -->
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-2 col-form-label"> Comments</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="comments" rows="3" placeholder="Enter ..."></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-4 col-form-label">Received By</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="sup_name" placeholder=""
                                        name="sup_name">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>





                <br>
                <div class="row">

                    <!-- <label for="" class="col-md-1 col-form-label">Add Items</label> -->
                    <div class="col-md-10">
                        <div class="row">

                        <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-md-4 col-form-label"> Stock ID</label>
                                    <div class="col-md-8">
                                    <select class="form-control" id="stock_id">
                                    <option value="">Select Stock</option>
                                                <?php foreach ($stocks->result() as $stock) { ?>
                                                    <option value="<?php echo $stock->stock_id ?>"><?php echo $stock->stock_id ?>
                                                    </option>
                                                <?php } ?>
                                                     
                                                </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <select id="item_code" class="form-control select2bs4">
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input type="number" class="form-control" id="item_qty" placeholder="Qty (1)">
                                    </div>
                                </div>
                            </div>

                            

                            <div class="col-md-1">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input type="button" class=" btn btn-primary" id="btn_add" value="Add">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body form-group col-sm-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Stock ID</th>
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>Item Group</th>
                                        <th>Delivered QTY</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <div class="card-body">

                                    <button type="submit" id="btn_save_grn" class="btn btn-info full-width">Save
                                        GRN</button>
                                    <a href="<?php echo base_url()?>GRN" type="button"
                                        class="btn btn-default float-right">Cancel</a>


                                </div>
                                <!-- /.card-body -->

                                <!-- /.card-footer -->
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->