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
                        <h1 class="m-0 text-dark">Suppliers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Suppliers</li>
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
                    <h3 class="card-title">Supplier List
                        <button id="add_new_supplier" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-default">
                            <i class="fa fa-plus"></i> &nbsp;&nbsp; New Supplier</button>
                    </h3>


                    <br>

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Supplier ID</th>
                                <th>Supplier Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <!-- <th style="text-align:center">Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($suppliers->result() as $supplier) { ?>
                            <tr>
                                <td><?php echo $supplier->id ?></td>
                                <td><?php echo $supplier->supplier_id ?></td>
                                <td><?php echo $supplier->supplier_name ?></td>
                                <td><?php echo $supplier->address_line_3 ?></td>
                                <td><?php echo $supplier->sup_tel_no ?></td>
                                <td><?php echo $supplier->supplier_email ?></td>
                                <!-- <td> <span class="right badge <?php echo $item->status ? "badge-success" :"badge-danger" ?>"><?php echo $item->status ? "Active" :"In-active" ?></span> </td>
                                            <td><span class="fa fa-pen" onclick="alert();"></span></td> -->
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
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form id="form_data" method="post" action="<?php echo base_url() ?>save_suppliers">
                <div class="modal-body">


                    <div class="form-group">
                        <li class="fa fa-user">&nbsp;&nbsp;</li>
                        <label for="input_username">Supplier Name</label>
                        <br />
                        <input class="form-control input-rounded" name="supplier_name" id="supplier_name"
                            placeholder="Supllier Name" required="" type="text">
                    </div>

                    <div class="form-group">
                        <li class="fa fa-home">&nbsp;&nbsp;</li>
                        <label>Supplier Address Line 1</label>
                        <input class="form-control input-rounded" name="adderss1" id="adderss1"
                            placeholder="supplier address line 1" required="" type="text">
                    </div>

                    <div class="form-group">
                        <li class="fa fa-home">&nbsp;&nbsp;</li>
                        <label>Supplier Address Line 2</label>
                        <input class="form-control input-rounded" name="adderss2" id="adderss2"
                            placeholder="supplier address line 2" required="" type="text">
                    </div>

                    <div class="form-group">
                        <li class="fa fa-home">&nbsp;&nbsp;</li>
                        <label>Supplier Address Line 3</label>
                        <input class="form-control input-rounded" name="adderss3" id="adderss3"
                            placeholder="supplier address line_3" required="" type="text">
                    </div>

                    <div class="form-group">
                        <li class="fa fa-envelope">&nbsp;&nbsp;</li>
                        <label>Email</label>
                        <input class="form-control input-rounded" name="email" id="email" placeholder="Email"
                            required="" type="email">
                    </div>

                    <div class="form-group">
                        <li class="fa fa-phone">&nbsp;&nbsp;</li>
                        <label>Supplier Contact</label>
                        <input class="form-control input-rounded" name="contact_number" id="contact_number"
                            placeholder="contact number" required="" type="text">
                    </div>



                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-sm btn-white m-r-5 m-b-5" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-sm btn-primary m-r-5 m-b-5 ">
                            <i class="fa fa-user"></i>
                            Submit
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>

<!-- <script>
    $('#modal-dialog').modal({backdrop: 'static', keyboard: false})
</script> -->