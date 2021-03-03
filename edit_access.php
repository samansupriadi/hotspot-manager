<?php
include ("header.php");
include ("menu.php");
include ("functions.php");

if(isset($_GET['edit'])){

  $datas = selectAccess();
}

if(isset($_POST['editaccess'])){
  editAccess($_GET['edit']);
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
                <h3 class="card-title">Edit aksess</h3>
              </div>


              <!-- form start -->
              <form role="form" method="post" action="">

                <div class="card-body">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?= getUser($_GET['id']); ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>SSID</label>
                    <input type="text" class="form-control" name="ssid" value="<?= $datas['nama_ssid']; ?>" disabled required>
                  </div>
                  <div class="form-group">
                    <label>MAC ADDRESS</label>
                    <input type="text" class="form-control" name="mac" value="<?= $datas['mac'];  ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Keterangan Perangkat</label>
                    <input type="text" class="form-control" name="keterangan" value="<?= $datas['keterangan']; ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label>IP Address</label>
                    <input type="text" class="form-control" name="ip" value="<?= $datas['ip']; ?>" required>
                  </div>

                  
                  

                </div>
                <!-- /.card-body -->
               
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="editaccess" value="editaccess">Submit</button>
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
include ("footer.php");
?>