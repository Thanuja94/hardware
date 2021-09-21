<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Sales Transaction</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sales Transaction</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->


        <section class="content">
            <div class="container-fluid">
                <form action="<?php echo base_url() ?>save_transaction" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row float-right pull-right">
                                <div class="col-md-7">
                                    <!-- text input -->
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-4 col-form-label"> Invoice No</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="inv_no"
                                                   value="<?php echo $inv_number ?>"
                                                   name="inv_no" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-4 col-form-label">Date</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="inv_date"
                                                   value="<?php echo $inv_date ?>"
                                                   name="inv_date" disabled>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- text input -->
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-4 col-form-label"> Customer Name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="cus_name" placeholder=""
                                                   name="cus_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-4 col-form-label">Address</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="cus_address" placeholder=""
                                                   name="cus_address">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-4 col-form-label">Tel No.</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="cus_tel" placeholder=""
                                                   name="cus_tel">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-12">
                        <div class="row">
                            <label for="" class="col-md-1 col-form-label">Add Items</label>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <select id="item_code" class="form-control select2bs4">
                                                    <?php foreach ($items->result() as $item) { ?>
                                                        <option value="<?php echo $item->item_code ?>"><?php echo $item->item_code . '-' . $item->item_name ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" id="item_qty"
                                                       placeholder="Qty (1)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" id="item_discount"
                                                       placeholder="Discount % (0)">
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
                                            <th>Item Group</th>
                                            <th>Unit Price (Rs)</th>
                                            <th>Type</th>
                                            <th>Sales Qty</th>
                                            <th>Discount %</th>
                                            <th>Total Price (Rs)</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <div class="form-horizontal">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">Gross
                                                    Total</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" id="gross_total"
                                                           name="gross_total"
                                                           value="0" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3"
                                                       class="col-sm-4 col-form-label">Qty Total</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" id="total_qty"
                                                           name="total_qty"
                                                           value="0" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3"
                                                       class="col-sm-4 col-form-label">Tax (%)</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" id="tax_amt"
                                                           placeholder="tax" value="0" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3"
                                                       class="col-sm-4 col-form-label">Discount (Rs)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="total_discount"
                                                           value="0" name="total_discount" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3"
                                                       class="col-sm-4 col-form-label">Net Total (Rs)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="net_total"
                                                           value="0" disabled>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" id="btn_save_tans" class="btn btn-info full-width">Save</button>
                                            <a href="<?php echo base_url()?>dashboard" type="button" class="btn btn-default float-right">Cancel</a>
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>




