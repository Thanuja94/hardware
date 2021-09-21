<h1 class="page-header">User Group
    <small>New Group...</small>
</h1>

<div class="row">
    <!-- begin col-6 -->
    <!--			<div class="col-md-6">-->
    <div class="col-md-4">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">

                <h4 class="panel-title">User Group List</h4>
            </div>
            <div id="main-wrapper" class="container">
                <div class="row">
                    <div class="col-md-4">
                        <?php if (isset($message) && $message != "") { ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $message; ?>
                            </div>

                        <?php } ?>
                        <div class="panel panel-white">
                            <div class="panel-body">
                                <form method="post" action=""/>
                                <div class="form-group">
                                    <li class="fa fa-users">&nbsp;&nbsp;</li>
                                    <label>New User Group</label>
                                    <input class="form-control input-rounded" name="user_group"
                                           placeholder="Enter User Group" required="" type="text">
                                </div>
                                <div class="col-md-4 pull-right">
                                    <button type="submit" class="btn btn-primary m-r-5 m-b-5">
                                        <i class="fa fa-user"></i>
                                        Submit
                                    </button>

                                </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<?php require_once('loader.php'); ?>
<script>
    $(window).load(function () {
        $(".se-pre-con").fadeOut("slow");
        ;
    });
</script>

<script>
    $(document).ready(function () {
        App.init();
        // TableManageButtons.init();
    });

</script>