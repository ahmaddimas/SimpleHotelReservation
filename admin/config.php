<?php
class Database {
  public $conn = null;
  function __construct() {
    try {
      $this->conn = new PDO("mysql:host=localhost;dbname=hotel", "root", "");
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "<h2>Error Connection : ". $e->getMessage() ."</div>";
      return;
    }
  }
}
 /**
  * for room funtion
  */
 class Room extends Database {
   function __construct() {
     parent::__construct();
   }

   function fetchRoom($value = "") {
     $value = htmlspecialchars(stripslashes(trim($value)));
     $where = $value != "" ? "WHERE paket_kamar LIKE '$value%'" : "";
     $query = "SELECT *, k.id_kamar AS nomor, COUNT(k.id_kamar) - COUNT(k.id_kamar = b.id_kamar) AS available FROM tb_kamar AS k LEFT JOIN tb_booking AS b on k.id_kamar = b.id_kamar $where GROUP BY k.paket_kamar ORDER BY k.id_kamar";
     $result = $this->conn->prepare($query);
     $result->execute();
     $row = []; $i = 1;
     while ($a = $result->fetch(PDO::FETCH_OBJ)) {
       $tr = "<tr>";
       $tr .= "<td>". $i++ ."</td>";
       $tr .= "<td>". $a->nomor ."</td>";
       $tr .= "<td>". $a->paket_kamar ."</td>";
       $tr .= "<td>". $a->kapasitas ."</td>";
       $tr .= "<td>Rp ". number_format($a->harga, 0, ",", ".") ."</td>";
       $tr .= "<td>". $a->available ."</td>";
       $tr .= "<td>
               <a role='button' href='#form-modal' class='btn btn-info' data-toggle='modal' onclick='searchEdit(".$a->tipe_kamar.")'><i class='fa fa-pencil'></i></a>
               <a role='button' href='#' class='btn btn-danger'><i class='fa fa-close'></i></a>
               </td>";
       $tr .= "</tr>";
       $row[] = $tr;
     }
     return $row;
   }

   function fetchBookingList($value = "") {
     $value = htmlspecialchars(stripslashes(trim($value)));
     $where = $value != "" ? "WHERE paket_kamar LIKE '$value%'" : "";
     $query = "SELECT *, b.id_kamar AS nomor FROM tb_kamar AS k LEFT JOIN tb_booking AS b on k.id_kamar = b.id_kamar $where ORDER BY b.kode_booking";
     $result = $this->conn->prepare($query);
     $result->execute();
     $row = []; $i = 1;
     while ($a = $result->fetch(PDO::FETCH_OBJ)) {
       $tr = "<tr>";
       $tr .= "<td>". $i++ ."</td>";
       $tr .= "<td>". $a->kode_booking ."</td>";
       $tr .= "<td>". $a->nomor ."</td>";
       $tr .= "<td>". $a->email ."</td>";
       $tr .= "<td>". $a->telepon ."</td>";
       $tr .= "<td>". $a->pelanggan ."</td>";
       $tr .= "<td>". $a->payment ."</td>";
       $tr .= "<td>". $a->checkin ."</td>";
       $tr .= "<td>". $a->checkout ."</td>";
       $confirm = "Unknown";
       if(!$a->confirm && $a->bukti == "") {$confirm = 'Menunggu Pembayaran';}
       elseif($a->confirm && $a->bukti != "") {$confirm = 'Sudah Dikonfirmasi';}
       elseif($a->done) {$confirm = 'Done';}
       elseif(!$a->confirm && $a->bukti != "") {$confirm = "<button class='btn btn-warning' onclick='confirm(".$a->kode_booking.")'>Confirm</button>";}
       $tr .= "<td>". $confirm ."</td>";
       $tr .= "<td>
               <a role='button' href='#form-modal' class='btn btn-info' data-toggle='modal' onclick='searchEdit(".$a->kode_booking.")'><i class='fa fa-pencil'></i></a>
               <a role='button' href='#' class='btn btn-danger'><i class='fa fa-close'></i></a>
               </td>";
       $tr .= "</tr>";
       $row[] = $tr;
     }
     return $row;
   }

   function setBookingConfirmed($code) {
     $query = "UPDATE tb_booking SET confirm=1 WHERE kode_booking=?";
     $result = $this->conn->prepare($query);
     $result->execute([$code]);
     return true;
   }

   function fetchFacilities() {
     $query = "SELECT * FROM tb_fasilitas";
     $result = $this->conn->prepare($query);
     $result->execute();
     $row = [];
     while ($a = $result->fetch(PDO::FETCH_ASSOC)) {
       $row[] = $a;
     }
     return $row;
   }

   function insertRoom($kamar, $kapasitas, $harga, $available, $fasilitas) {
     $query = "INSERT INTO tb_kamar (tipe_kamar, paket_kamar, kapasitas, harga) VALUES (?, ?, ?, ?)";
     $last_id = (int)$this->conn->query("SELECT tipe_kamar FROM tb_kamar GROUP BY tipe_kamar ORDER BY tipe_kamar DESC LIMIT 1")->fetch(PDO::FETCH_OBJ)->tipe_kamar + 1;
     $result = $this->conn->prepare($query);
     for ($i=0; $i < $available; $i++) {
       $result->execute([$last_id, $kamar, $kapasitas, $harga]);
     }
     $query = "INSERT INTO tb_fasilitas_relation (tipe_kamar, id_fasilitas) VALUES (?, ?)";
     $result = $this->conn->prepare($query);
     for ($i=0; $i < count($fasilitas); $i++) {
       $result->execute([$last_id, $fasilitas[$i]]);
     }
     return true;
   }

   function getSingleRoom($key) {
     $query = "SELECT *, COUNT(k.id_kamar) - COUNT(k.id_kamar = b.id_kamar) AS available FROM tb_kamar AS k LEFT JOIN tb_booking AS b on k.id_kamar = b.id_kamar LEFT JOIN tb_fasilitas_relation AS fr on k.tipe_kamar = fr.tipe_kamar WHERE k.tipe_kamar =? GROUP BY k.paket_kamar";
     $result = $this->conn->prepare($query);
     $result->execute([$key]);
     return $result->fetch();
   }

   function findFacilities($key) {
     $query = "SELECT * FROM tb_fasilitas_relation AS fr INNER JOIN tb_fasilitas AS f on fr.id_fasilitas = f.id_fasilitas WHERE fr.tipe_kamar=?";
     $result = $this->conn->prepare($query);
     $result->execute([$key]);
     $row = [];
     foreach ($result->fetch() as $r) {
       $row[] = $r;
     }
     return $row;
   }
 }
 // $rom = new Room();
 // echo $rom->findFacilities(1);
?>
