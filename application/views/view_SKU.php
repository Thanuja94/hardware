<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stock Keeping Unit List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View Sku</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="col-md-offset-3" style="display: flex; justify-content: center">
        <div role="form" class="col-md-8">


            <div class="container-fluid">

                <div class="card card-default">
                    <div class="card-header">
                        <form action="" method="get">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- text input -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-md-4 col-form-label"> Search</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="search_param"
                                                       name="search_param" value="<?php echo isset($_GET['search_param']) ? $_GET['search_param'] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-primary"> Search</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row" style="justify-content:flex-end">
                                            <a href="<?php echo base_url()?>add_sku" class="btn btn-dark"> Create Sku</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                        <div class="card-body form-group col-md-12">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SKU Code</th>
                                    <th>SKU Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sku_list->result() as $item) { ?>
                                    <tr>
                                        <td><?php echo $item->sku_code ?></td>
                                        <td><?php echo $item->sku_name ?></td>
                                        <td>
                                            <?php if($item->status==1) { ?>
                                            <span class="badge bg-success">Active</span>

                                            <?php } else {  ?>
                                            <span class="badge bg-danger">In-active</span>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center"><span class="fa fa-pen" ></span></td>
                                    </tr>
                               <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>