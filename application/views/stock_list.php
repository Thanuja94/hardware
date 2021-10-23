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
                            <li class="breadcrumb-item active">Stock List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->


        <section class="content">
            <div class="container-fluid">
                <div class="form-group row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 col-form-label" style="text-align:center;">Stock List</div>
                    <div class="col-sm-4"></div>
                </div>

                <div class="row">
                    <div class="col-sm-10">
                        <form action="" method="get" class="form-horizontal">
                            <div class="row">
                                <div class="col-sm-8">
                                    <!-- text input -->
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Search by:</label>
                                        <div class="col-sm-4">
                                            <select id="drpoption" class="form-control" name="drpoption">
                                                <option>By Stock ID</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select id="item_code" class="form-control" name="item_code">

                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="submit" class="form-control btn-secondary" value="Search" />
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>
                                </div>

                            </div>
                        </form>


                    </div>
                    <div class="col-sm-2">
                        <button id="add_new_stock" class="btn btn-dark" data-toggle="modal"
                            data-target="#modal-default">
                            <i class="fa fa-plus"></i> Add Stock</button>
                        <!-- <button type="submit" class="btn btn-dark">Add Stock</button> -->
                    </div>


                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body col-sm-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Stock ID</th>
                                            <th>Purchased Date</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stocks->result() as $stock) { ?>
                                        <tr>
                                            <td><?php echo $stock->stock_id ?></td>
                                            <td><?php echo $stock->purchase_date ?></td>
                                            <td> <a href="<?php echo base_url()?>itemupdate" class="btn btn-primary">Add
                                                    Items</a></td>
                                        </tr>

                                        <?php } ?>
                                    </tbody>
                                    <!-- <tbody>
                                    <tr>
                                        <td>STO-001</td>
                                        <td>10/10/2021</td>
                                        <td> <a href="<?php echo base_url()?>itemupdate" class="btn btn-primary" >Add Items</a></td>
                                    </tr>
                                    </tbody> -->

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->


    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                </div>

                <form id="form_data" method="post" action="<?php echo base_url() ?>save_stock">
                    <div class="modal-body">
                        <div class="form-group">
                            <li class="fa fa-calendar">&nbsp;&nbsp;</li>
                            <label>Purchased Date</label>
                            <input class="form-control input-rounded" id="purchased_date" name="purchased_date"
                                placeholder="Enter Purchase Date" required="" type="date">
                        </div>




                        <div class="modal-footer">
                            <div class="col-md-4 pull-right">
                                <button type="submit" class="btn btn-primary m-r-5 m-b-5">
                                    <i class="fa fa-user"></i>
                                    Submit
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>