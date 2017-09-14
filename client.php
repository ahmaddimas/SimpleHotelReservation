<?php
require_once 'admin/config.php';
/**
 *
 */
class Client extends Database {
  function __construct() {
    parent::__construct();
  }

  function searchRoom($checkin, $checkout) {
    $where = "b.id_kamar IS NULL || ((b.checkin > :checkin || :checkin > b.checkout) && (b.checkin > :checkout || :checkout > b.checkout))";
    $query = "SELECT *, k.id_kamar AS nomor, COUNT(DISTINCT k.tipe_kamar, case when $where then k.id_kamar else 0 end) AS available FROM tb_kamar AS k LEFT JOIN tb_booking AS b on k.id_kamar = b.id_kamar WHERE $where GROUP BY k.tipe_kamar ORDER BY k.tipe_kamar";
    $result = $this->conn->prepare($query);
    $result->execute([':checkin' => $checkin, ':checkout' => $checkout]);
    $row = [];
    while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
      $row[] = $r;
    }
    return $row;
  }

  function getRoom() {
    $query = "SELECT *, k.id_kamar AS nomor, COUNT(k.id_kamar) - COUNT(k.id_kamar = b.id_kamar) AS available FROM tb_kamar AS k LEFT JOIN tb_booking AS b on k.id_kamar = b.id_kamar GROUP BY k.paket_kamar HAVING (COUNT(k.id_kamar) - COUNT(k.id_kamar = b.id_kamar)) > 0 ORDER BY k.id_kamar";
    $result = $this->conn->prepare($query);
    $result->execute();
    $row = [];
    while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
      $row[] = $r;
    }
    return $row;
  }

  function countRoomAvailable($key, $checkin, $checkout) {
    $where = "b.id_kamar IS NULL || (k.tipe_kamar=:tipe && (b.checkin > :checkin || :checkin > b.checkout) && (b.checkin > :checkout || :checkout > b.checkout))";
    $query = "SELECT COUNT(case when $where then k.id_kamar else 0 end) AS available FROM tb_kamar AS k LEFT JOIN tb_booking AS b on k.id_kamar = b.id_kamar WHERE $where GROUP BY k.tipe_kamar ORDER BY k.tipe_kamar";
    $result = $this->conn->prepare($query);
    $result->execute([':tipe' => $key, ':checkin' => $checkin, ':checkout' => $checkout]);
    return $result->fetch(PDO::FETCH_OBJ)->available;
  }

  function getSingleRoom($key, $checkin, $checkout) {
    $query = "SELECT *, k.tipe_kamar AS type FROM tb_kamar AS k LEFT JOIN tb_fasilitas_relation AS fr on k.tipe_kamar = fr.tipe_kamar WHERE k.tipe_kamar=:tipe GROUP BY k.paket_kamar";
    $result = $this->conn->prepare($query);
    $result->execute([':tipe' => $key]);
    return $result->fetch(PDO::FETCH_ASSOC);
  }

  function getFasilitiesFromIdRoom($key) {
    $query = "SELECT * FROM tb_fasilitas_relation AS fr LEFT JOIN tb_fasilitas AS f on fr.id_fasilitas = f.id_fasilitas WHERE fr.tipe_kamar =?";
    $result = $this->conn->prepare($query);
    $result->execute([$key]);
    $row = [];
    while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
      $row[] = $r;
    }
    return $row;
  }

  function getTypeRoomFromName($name) {
    $query = "SELECT tipe_kamar FROM tb_kamar WHERE paket_kamar=? GROUP BY paket_kamar";
    $result = $this->conn->prepare($query);
    $result->execute([$name]);
    return $result->fetch(PDO::FETCH_OBJ)->tipe_kamar;
  }

  function getBookingFromCode($key) {
    $query = "SELECT * FROM tb_booking WHERE kode_booking=? GROUP BY kode_booking";
    $result = $this->conn->prepare($query);
    $result->execute([$key]);
    $row = [];
    while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
      $row[] = $r;
    }
    return $row;
  }

  function getAvailableRoomIdFromName($name, $checkin, $checkout) {
    $where = "b.id_kamar IS NULL || (k.tipe_kamar=:tipe && (b.checkin > :checkin || :checkin > b.checkout) && (b.checkin > :checkout || :checkout > b.checkout))";
    $query = "SELECT k.id_kamar FROM tb_kamar AS k LEFT JOIN tb_booking AS b on k.id_kamar = b.id_kamar WHERE $where GROUP BY k.tipe_kamar ORDER BY k.tipe_kamar";
    $result = $this->conn->prepare($query);
    $result->execute([':tipe' => $name, ':checkin' => $checkin, ':checkout' => $checkout]);
    return (int)$result->fetch(PDO::FETCH_OBJ)->id_kamar;
  }

  function bookNow($e, $n, $t, $k, $ci, $co, $h, $j) {
    $ik = $this->getAvailableRoomId($k, $ci, $co);
    $b = $this->generateBookingCode();
    $sql = "INSERT INTO tb_booking (kode_booking, id_kamar, pelanggan, email, telepon, payment, checkin, checkout) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $result = $this->conn->prepare($sql);
    for ($i=0; $i < $j; $i++) {
      $result->execute([$b, $ik, $n, $e, $t, ($h*$j), $ci, $co]);
    }
    return $b;
  }

  function generateBookingCode() {
    $sql = "SELECT kode_booking FROM tb_booking ORDER BY kode_booking DESC LIMIT 1";
    $result = $this->conn->query($sql)->fetch(PDO::FETCH_OBJ)->kode_booking;
    $id = (int)substr($result, -3) + 1;
    $id = date('ymd').sprintf("%03d", $id);
    return $id;
  }

  function getPromo($code) {
    $query = "SELECT potongan_harga FROM tb_promo WHERE kode_promo=? GROUP BY kode_promo ORDER BY kode_promo";
    $result = $this->conn->prepare($query);
    $result->execute([$code]);
    return (int)$result->fetch(PDO::FETCH_OBJ)->potongan_harga;
  }

  function sendImageConfirmation($file_name, $code) {
    $query = "UPDATE tb_booking SET bukti=? WHERE kode_booking=?";
    $result = $this->conn->prepare($query);
    $result->execute([$file_name, $code]);
    return true;
  }
}
// $client = new Client();
// print_r($client->generateBookingCode());
?>
