<!DOCTYPE html>
<?php
require_once 'config.php';
$room = new Room();
if (isset($_POST)) {
  if (isset($_POST['submit'])) {
    $kamar = $_POST['kamar'];
    $kapasitas = $_POST['kapasitas'];
    $harga = $_POST['harga'];
    $tersedia = $_POST['tersedia'];
    $fasilitas = [];
    foreach ($_POST['fasilitas'] as $f) {
      $fasilitas[] = $f;
    }
    if (!($room->insertRoom($kamar, $kapasitas, $harga, $tersedia, $fasilitas))) {
      echo "<h2>Gagal Menambahkan</h2>";
    }
  }
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>RanauHotel</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
      <button type="button" class="navbar-toggler" data-target="#mynav" data-toggle="collapse" aria-expanded="false" aria-controls="mynav">
        <span class="navbar-toggler-icon" aria-hidden="true"></span>
      </button>
      <a href="#" class="navbar-brand">RanauHotel</a>
      <div class="collapse navbar-collapse justify-content-end" id="mynav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a href="index.php" class="nav-link">Dashboard <i class="fa fa-dashboard"></i></a>
          </li>
          <li class="nav-item">
            <a href="kamar.php" class="nav-link">Paket Kamar</a>
          </li>
          <li class="nav-item">
            <a href="confirmation.php" class="nav-link">Confirmation</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="jumbotron jumbotron-fluid bg-light" style="margin-bottom: 0" id="top-element">
      <div class="container">
        <div class="row">
          <div class="col-md-4"><h3>List Pemesanan</h3><hr></div>
          <div class="col-md-3"></div>
          <div class="col-md-2">
            <a href="#form-modal" role="button" class="btn btn-primary btn-block" id="addbtn" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Tambah</a>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" name="" id="search" placeholder="Cari kode booking ...">
          </div>
        </div>
        <table class="table table-bordered table-hover table-stripped">
          <thead class="thead-inverse">
            <tr>
              <th>No</th>
              <th>Kode Booking</th>
              <th>ID Kamar</th>
              <th>Email</th>
              <th>Telepon</th>
              <th>Pemesan</th>
              <th>Biaya</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="list-booking">
            <!-- <?php foreach ($room->fetchBookingList() as $row) {
              echo $row;
            } ?> -->
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="form-modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <a href="#" role="button" data-dismiss="modal" class="close"><span aria-hidden="true">&times;</span></a>
            <h3>Tambah Kamar</h3>
          </div>
          <div class="modal-body">
            <form class="" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Kamar :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="kamar" id="kamar" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Kapasitas :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="kapasitas" id="kapasitas" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Harga :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="harga" id="harga" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Tersedia :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="tersedia" id="tersedia" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Fasilitas :</label>
                <div class="col-md-8">
                  <?php for ($i=0; $i < count($room->fetchFacilities()); $i++) {
                    $row = $room->fetchFacilities()[$i]; ?>
                    <div class="form-check" id="fasilitas">
                      <label for="<?= $row['id_fasilitas'] ?>" class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="<?= $row['id_fasilitas'] ?>" name="fasilitas[]" value="<?= $row['fasilitas'] ?>">
                        <?= $row['fasilitas'] ?>
                      </label>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                  <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="text-center bg-dark text-white py-3">
      <h5>RanauHotel</h5>
      <p>&copy; All Right Reserved 2017</p>
    </footer>
    <script src="../js/jquery.js" charset="utf-8"></script>
    <script src="../js/popper.min.js" charset="utf-8"></script>
    <script src="../js/bootstrap.min.js" charset="utf-8"></script>
    <script type="text/javascript">
      $('#top-element').css('margin-top', $('.fixed-top').height());
      $('.modalimgbtn .card-img').click(function() {
        var src = $(this).attr('data-source');
        $('#modalimg').find('img').attr('src', src);
      });
      $('#search').on('input', function() {
        var value = $(this).val().trim();
        $.ajax({
          url: 'action.php',
          type: 'get',
          data: {search: 'room', value: value}
        }).done(function(e) {
          $('#list-room').html(e);
        });
      });
      function confirm(kode) {
        $.ajax({
          url: 'action.php',
          type: 'get',
          data: {confirm: 1, kode_booking: kode}
        }).done(function(e) {
          showBookingList();
        });
      }
      showBookingList();
      function showBookingList() {
        $.ajax({
          url: 'action.php',
          type: 'get',
          data: {action: 'showBookingList'}
        }).done(function(e) {
          $('#list-booking').html(e);
        });
      }
      function searchEdit(key) {
        $.ajax({
          url: 'action.php',
          type: 'get',
          data: {search: 'room', number_room: key}
        }).done(function(e) {
          e = JSON.parse(e);
          $('#kamar').val(e[0].paket_kamar);
          $('#kapasitas').val(e[0].kapasitas);
          $('#harga').val(e[0].harga);
          $('#tersedia').val(e[0].available);
          $.ajax({
            url: 'action.php',
            type: 'get',
            data: {search: 'fasilitas', index: e[0].id_kamar}
          }).done(function(e) {
            e = JSON.parse(e);
            $('#fasilitas').find('input').each(function(){
              var attr = $(this).attr('id');
              $(this).removeAttr('checked');
              for (var i = 0; i < e.length; i++) {
                if (attr = e[i].id_fasilitas) {
                  $(this).attr('checked', 'checked');
                }
              }
            });
          });
        });
      }
    </script>
  </body>
</html>
