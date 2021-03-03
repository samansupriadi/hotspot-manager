<?php
include ("header.php");
include ("menu.php");
require ("functions.php");

if(isset($_GET["delete"])){
  deleteUser(htmlentities(strip_tags(trim($_GET["delete"]))));
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
                <h3 class="card-title">List User Hotspot</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>username</th>
                    
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   
                    $datas = showUser(); 
                    foreach ($datas as $data) : 
                     
                    ?>
                  <tr>
                  
                    <td><?= $data["username"] ;?></td>
                    
                    <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="view_user.php?id=<?= $data["id"];  ?>">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>
                          <a class="btn btn-primary btn-sm" href="add_access.php?add=<?= $data["id"];  ?>">
                              <i class="fas fa-folder">
                              </i>
                              Add Access
                          </a>
                          <a class="btn btn-info btn-sm" href="reset.php?reset=<?= $data['id'];?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Reset Password
                          </a>
                          <a class="btn btn-danger btn-sm" href="index.php?delete=<?= $data['id'];?>" onclick="return confirm('Are you sure want to delete ?')">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>

                    
                  </tr>
                  <?php endforeach; ?>
                  <tbody>
                </table>
              </div>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
<?php
include ("footer.php");
?>
 



  