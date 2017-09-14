<!DOCTYPE html>
<?php
require_once 'client.php';
$client = new Client(); ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>RanauHotel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
      <a role="button" class="navbar-toggler" href="#mynav" data-toggle="collapse" aria-expanded="false" aria-controls="mynav">
        <span class="navbar-toggler-icon" aria-hidden="true"></span>
      </a>
      <a href="#" class="navbar-brand">RanauHotel</a>
      <div class="collapse navbar-collapse justify-content-end" id="mynav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item active">
            <a href="kamar.php" class="nav-link">Paket Kamar</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Promo</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Cek Pemesanan</a>
          </li>
        </ul>
      </div>
    </nav>
    <?php
    if (isset($_POST['confirm'])) {
      $file = $_FILES['image_upload']['name'];
      $tmp = $_FILES['image_upload']['tmp_name'];
      $kode = $_POST['kode_booking'];
      $path = 'images/confirmation/';
      $file = $path.$file;
      if (move_uploaded_file($tmp, $file)) {
        if ($client->sendImageConfirmation($file, $kode)) { ?>
          <div class="jumbotron jumbotron-fluid bg.light text-center mb-auto" id="top-element">
            <h3>Bukti Telah Terkirim</h3>
            <h5 class="text-danger">*Terus cek email untuk pemberitahuan selanjutnya</h5>
          </div>
          <script type="text/javascript">
            setTimeout(function() {
              window.location='index.php';
            }, 3000);
          </script>
        <?php }
      }
    }
    if (isset($_GET[sha1('booking_code')]) && $_GET[sha1('booking_code')] != "") {
      $code = $_GET[sha1('booking_code')];
      $result = $client->getBookingFromCode($code)[0]; ?>
    <div class="jumbotron jumbotron-fluid mb-auto" id="top-element">
      <div class="container">
        <h3 class="text-center">Upload Bukti Anda</h3><hr>
        <form class="" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group row">
            <label for="" class="col-form-label col-md-3">Foto Bukti Pembayaran :</label>
            <div class="col-md-7">
              <input type="file" class="form-control" name="image_upload" id="image_upload">
            </div>
            <input type="hidden" name="kode_booking" value="<?= $result['kode_booking']; ?>">
            <div class="col-md-2">
              <button type="submit" name="confirm" class="btn btn-success btn-block">Confirm</button>
            </div>
          </div>
        </form>
      </div>
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
        </div>
      </div>
    </div>

<?php } else {
  //header('location:index.php');
  // echo sha1('booking_code');
}
?>

<footer class="text-center bg-dark text-white py-3">
  <h5>RanauHotel</h5>
  <p>&copy; All Right Reserved 2017</p>
</footer>
<script src="js/jquery.js" charset="utf-8"></script>
<script src="js/popper.min.js" charset="utf-8"></script>
<script src="js/bootstrap.min.js" charset="utf-8"></script>
<script type="text/javascript">
  setMinCheckout();
  $('#checkin').change(function() {
    setMinCheckout();
  })
  function setMinCheckout() {
    var checkin = $('#checkin').val();
    var checkout = $('#checkout');
    checkin = new Date(checkin);
    checkin.setDate(checkin.getDate() + 1);
    var day = checkin.getDate() < 10 ? "0"+checkin.getDate() : checkin.getDate();
    var month = checkin.getMonth()+1 < 10 ? "0"+(checkin.getMonth()+1) : checkin.getMonth()+1;
    var year = checkin.getFullYear();
    checkin = year+'-'+month+'-'+day;
    checkout.val(checkin).attr('min', checkin);
  }
  $('#top-element').css('margin-top', $('.fixed-top').height());
</script>
</body>
</html>
