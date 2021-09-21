<!-- Content Wrapper. Contains page content -->

<?php

$header = $customer_details->row();

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i>Kithmi Holdings Hardware Store<br>
                                </h4>
                                <h6>
                                    Building Number : Building 10<br>
                                    Contact Nmber: 011-1112223<br>
                                </h6>
                                <br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">

                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <strong>Customer</strong><br>
                                <address>
                                    Name: <?php echo $header->customer_name !='' ? $header->customer_name : "(Empty)"; ?><br>
                                    Address: <?php echo $header->address !='' ? $header->address : "(Empty)"; ?><br>
                                    Phone: <?php echo $header->telephone !='' ? $header->telephone : "(Empty)"; ?><br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Date:</b> <?php echo $header->invoice_date?><br>
                                <b>Invoice:</b> <?php echo $header->invoice_number?><br>
                                <br>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>Item Group</th>
                                        <th>Unit Price Rs.</th>
                                        <th>Qty Type</th>
                                        <th>Qty</th>
                                        <th>Discount</th>
                                        <th>Sub Total (Rs.)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($invoice_details->result() as $line) { ?>
                                        <tr>
                                            <td><?php echo $line->item_code?></td>
                                            <td><?php echo $line->item_name?></td>
                                            <td><?php echo $line->sku_name?></td>
                                            <td><?php echo number_format($line->unit_price,2,'.',',')?></td>
                                            <td><?php echo $line->unit_type?></td>
                                            <td><?php echo $line->qty?></td>
                                            <td><?php echo $line->discount?>%</td>
                                            <td><?php echo number_format($line->total_price,2,'.',',')?></td>
                                        </tr>

                                        <?php }?>



                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">

                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Total</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Gross total:</th>
                                            <td><?php echo number_format($header->gross_total,2,'.',',')?></td>
                                        </tr>
                                        <tr>
                                            <th>Tax (%) </th>
                                            <td><?php echo $header->tax?></td>
                                        </tr>
                                        <tr>
                                            <th>Discount:</th>
                                            <td><?php echo number_format( $header->discount,2,'.',',')?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Payable:</th>
                                            <td><?php echo number_format($header->net_total,2,'.',',')?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                            class="fas fa-print"></i> Print</a>

                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>