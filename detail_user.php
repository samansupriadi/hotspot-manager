<?php
	require "koneksi.php";
	function detailUser($id){
		//$query = "select radcheck.id, id_detail_user.id, username, mac, ip, keterangan, detail_user.status, nama_ssid from ((radcheck inner join detail_user on id_radcheck = radcheck.id) inner join ssid on ssid.id_ssid = id_detail_user.id_ssid)";
		$query = "select radcheck.id, detail_user.id_detail_user, username, mac, ip, keterangan, detail_user.status, nama_ssid from ((radcheck inner join detail_user on id_radcheck = radcheck.id) inner join ssid on ssid.id_ssid = detail_user.id_ssid) where radcheck.id = $id";
		//$execute_query = mysqli_query(conn(), $query);
		$execute_query = conn()->query($query);
		$datas = [];

		while ($row = mysqli_fetch_assoc($execute_query)){
                	$datas[] = $row;
        	}

        	return $datas;

	}

/*
if(isset($_GET["id"])){
	$id = htmlentities(strip_tags(trim($_GET["id"])));
	$datas = detailUser($id);
	//var_dump($datas);
}
*/
?>
