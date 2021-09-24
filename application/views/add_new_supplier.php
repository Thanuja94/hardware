<div class="page-inner">
    <div class="page-title">
        <div class="container">
            <h3></h3>
        </div>
    </div>


    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default" data-sortable-id="ui-widget-10">
                    <div class="panel-heading">

                        <h4 class="panel-title">Add New Supplier</h4>
                    </div>
                    <div class="panel-body">

                        <div class="panel-body">
                            <?php if($msg!=""){ ?>
                            <div class="alert <?php echo $class_alert ?>" role="alert">
                                <?php echo $msg; ?>
                            </div>
                            <?php } ?>
                            <form id="form_data" method="post">
                                


                                <div class="form-group">
                                    <li class="fa fa-user">&nbsp;&nbsp;</li>
                                    <label>Supplier Name</label>
                                    <input class="form-control input-rounded" name="supplier name" placeholder="last name"
                                           required="" type="text">
                                </div>


                                <div class="form-group">
                                    <li class="fa fa-home">&nbsp;&nbsp;</li>
                                    <label>Supplier Address Line 1</label>
                                    <input class="form-control input-rounded" name="supplier adderss line 1" placeholder="Email"
                                        required="" type="email">
                                </div>

                                <div class="form-group">
                                    <li class="fa fa-home">&nbsp;&nbsp;</li>
                                    <label>Supplier Address Line 2</label>
                                    <input class="form-control input-rounded" name="supplier adderss line 2" placeholder="Email"
                                        required="" type="email">
                                </div>
                               
                                <div class="form-group">
                                    <li class="fa fa-home">&nbsp;&nbsp;</li>
                                    <label>Supplier Address Line 3</label>
                                    <input class="form-control input-rounded" name="supplier adderss line 3" placeholder="Email"
                                        required="" type="email">
                                </div>

                                <div class="form-group">
                                    <li class="fa fa-envelope">&nbsp;&nbsp;</li>
                                    <label>Email</label>
                                    <input class="form-control input-rounded" name="email" placeholder="Email"
                                        required="" type="email">
                                </div>

                                <div class="form-group">
                                    <li class="fa fa-phone">&nbsp;&nbsp;</li>
                                    <label>Supplier Contact</label>
                                    <input class="form-control input-rounded" name="contact number" placeholder="Email"
                                        required="" type="email">
                                </div>

                                
                                
                                <div class="form-group">
                                    <li class="fa fa-gears">&nbsp;&nbsp;</li>
                                    <label>User Status</label>
                                    <select class="form-control m-b-sm input-rounded" name="status_id" required="">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">De-Active</option>

                                    </select>
                                </div>
                                <div class="col-md-4 pull-right">
                                    <button type="submit" class="btn btn-primary m-r-5 m-b-5">
                                        <i class="fa fa-user"></i>
                                        Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-6">
					<div class="panel panel-white">
					   
					</div>
				</div> -->
            </div>
        </div>
    </div>
</div>