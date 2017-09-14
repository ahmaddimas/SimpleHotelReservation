<?php
require_once 'config.php';
$room = new Room();
if (isset($_GET['search']) && $_GET['search'] != "") {
  if ($_GET['search'] == 'room') {
    if (isset($_GET['value'])) {
      $val = $_GET['value'];
      $result = "";
      foreach ($room->fetchRoom($val) as $row) {
        $result .= $row;
      }
      $result = $result == "" ? "Tidak Ada Data" : $result;
      echo $result;
    }
    if (isset($_GET['number_room'])) {
      $val = $_GET['number_room'];
      $result = $room->getSingleRoom($val);
      echo json_encode($result);
    }
  }
  if ($_GET['search'] == 'fasilitas') {
    if (isset($_GET['index'])) {
      $val = $_GET['index'];
      $result = $room->findFacilities($val);
      echo json_encode($result);
    }
  }
}
if (isset($_GET['action']) && $_GET['action'] == 'showBookingList') {
    $result = "";
    foreach ($room->fetchBookingList() as $row) {
      $result .= $row;
    }
    $result = $result == "" ? "Tidak Ada Data" : $result;
    echo $result;
}
if (isset($_GET['confirm']) && $_GET['confirm']) {
  $code = $_GET['kode_booking'];
  return $room->setBookingConfirmed($code);
}
 ?>
