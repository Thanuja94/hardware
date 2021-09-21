<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create SKU</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Sku</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="col-md-offset-3">
        <div role="form" class="col-md-6">


            <div class="container-fluid">

                <div class="card card-default">
                    <div class="card-header">
                        <form action="<?php echo base_url() ?>save_sku" method="post">
                            <div class="card-body">


                                <?php if ($msg) { ?>

                                    <div class="alert <?php echo $alert_type ?> alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                        <?php echo $msg ?>
                                    </div>

                                <?php } ?>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>SKU Code :</label>
                                        <input type="text" name="sku_code" class="form-control" placeholder="Code" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label>SKU Name :</label>
                                        <input type="text" name="sku_name" class="form-control" placeholder="SKU Name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control select2" style="width: 100%;" name="status">
                                            <option value="1" selected="selected">Active</option>
                                            <option value="0">In-active</option>

                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>