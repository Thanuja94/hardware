<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Item Sales History</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Item Sales History</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->


        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <form action="" method="GET" class="form-horizontal">
                        <div class="row mb-2" style="flex:auto;">
                            <div id="block1" class="form-group col-sm-0.5" style="flex:auto;">

                            </div>
                            <div id="block1" class="form-group col-sm-1.5">
                                Date Range
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <!-- <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div> -->
                                    <input type="date" name="from" class="form-control float-right" value="<?php echo isset($_GET['from']) ? $_GET['from'] : "" ?>">
                                    <input type="date" name="to" class="form-control float-right" value="<?php echo isset($_GET['to']) ? $_GET['to'] : "" ?>">
                                </div>

                            </div>

                            <div class="form-group col-sm-1">

                            </div>

                            <div id="block3" class="form-group col-sm-1.5">
                                Filter by Item code
                            </div>

                            <div class="form-group col-sm-2">
                                <select id="searchById" class="form-control select2bs4" name="item_code">
                                    <option disabled="disabled" selected="selected">Select an item code</option>
                                    <?php foreach ($item_codes->result() as $item) { ?>
                                        <option value="<?php echo $item->item_code ?>" <?php if(isset($_GET['item_code']) && $_GET['item_code']==$item->item_code) echo "selected"?>> <?php echo $item->item_code ?> </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-sm-0.5">

                            </div>
                         
                            

                            <div class="form-group col-sm-1" style="flex:auto;">
                                <button id="btnSearch" type="submit" class="btn btn-primary bg-gradient-primary">Search</button>
                            </div>
                            <div class="form-group" style="flex:auto;">

                            </div>
                        </div>

                    </form>

                    <div class="card-body" style="background-color:#fff;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th>Item Group </th>
                                    <th>Customer</th>
                                    <th>Sales Date</th>
                                    <th>Unit Price (Rs)</th>
                                    <th>Type</th>
                                    <th>Sales Qty</th>
                                    <th>Total Price (Rs)</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($sales_history_table->result() as $item) { ?>
                                    <tr>
                                        <td><?php echo $item->item_code ?></td>
                                        <td><?php echo $item->item_name ?></td>
                                        <td><?php echo $item->sku_name ?></td>
                                        <td><?php echo $item->customer_name ?></td>
                                        <td><?php echo $item->invoice_date ?></td>
                                        <td><?php echo $item->unit_price ?></td>
                                        <td><?php echo $item->unit_type ?></td>
                                        <td><?php echo $item->qty ?></td>
                                        <td><?php echo $item->total_price ?></td>

                                        <!-- <td style="text-align: center"><span class="fa fa-pen"></span></td> -->
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>


                <div class="modal fade" id="modal-lg">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Invoice</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- <p>One fine body&hellip;</p> -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->


            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->