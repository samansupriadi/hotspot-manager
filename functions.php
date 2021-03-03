<?php

include ("koneksi.php");


//get username based on id
function getuser($id){
    $sql = "select id, username from  radcheck where id=$id";
    $exe = mysqli_query(conn(), $sql);
    $data = mysqli_fetch_assoc($exe);

    return $data["username"];
}


// validasi new user sudah ada atau engga
function validateUser($user){
	$sql = "select * from radcheck where username like '$user'";
	$execute = mysqli_query(conn(), $sql);
	$cek = mysqli_num_rows($execute);
	
	return $cek;
	
}

//buat user baru
function newUser(){ 
    $user = htmlentities(strip_tags(trim($_POST["username"])));
    $password =  htmlentities(strip_tags(trim($_POST["password"])));
    $cek = validateUser($user);    
    if($cek == 0){
        $sql = "insert into radcheck (username, attribute, op, value) values ('$user', 'Cleartext-Password', ':=', '$password')";
        
        if(conn()->query($sql)){
           ?>
                <script>alert("<?php echo $user;?> Alredy Added"); window.location="tambah_user.php";</script>
           <?php
        }    
    }else{
        ?>
            <script>alert("<?php echo $user;?> Alredy Exists"); window.location="tambah_user.php";</script>
        <?php
    }    
}


// menampilkan semua user hostspot yang sudah di buat
function showUser(){
    //$query = "select radcheck.id, id_detail_user.id, username, mac, ip, keterangan, detail_user.status, nama_ssid from ((radcheck inner join detail_user on id_radcheck = radcheck.id) inner join ssid on ssid.id_ssid = id_detail_user.id_ssid)";
    $query = "select * from radcheck";
    $execute_query = conn()->query($query);
    $datas = [];

    while ($row = mysqli_fetch_assoc($execute_query)){
                $datas[] = $row;
        }
        return $datas;

}


// menampilan detail user tertentu
function detailUser($id){    
    $query = "select radcheck.id, detail_user.id_detail_user, username, mac, ip, keterangan, detail_user.status, nama_ssid from ((radcheck inner join detail_user on id_radcheck = radcheck.id) inner join ssid on ssid.id_ssid = detail_user.id_ssid) where radcheck.id = $id";
   // echo $query;

    $execute_query = conn()->query($query);
    $datas = [];
    while ($row = mysqli_fetch_assoc($execute_query)){
                $datas[] = $row;
        }

        return $datas;

}

//delete user hotspot
function deleteUser($id){
    $sql = "delete from radcheck where id = $id";
    if(conn()->query($sql)){
        ?>
            <script>alert("User sudah di delete"); window.location="index.php";</script>
        <?php
    }else{
        ?>
            <script>alert("User gagal di delete"); window.location="index.php";</script>
        <?php
    }
    
}


//reset password hotspot
function resetPassword($id){
    $id = htmlentities(strip_tags(trim($id)));
    $password =  htmlentities(strip_tags(trim($_POST['password'])));
    $sql = "update radcheck set value='$password' where id=$id";
    
    if(conn()->query($sql)){
        ?>
            <script>alert("Password berhasil di reset"); window.location="index.php";</script>
        <?php
    }else{
        ?>
            <script>alert("Password gagal di reset"); window.location="index.php";</script>
        <?php
    }
}

//delete aksess perangkat
function deleteAkses($id, $user){
    
    $sql = "delete from detail_user where id_detail_user=$id";

    if(conn()->query($sql)){
        ?>
            <script>alert("Aksess berhasil di delete"); window.location="view_user.php?id=<?= $_GET['id']; ?>";</script>
        <?php
    }else{
        ?>
            <script>alert("Aksess gagal di delete"); window.location="view_user.php?id=<?= $_GET['id']; ?>";</script>
        <?php
    }
    
}


// list ssid
function listSsid(){
    $query = "SELECT * FROM ssid";
    $execute_query = conn()->query($query);	
    $datas = [];

            while ($row = mysqli_fetch_assoc($execute_query)){
                    $datas[] = $row;
            }

            return $datas;

}

// cek penulisan format mac address
function validasiMac($mac){
   
    $mac = htmlentities(strip_tags(trim($mac)));
    $cek = preg_match('/^(?:(?:[0-9a-f]{2}[\:]{1}){5}|(?:[0-9a-f]{2}[-]{1}){5}|(?:[0-9a-f]{2}){5})[0-9a-f]{2}$/i', $mac);
    if($cek===1){
        return 1;
    }else{
        return 0;
    }
}


// return data untuk isian edit access hotspot
function selectAccess(){
    //var_dump($_GET);
    $idAccess = htmlentities(strip_tags(trim($_GET['edit'])));
    //$idUser = htmlentities(strip_tags(trim($_GET['id'])));
    $sql = "SELECT * FROM detail_user inner join ssid on detail_user.id_ssid = ssid.id_ssid where id_detail_user = $idAccess";
    $exe = conn()->query($sql);
    $datas = mysqli_fetch_assoc($exe);
    return $datas;
}


