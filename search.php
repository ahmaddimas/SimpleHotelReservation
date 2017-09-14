<!DOCTYPE html>
<?php
require_once 'client.php';
$client = new Client();
$checkin = date('Y-m-d');
$checkout = date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 days'));
if (isset($_GET)) {
  if (isset($_GET['search'])) {
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];
  }
}
?>
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
          <li class="nav-item">
            <a href="kamar.php" class="nav-link">Paket Kamar</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Promo</a>
          </li>
          <li class="nav-item active">
            <a href="#" class="nav-link">Cek Pemesanan</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="jumbotron jumbotron-fluid mb-auto" id="top-element">
      <div class="container text-center">
        <h3>Cari Kamar</h3><hr>
        <form class="" action="kamar.php" method="get">
          <div class="form-group row">
            <label for="" class="col-form-label col-md-2">Check-in :</label>
            <div class="col-md-3">
              <input type="date" class="form-control" name="checkin" id="checkin" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>">
            </div>
            <label for="" class="col-form-label col-md-2">Check-out :</label>
            <div class="col-md-3">
              <input type="date" class="form-control" name="checkout" id="checkout" value="">
            </div>
            <div class="col-md-2">
              <button type="submit" name="search" class="btn btn-success btn-block">Cari</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="jumbotron jumbotron-fluid bg-light mb-auto">
      <div class="container">
        <h3 class="text-center">Cari Pesanan Anda</h3><hr>
        <div class="form-group row">
          <label for="" class="col-form-label col-md-3">Kode Booking :</label>
          <div class="col-md-7">
            <input type="text" class="form-control" name="kode_booking" id="kode_booking">
          </div>
          <div class="col-md-2">
            <a role="button" href="#modal-detail" onclick="searchBooking()" data-toggle="modal" class="btn btn-success btn-block">Cari</a>
          </div>
        </div>
      </div>
      <div class="modal fade" tabindex="-1" role="dialog" id="modal-detail">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <a role="button" class="close" data-dismiss="modal" href=""><span aria-hidden="true">&times;</span></a>
              <h3>Pencarian</h3>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Kode Booking :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="booking" id="booking" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Nama Pemesan :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="nama" id="nama" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Email :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="email" id="email" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Telepon :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="telepon" id="telepon" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Check-in :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="checkin" id="ci" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Check-out :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="checkout" id="co" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Biaya :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="biaya" id="biaya" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-form-label col-md-3">Status :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="status" id="status" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                  <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
      var html = $('.modal-body').html();
      function searchBooking() {
        var val = $('#kode_booking').val();
        if (val == "") {
          $('.modal-body').html('<h3>Silahkan Masukkan Kode Pemesanan!</h3>');
        } else {
          $('.modal-body').html(html);
          $.ajax({
            url: "ajax_server.php",
            type: 'post',
            data: {code: val}
          }).done(function(e){
              e = JSON.parse(e);
              if (e.length > 0) {
                  $('#booking').val(e[0].kode_booking);
                  $('#nama').val(e[0].pelanggan);
                  $('#email').val(e[0].email);
                  $('#telepon').val(e[0].telepon);
                  $('#biaya').val(e[0].payment);
                  $('#ci').val(e[0].checkin);
                  $('#co').val(e[0].checkout);
                  var status = e[0].confirm == 0 && e[0].bukti == "" ? "Menunggu Pembayaran" : e[0].confirm == 0 && e[0].bukti != "" ? "Menunggu Konfirmasi" : e[0].confirm == 1 && e[0].bukti != "" ? "Pembayaran sudah dikonfirmasi" : "Unknown";
                  $('#status').val(status);
              } else {
                  $('.modal-body').html('<h3>Kode Pemesanan Tidak Ada!</h3>');
              }
          });
        }
      }
    </script>
  </body>
</html>
