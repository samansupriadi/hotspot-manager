<?php
include("koneksi.php");
if(isset($_POST['login'])){
    //var_dump($_POST);
    //echo $_POST['username'];
    $user = mysqli_real_escape_string(conn(), $_POST['username']);
    $pass = mysqli_real_escape_string(conn(), $_POST['pass']);
    $pass = md5($pass);
    
    $sql = "SELECT * FROM admin where user like '$user' and password like '$pass'";
    $user = conn()->query($sql);
    $cek = mysqli_num_rows($user);

    if($cek ===1){
        $admin = mysqli_fetch_assoc($user);
        session_start();
        $_SESSION['user'] = $admin['user'];
        $_SESSION['login'] = 1;
        ?>
            <script>window.location="index.php"</script>
        <?php
    }else{
        ?>
            <script> alert("You entered wrong uesrname or password"); window.location="index.html" </script>
        <?php
    }
}


?>