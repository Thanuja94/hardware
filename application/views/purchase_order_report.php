<div class="wrapper">

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-8">
                        <title>Kethmi Holding Hardware Stores </title>
                        <h3 class="m-0 text-dark" style="text-align:right;">Kethmi Holding Hardware Stores</h3>
                        <h5 class="m-0 text-dark" style="text-align:right;">Building No, Street Name, City, Street,Zip
                        </h5>
                        <h5 class="m-0 text-dark" style="text-align:right;">Contact No: 011 255 6666 / 077 5677 722</h5>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Purchase Order Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4" style="text-align:center;">
                        <h5>Purchase Order Report</h5>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-9">
                        <form action="" method="GET" class="">

                        <div class="row">

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">From Date</label>
                                <div class="col-sm-8">
                                    <input type="date" value="<?php echo $this->input->get('from')?>"
                                        class="form-control" id="from" placeholder="" name="from">
                                </div>
                            </div>
                            </div>

                            <div class="col-md-4">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">To Date</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" value="<?php echo $this->input->get('to')?>"
                                        id="to" placeholder="" name="to">
                                </div>
                            </div>
                            </div>


                            <div class="col-md-3">

                            <input type="submit" class=" btn btn-primary" id="btn_add" value="Filter">
                            </div>
                        </div>

                        </form>
                    </div>

                    


                </div>


                <div class="row">

                    <div class="col-sm-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="purchaseorderreporttable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align:left;">Item Code</th>
                                            <th style="text-align:left;">Product Name</th>
                                            <th style="text-align:left;">Item Group</th>
                                            <th style="text-align:left;">Unit Type</th>
                                            <th style="text-align:left;">Unit Price (Rs.)</th>
                                            <th style="text-align:left;">Purchased Qty</th>
                                            <th style="text-align:left;">Supplier</th>
                                            <th style="text-align:left;">Total Price (Rs.)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($purchased_data->result() as $purchase) { ?>
                                        <tr>
                                            <td><?php echo $purchase->item_code ?></td>
                                            <td><?php echo $purchase->item_name ?></td>
                                            <td><?php echo $purchase->item_group ?></td>
                                            <td><?php echo $purchase->unit_type ?></td>
                                            <td><?php echo number_format($purchase->unit_price, 2, '.', ',') ?></td>
                                            <td><?php echo $purchase->item_qty ?></td>
                                            <td><?php echo $purchase->supplier_id ?></td>
                                            <td><?php echo number_format($purchase->total_price, 2, '.', ',') ?></td>

                                        </tr>
                                        <?php } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>