<?php
include ("header.php");
include ("menu.php");
include ("functions.php");

if(isset($_GET["delete"])){
  //echo $_GET['id'];
 
  deleteAkses(htmlentities(strip_tags(trim($_GET['delete']))));
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
            <h3 class="card-title"></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>username</th>
                <th>SSID</th>
                <th>MAC</th>
                <th>IP</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php 
               
                $datas = detailUser(htmlentities(strip_tags(trim($_GET['id'])))); 
                foreach ($datas as $data) : 
                 
                ?>
              <tr>
              
                <td><?= $data["username"] ;?></td>
                <td><?= $data["nama_ssid"] ;?></td>
                <td><?= $data["mac"] ;?></td>
                <td><?= $data["ip"] ;?></td>
                <td><?= $data["keterangan"] ;?></td>
                <td class="project-actions text-right">
                     
                      <a class="btn btn-info btn-sm" href="edit_access.php?edit=<?= $data['id_detail_user'];?>&id=<?= $data['id'] ?>">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                      </a>
                      <a class="btn btn-danger btn-sm" href="view_user.php?delete=<?= $data['id_detail_user'] ;?>&id=<?= $_GET['id']; ?>" onclick="return confirm('Are You Sure want to delete?')">
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
