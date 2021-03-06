<?php
include("header.php");
include("menu.php");
include("functions.php");

if(isset($_POST["reset"])){
  resetPassword($_GET['reset']);
}
?>

 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reset Password</h3>
              </div>


              <!-- form start -->
              <form role="form" method="post" action="">

                <div class="card-body">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?= getuser(htmlentities(strip_tags(trim($_GET['reset'])))); ?>" disabled>
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="reset" value="reset">Submit</button>
                </div>
                
              </form>


              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>







<?php
include("footer.php");
?>