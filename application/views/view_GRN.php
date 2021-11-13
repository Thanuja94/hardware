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
                        <h1 class="m-0 text-dark">Good Receive Note</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">GRN</li>
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
                    <h3 class="card-title">GRN List &nbsp; &nbsp;
                    <a href="<?php echo base_url()?>add_new_grn"> 
                    <button id="add_new_grn" class="btn btn-primary"  >
                       
                       <i class="fa fa-plus"></i> &nbsp;&nbsp; New GRN</button>
                    </a>

                        <!-- <button id="add_new_grn" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-default">
                            <i class="fa fa-plus"></i> &nbsp;&nbsp; New GRN</button> -->
                    </h3>


                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>GRN ID</th>
                                <th>Supplier ID</th>
                                <th>Delivered Date</th>
                                <!-- <th>Delivered QTY</th> -->
                                <th>Comments</th>
                                <th>Received By</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grns->result() as $grn) { ?>
                            <tr>
                                <td><?php echo $grn->id ?></td>
                                <td><?php echo $grn->GRN_id ?></td>
                                <td><?php echo $grn->supplier_id ?></td>
                                <td><?php echo $grn->delivered_date ?></td>
                                <td><?php echo $grn->comments ?></td>
                                <td><?php echo $grn->received_by ?></td>
                                
                                <!-- <td><?php echo $order->status ?></td> -->
                                


                                <!-- onclick="alert();"  -->

                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New GRN</h4>
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
                            <label>Stock ID</label>
                            <select class="form-control">
                                <option>STO-012</option>

                            </select>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <li class="fa fa-calendar">&nbsp;&nbsp;</li>
                                    <label for="input_username">Deliverd Date</label>
                                    <br />
                                    <input class="form-control input-rounded" name="deleivered_date"
                                        id="deleivered_date" placeholder="" required="">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <li class="fa fa-user">&nbsp;&nbsp;</li>
                                    <label for="input_username">Deliverd QTY</label>
                                    <br />
                                    <input class="form-control input-rounded" name="deleivered_qty" id="deleivered_qty"
                                        placeholder="" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Comments</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>

                        <div class="form-group">
                            <li class="fa fa-user">&nbsp;&nbsp;</li>
                            <label for="input_username">Received By</label>
                            <br />
                            <input class="form-control input-rounded" name="received_by" id="received_by" placeholder=""
                                required="">
                        </div>


                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-sm btn-white m-r-5 m-b-5"
                                data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-sm btn-primary m-r-5 m-b-5 ">
                                <i class="fa "></i>
                                Save GRN
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div> -->