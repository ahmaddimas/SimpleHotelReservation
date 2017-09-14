<!DOCTYPE html>
<?php
require_once 'client.php';
$client = new Client();

if (isset($_POST['booking'])) {
  $email = $_POST['email'];
  $nama = $_POST['nama'];
  $telepon = $_POST['telepon'];
  $kamar = $_POST['kamar'];
  $checkin = $_POST['checkin'];
  $checkout = $_POST['checkout'];
  $harga = $_POST['harga'];
  $jumlah = $_POST['jumlah'];
  header('location:invoice.php?'.sha1("book_code").'='.$client->bookNow($email, $nama, $telepon, $kamar, $checkin, $checkout, $harga, $jumlah));
} else {
  if (isset($_GET)) {
    $kamar = ""; $kapasitas = ""; $harga = ""; $available = ""; $img1 = ""; $img2 = ""; $img3 = ""; $fasilitas = "";
    if ($_GET['room'] != "" && $_GET['checkin'] != "" && $_GET['checkout'] != "") {
      $kamar = str_replace("-", " ", $_GET['room']);
      $id = $client->getTypeRoomFromName($kamar);
      $result = $client->getSingleRoom($id, $_GET['checkin'], $_GET['checkout']);
      $kamar = $result['paket_kamar'];
      $kapasitas = $result['kapasitas'];
      $harga = $result['harga'];
      $available = $client->countRoomAvailable($result['tipe_kamar'], $_GET['checkin'], $_GET['checkout']);
      $img1 = $result['image1'];
      $img2 = $result['image2'];
      $img3 = $result['image3'];
      $fasilitas = $client->getFasilitiesFromIdRoom($result['type']);
      if (isset($_POST['get_promo'])) {
        $code = $_POST['promo_code'];
        $harga = $harga - $client->getPromo($code);
      }
    } else {
      header('location:kamar.php');
    }
  } else {
    header('location:kamar.php');
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
      <button type="button" class="navbar-toggler" data-target="#mynav" data-toggle="collapse" aria-expanded="false" aria-controls="mynav">
        <span class="navbar-toggler-icon" aria-hidden="true"></span>
      </button>
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
            <a href="search.php" class="nav-link">Cek Pemesanan</a>
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
              <input type="date" class="form-control" name="checkin" id="checkin" min="<?= date('Y-m-d'); ?>" value="<?= $_GET['checkin']; ?>">
            </div>
            <label for="" class="col-form-label col-md-2">Check-out :</label>
            <div class="col-md-3">
              <input type="date" class="form-control" name="checkout" id="checkout" value="<?= $_GET['checkout']; ?>">
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
        <?php
         ?>
        <h3 class=""><?= $kamar; ?></h3><hr>
        <div class="row">
          <div class="col-md-8 mb-3">
            <a href="#modalimg" data-toggle="modal" class="modalimgbtn text-link text-white">
              <div class="card-img text-center" style="background: url(images/img26.jpg) center center; background-size: cover; height: 400px;" data-source="images/img26.jpg">
                <h4 class="text-overlay"><!--Test --></h4>
              </div>
            </a>
            <div class="row mt-4">
              <div class="col-md-6 mb-4">
                <a href="#modalimg" data-toggle="modal" class="modalimgbtn text-link text-white">
                  <div class="card-img text-center" style="background: url(images/img25.jpg) center center; background-size: cover; height: 200px;" data-source="images/img25.jpg">
                    <h4 class="text-overlay"><!--Test --></h4>
                  </div>
                </a>
              </div>
              <div class="col-md-6 mb-4">
                <a href="#modalimg" data-toggle="modal" class="modalimgbtn text-link text-white">
                  <div class="card-img text-center" style="background: url(images/img69.jpg) center center; background-size: cover; height: 200px;" data-source="images/img69.jpg">
                    <h4 class="text-overlay"><!--Test --></h4>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <span>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o"></i>
            </span>
            <h4 class="justify-content-end d-flex text-danger"><?= 'Rp '.number_format($harga,0,',','.'); ?></h4><hr>
            <h4>Fasilitas</h4><hr>
            <div class="row mb-4">
              <?php for ($i=0; $i < count($fasilitas); $i++) { ?>
                <div class="col-md-6 mb-3"><i class="fa <?= $fasilitas[$i]['icon']; ?>"></i>&emsp; <?= $fasilitas[$i]['fasilitas']; ?></div>
              <?php } ?>
            </div>
            <h4>Info</h4><hr>
            <p>Check In pukul 15.00 WIB <br> Tersedia : <?= $available; ?></p><hr>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="" class="form-control-label">Check-in :</label>
                <input type="date" class="form-control" name="checkin" id="checkin" value="<?= $_GET['checkin']; ?>" readonly>
              </div>
              <div class="col-md-12 mt-3">
                <label for="" class="form-control-label">Check-out :</label>
                <input type="date" class="form-control" name="checkout" id="checkout" value="<?= $_GET['checkout']; ?>" readonly>
              </div>
              <div class="col-md-12 mt-3">
                <a role="button" href="#booking-modal" class="btn btn-success btn-block" data-toggle="modal">Pesan</a>
              </div>
            </div>
            <h4>Kode Promo</h4><hr>
            <form class="" action="" method="post">
              <div class="form-group row">
                <label for="" class="col-form-label col-md-4">Masukkan Kode :</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="promo_code" placeholder="Kode Promo ...">
                </div>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary btn-block" name="get_promo">S U B M I T</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal fade" tabindex="-1" role="dialog" id="booking-modal">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Pesan</h4>
            </div>
            <div class="modal-body">
              <form class="" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-md-12 mt-3">
                        <label for="" class="form-control-label">Email :</label>
                        <input type="email" class="form-control" name="email" required>
                      </div>
                      <div class="col-md-12 mt-3">
                        <label for="" class="form-control-label">Telepon :</label>
                        <input type="number" class="form-control" name="telepon" required>
                      </div>
                      <div class="col-md-12 mt-3">
                        <label for="" class="form-control-label">Check-in :</label>
                        <input type="date" class="form-control" name="checkin" id="checkin" value="<?= $_GET['checkin']; ?>" required readonly>
                      </div>
                      <div class="col-md-12 mt-3">
                        <label for="" class="form-control-label">Harga yang dibayar / malam :</label>
                        <input type="text" class="form-control" name="" value="<?= 'Rp '.number_format($harga,0,',','.'); ?>" required readonly>
                        <input type="hidden" name="harga" value="<?= $harga; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-md-12 mt-3">
                        <label for="" class="form-control-label">Nama Lengkap :</label>
                        <input type="text" class="form-control" name="nama" required>
                      </div>
                      <div class="col-md-12 mt-3">
                        <label for="" class="form-control-label">Kamar :</label>
                        <input type="text" class="form-control" name="kamar" value="<?= $kamar; ?>" required readonly>
                      </div>
                      <div class="col-md-12 mt-3">
                        <label for="" class="form-control-label">Check-out :</label>
                        <input type="date" class="form-control" name="checkout" id="checkout" value="<?= $_GET['checkout']; ?>" required readonly>
                      </div>
                      <div class="col-md-12 mt-3">
                        <label for="" class="form-control-label">Jumlah yang dipesan :</label>
                        <select class="form-control" name="jumlah" required>
                          <?php for ($i=1; $i <= $available; $i++) {  ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mt-3">
                    <button type="submit" class="btn btn-success btn-block" name="booking">Pesan Sekarang</button>
                  </div>
                  <div class="col-md-6 mt-3">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" tabindex="-1" role="dialog" id="modalimg">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <a role="button" class="close" data-dismiss="modal" href=""><span aria-hidden="true">&times;</span></a>
            </div>
            <img src="" alt="Modal Images" width="100%">
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
      $('.modalimgbtn .card-img').click(function() {
        var src = $(this).attr('data-source');
        $('#modalimg').find('img').attr('src', src);
      });
    </script>
  </body>
</html>
