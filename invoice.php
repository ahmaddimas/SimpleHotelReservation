<!DOCTYPE html>
<?php
require_once 'client.php';
$client = new Client();
  if (isset($_GET[sha1('book_code')]) && $_GET[sha1('book_code')] != "") {
    $code = $_GET[sha1('book_code')];
    $result = $client->getBookingFromCode($code)[0]; ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>RanauHotel Booking Code #<?= $result['kode_booking']; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
  </head>
  <body onload="window.print()">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
      <a role="button" class="navbar-toggler" href="#mynav" data-toggle="collapse" aria-expanded="false" aria-controls="mynav">
        <span class="navbar-toggler-icon" aria-hidden="true"></span>
      </a>
      <a href="#" class="navbar-brand">RanauHotel</a>
      <div class="collapse navbar-collapse justify-content-end" id="mynav">
        <ul class="navbar-nav">
          <li class="nav-item text-white">
            Booking Code #<?= $result['kode_booking']; ?>
          </li>
        </ul>
      </div>
    </nav>
    <div class="jumbotron bg-light mt-5">
      <div class="container">
        <h4>Informasi Pemesanan</h4><hr>
        <div class="row mb-3">
          <div class="col-md-3"><h6>Kode Booking</h6></div>
          <div class="col-md-9"><h6>: <?= $result['kode_booking']; ?></h6></div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3"><h6>Nama Pemesan</h6></div>
          <div class="col-md-5"><h6>: <?= $result['pelanggan']; ?></h6></div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3"><h6>Email Pemesan</h6></div>
          <div class="col-md-5"><h6>: <?= $result['email']; ?></h6></div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3"><h6>Telepon Pemesan</h6></div>
          <div class="col-md-5"><h6>: <?= $result['telepon']; ?></h6></div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3"><h6>Tanggal Check-in</h6></div>
          <div class="col-md-5"><h6>: <?= $result['checkin']; ?></h6></div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3"><h6>Tanggal Check-out</h6></div>
          <div class="col-md-5"><h6>: <?= $result['checkout']; ?></h6></div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3"><h6>Biaya</h6></div>
          <div class="col-md-5"><h6>: Rp <?= number_format($result['payment'], 0, ",", "."); ?></h6></div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3"><h6>Status Pemesanan</h6></div>
          <div class="col-md-5"><h6>: <?php if (!$result['confirm']) echo "Menunggu Konfirmasi Pembayaran"; else echo "Pembayaran Sudah Dikonfirmasi"; ?></h6></div>
        </div>
        <div class="row mb-3">
          <div class="col-md-12 py-3 bg-danger text-white">
            <h6>*Silahkan cek email untuk mendapatkan link konfirmasi pembayaran Anda</h6>
          </div>
          <a href="confirm_page.php?<?= sha1('booking_code').'='.$result['kode_booking']; ?>">Link Konfirmasi Pembayaran</a>
        </div>
      </div>
    </div>
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/popper.min.js" charset="utf-8"></script>
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>

<?php } else {
  header('location: index.php');
} ?>
