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
                        <h1>Delivery Notes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Delivert Note</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dilivery Note List
                        <button id="add_new_grn" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-default">
                            <i class="fa fa-plus"></i> &nbsp;&nbsp; New Delivery Note</button>
                    </h3>


                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DN ID</th>
                                <th>Supplier ID</th>
                                <th>Order ID</th>
                                <th>issue Date</th>
                                <th>Delivery Date</th>
                                <th>Item Qty</th>

                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Delivery Note</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <form id="form_data" method="post"
                    action="<?php echo base_url() ?>index.php/user/user/add_new_sys_user_page">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Supplier ID</label>
                                    <select class="form-control">
                                        <option>SUP-032</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <li class="fa fa-user">&nbsp;&nbsp;</li>
                                    <label for="input_username">Supplier Name</label>
                                    <br />
                                    <input class="form-control input-rounded" name="suppliername" id="input_username"
                                        placeholder="Supllier Name" required="" type="text">
                                </div>
                            </div>



                        </div>



                        <div class="form-group">
                            <label>Order ID</label>
                            <select class="form-control">
                                <option>ORD-014</option>

                            </select>
                        </div>




                        <div class="form-group">
                            <li class="fa fa-calendar">&nbsp;&nbsp;</li>
                            <label for="input_username">Issue Date</label>
                            <br />
                            <input class="form-control input-rounded" name="issue_date" id="issue_date"
                                placeholder="" required="">
                        </div>



                        <div class="form-group">
                            <li class="fa fa-calendar">&nbsp;&nbsp;</li>
                            <label for="input_username">Delivery Date</label>
                            <br />
                            <input class="form-control input-rounded" name="deleivery_date" id="deleivery_date"
                                placeholder="" required="">
                        </div>




                        <div class="form-group">
                            <li class="fa fa-chair">&nbsp;&nbsp;</li>
                            <label for="input_username">Item QTY</label>
                            <br />
                            <input class="form-control input-rounded" name="item_qty" id="item_qty" placeholder=""
                                required="">
                        </div>





                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-sm btn-white m-r-5 m-b-5"
                                data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-sm btn-primary m-r-5 m-b-5 ">
                                <i class="fa "></i>
                                Save
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>