// edit kresidential user hotspot
function editAccess(){

    $idAccess = htmlentities(strip_tags(trim($_GET['edit'])));
    $id = htmlentities(strip_tags(trim($_GET['id'])));
    $mac = htmlentities(strip_tags(trim($_POST['mac'])));
    $ket = htmlentities(strip_tags(trim($_POST['keterangan'])));
    $ip = htmlentities(strip_tags(trim($_POST['ip'])));
    
    $cekmac = validasiMac($mac);
    $cekip = validasiIp($ip);
    $ketersediaanip = cekIp($ip, $mac);

    

    if($cekmac !== 1){
        ?>
            <script>alert("Format Mac Address salah!!!"); window.location="edit_access.php?edit=<?= $idAccess; ?>&id=<?= $id; ?>"</script>
        <?php
    }elseif($cekip !== 1){
        ?>
            <script>alert("Format IP Address salah!!!"); window.location="edit_access.php?edit=<?= $idAccess; ?>&id=<?= $id; ?>"</script>
        <?php
    }elseif($ketersediaanip !== 0){
        ?>
            <script>alert("IP Sudah Ada Yang Pake, Pilih Yang lain!!!"); window.location="edit_access.php?edit=<?= $idAccess; ?>&id=<?= $id; ?>"</script>
        <?php
    }else{
        $sql = "update detail_user set mac = '$mac', keterangan = '$ket', ip = '$ip' where id_detail_user = $idAccess";
        if(conn()->query($sql)){
           ?> 
                <script> alert("Data Berhasi Di Update"); window.location="view_user.php?id=<?= $id; ?>"</script>
          <?php  
        }
    }
}


// tambah aksess ssid ke user
function addAccess($id){
    $id = htmlentities(strip_tags(trim($id)));
    $mac = $_POST['mac'];
    $ket = $_POST['keterangan'];
    $ssids = $_POST['ssid'];
    
    foreach ($ssids as $ssid){
        $ip = ipAdd($ssid);
        $cek = existAccess($ssid, $mac);
        
        if($cek === 0){
            $sql = "insert into detail_user (id_radcheck, id_ssid, mac, ip, keterangan) values ($id, $ssid, '$mac', '$ip', '$ket')";
            if(conn()->query($sql)){
                ?>
                <script>alert("Akes berhasil di tambah"); window.location="view_user.php?id=<?= $id; ?>"</script>
                <?php
            }
        }else{
            ?>
                <script>alert("Akses gagal di tambah, Mac sudah ada di ssid"); window.location="add_access.php?add=<?= $id; ?>"</script>
                <?php
        }
       
            
    }
    
}

function existAccess($ssid, $mac){
    $sql = "SELECT * FROM detail_user where id_ssid = $ssid and mac  like '$mac'";
    $exe = conn()->query($sql);
    $cek = mysqli_num_rows($exe);

    return $cek;
}

/*
function existAccess($id){
    $sql = "SELECT id_ssid FROM detail_user where id_radcheck=$id";
    //echo $sql;
    $exe = conn()->query($sql);
    $datas= [];
    while ($row = mysqli_fetch_assoc($exe)){
       
        $datas[] = $row;
    }
    //var_dump($datas);
    return $datas;
}
*/

// give ip address association with ssid selected
function ipAdd($ssid){
    $sql = "SELECT * FROM ssid where id_ssid = $ssid";
    $exe = conn()->query($sql);
    $pool = mysqli_fetch_assoc($exe);
    echo $pool['ip_pool'];
    die();
   
   /*
    if($ssid == 2 or $ssid ==5){
        
        for ($a=5; $a<=254; $a++){
            $sql = "select ip from detail_user where ip like '172.17.1.$a'";
            //echo $sql;
            //echo "<br>";
            $exe = conn()->query($sql);
            $cek = mysqli_num_rows($exe);
            if($cek === 0){
                return "172.17.1.$a";
            }


        }
    }elseif($ssid == 3){
        for ($a=5; $a<=254; $a++){
            $sql = "select ip from detail_user where ip like '10.20.18.$a'";
            $exe = conn()->query($sql);
            $cek = mysqli_num_rows($exe);
            if($cek ===0){
                return "10.20.18.$a";
            }


        }
    }
    */
}

// cek format penulisan ip 
function validasiIp($ip){
    if(filter_var($ip, FILTER_VALIDATE_IP)){
            return 1;
    }else{
        return 0;
    }
}

//cek ip apa sudah ada yang gunakan apa belum
function cekIp($ip, $mac){
    $sql = "SELECT * FROM detail_user  where mac not like '$mac' and ip like '$ip'";
    $exe = conn()->query($sql);
    $cek = mysqli_num_rows($exe);
    return $cek;
}

//cek user admin sudah ada apa belum
function validasiAdmin($user){
    $user = htmlentities(strip_tags(trim($user)));
    $sql = "select * from admin where user like '$user'";
	$execute = mysqli_query(conn(), $sql);
	$cek = mysqli_num_rows($execute);
	
	return $cek;
}

// tambah new admin
function newAdmin(){
    $user = htmlentities(strip_tags(trim($_POST['username'])));
    $pass = htmlentities(strip_tags(trim($_POST['password'])));
    $cek = validasiAdmin($user);
    if($cek == 0){
        $sql = "insert into admin (user, password) values ('$user', md5('$pass'))";
        
        if(conn()->query($sql)){
           ?>
                <script>alert("<?php echo $user;?> Alredy Added"); window.location="tambah_user.php";</script>
           <?php
        }    
    }else{
        ?>
            <script>alert("<?php echo $user;?> Alredy Exists"); window.location="tambah_user.php";</script>
        <?php
    }    
    
}


?>
