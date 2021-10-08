<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Stock List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->


        <section class="content">
            <div class="container-fluid">
                <div class="form-group row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 col-form-label" style="text-align:center;">Stock List</div>
                    <div class="col-sm-4"></div>
                </div>

                <div class="row">
                    <div class="col-sm-10">
                        <form action="" method="get" class="form-horizontal">
                            <div class="row">
                                <div class="col-sm-8">
                                    <!-- text input -->
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Search by:</label>
                                        <div class="col-sm-4">
                                            <select id="drpoption" class="form-control" name="drpoption">
                                                <option>By Stock ID</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select id="item_code" class="form-control" name="item_code">
                                               
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="submit" class="form-control btn-secondary" value="Search"/>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>
                                </div>

                            </div>
                        </form>


                    </div>
                    <div class="col-sm-2">
                    <button type="submit" class="btn btn-dark">Add Stock</button>
                    </div>


                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body col-sm-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Stock ID</th>
                                        <th>Purchased Date</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>STO-001</td>
                                        <td>10/10/2021</td>
                                        <td> <a href="<?php echo base_url()?>itemupdate" class="btn btn-primary" >Add Items</a></td>
                                    </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->



