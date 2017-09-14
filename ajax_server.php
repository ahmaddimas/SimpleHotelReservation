<?php
require_once 'client.php';
$client = new Client();
if (isset($_POST['code']) && $_POST['code'] != "") {
  $result = $client->getBookingFromCode($_POST['code']);
  echo json_encode($result);
}
function getProvinsiName($provinsi_code) {
    $query = "SELECT nama_propinsi FROM tb_propinsi WHERE kode_propinsi = ?";
    $db->prepare($query);
    $result->execute([$provinsi_code]);
    return $result->fetch(PDO::FETCH_OBJ)->nama_propinsi;
}
 ?>
