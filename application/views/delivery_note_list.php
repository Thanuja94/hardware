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

                    <?php if ($msg) { ?>

                    <div class="alert <?php echo $alert_type ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <?php echo $msg ?>
                    </div>

                    <?php } ?>
                    <h3 class="card-title">Dilivery Note List &nbsp; &nbsp;
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
                        <tbody>
                            <?php foreach ($deliveries->result() as $delivery) { ?>
                            <tr>
                                <td><?php echo $delivery->id ?></td>
                                <td><?php echo $delivery->DN_id ?></td>
                                <td><?php echo $delivery->supplier_id ?></td>
                                <td><?php echo $delivery->order_id ?></td>
                                <td><?php echo $delivery->issue_date ?></td>
                                <td><?php echo $delivery->delivery_date ?></td>
                                <td><?php echo $delivery->item_qty ?></td>
								

                                <!-- onclick="alert();"  -->

                            </tr>

                            <?php } ?>
                        </tbody>
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
                <form id="form_data" method="post" action="<?php echo base_url() ?>save_delivery_note">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Delivery Note ID</label>
                                    <input class="form-control input-rounded" name="DN_id" id="DN_id" placeholder=""
                                        value="<?php echo $DN_id ?>">
                                </div>
                            </div>




                        </div>
                        <div class="form-group">
                            <label>Order ID</label>
                            <select id="order_id" name="order_id" class="form-control">
                                <?php foreach ($order_list->result() as $order) { ?>
                                <option value="<?php echo $order->order_id ?>">
                                    <?php echo $order->order_id ?>
                                </option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Supplier ID</label>
                                    <select id="supplier_id" name="supplier_id" class="form-control">
                                        <?php foreach ($suppliers->result() as $supplier) { ?>
                                        <option value="<?php echo $supplier->supplier_id ?>">
                                            <?php echo $supplier->supplier_id.'-'.$supplier->supplier_name ?>
                                        </option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <li class="fa fa-calendar">&nbsp;&nbsp;</li>
                            <label for="input_username">Issue Date</label>
                            <br />
                            <input class="form-control input-rounded" name="issue_date" id="issue_date" placeholder=""
                                type="date" required="">
                        </div>



                        <div class="form-group">
                            <li class="fa fa-calendar">&nbsp;&nbsp;</li>
                            <label for="input_username">Delivery Date</label>
                            <br />
                            <input class="form-control input-rounded" name="delivery_date" id="delivery_date"
                                placeholder="" type="date" required="">
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