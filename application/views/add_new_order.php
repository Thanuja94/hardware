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
                        <h1>Add New Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">New Order</li>
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
                                    <label for="inputEmail3" class="col-md-4 col-form-label"> Supplier ID</label>
                                    <div class="col-md-8">
                                        <select class="form-control">
                                            <option>SUP-032</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-md-4 col-form-label">Supplier Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="sup_name" placeholder=""
                                            name="sup_name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-md-4 col-form-label">Order Date</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="order_date" placeholder=""
                                            name="order_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <div class="row">
                    <label for="" class="col-md-1 col-form-label">Add Items</label>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <select id="item_code" class="form-control select2bs4">
                                            <option>ITM-032</option>
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
                    <div class="col-md-8">
                        <div class="card-body form-group col-sm-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>Item Brand</th>
                                        <th>Item QTY</th>


                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <div class="card-body">

                                    <button type="submit" id="btn_save_tans" class="btn btn-info full-width">Save
                                        Order</button>
                                    <a href="<?php echo base_url()?>order_list" type="button"
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