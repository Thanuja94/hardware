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
                        <h1>Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
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
                    <h3 class="card-title">Order List &nbsp; &nbsp;
                        <a href="<?php echo base_url()?>add_new_order">
                            <button id="add_new_order" class="btn btn-primary">
                                <i class="fa fa-plus"></i> &nbsp;&nbsp; New Order</button>
                        </a>
                    </h3>


                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Supplier ID</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders->result() as $order) { ?>
                            <tr>
                                <td><?php echo $order->id ?></td>
                                <td><?php echo $order->order_id ?></td>
                                <td><?php echo $order->order_date ?></td>
                                <td><?php echo $order->supplier_id ?></td>
                                <!-- <td><?php echo $order->status ?></td> -->
                                <td> <span
                                        class="right badge <?php echo $order->status == 0 ? "badge-warning" : (($order->status == 1) ? "badge-success" : "badge-danger") ?>"><?php echo $order->status == 0 ? "Pending" : (($order->status == 1) ? "Approved" : "Reject") ?></span>
                                </td>
                                <td><a href="<?php echo base_url() ?>update_order_status_approve?order_id=<?php echo $order->order_id?>" class="btn btn-success">Approve</a>
								<a href="<?php echo base_url() ?>update_order_status_reject?order_id=<?php echo $order->order_id?>" class="btn btn-danger">Reject</a>
                                </td>


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



<!-- 
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Order Status  </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_data" method="post" action="<?php echo base_url() ?>update_order_status">
                    <div class="modal-body">
                        <div class="form-group">
						<button type="button" class="btn btn-success">Approve</button>
						<button type="button" class="btn btn-danger">Reject</button>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       
                    </div>
                </form>
            </div>
            
        </div>
       
    </div>
   -->