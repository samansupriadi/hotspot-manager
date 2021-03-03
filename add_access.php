<?php
include ("header.php");
include ("menu.php");
include ("functions.php");

if(isset($_POST['tambah_access'])){
  //var_dump($_POST);
  addAccess($_GET['add']);
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
                <h3 class="card-title">Tambah aksess</h3>
              </div>


              <!-- form start -->
              <form role="form" method="post" action="">

                <div class="card-body">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?= getuser($_GET['add']); ?>" disabled>
                  </div>

                  <div class="form-group">
                    <label>MAC ADDRESS</label>
                    <input type="text" class="form-control" name="mac" placeholder="AA:BB:CC:DD:11:22" required>
                  </div>
                  <div class="form-group">
                    <label>Keterangan Perangkat</label>
                    <input type="text" class="form-control" name="keterangan" placeholder="Asus Zenphone max" required>
                  </div>

                  <div class="form-group">
                        <label>Choose SSID</label>
                        <select multiple class="form-control" name="ssid[]" required>
                            <?php
                                $datas = listSsid();
                                //$exist = existAccess($_GET['add']);
                                var_dump ($datas[0]['nama_ssid']);
                                foreach ( $datas as $data) : 
                            ?>
                          <option value="<?= $data['id_ssid']; ?>"> <?= $data["nama_ssid"];?></option>

                          <?php  endforeach; ?>
                        </select>
                      </div>
                  

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="tambah_access" value="tambah_access">Submit</button>
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