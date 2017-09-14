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
        <form class="" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
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
        <h3 class="text-center">Rekomendasi Kami</h3><hr>
        <div class="row">
          <?php
          $record = $client->searchRoom($checkin, $checkout);
          if (isset($checkin) && isset($checkout)) {
              $record = $client->searchRoom($checkin, $checkout);
          }
          for ($i=0; $i < count($record); $i++) {
            $row = $record[$i]; ?>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(<?= $row['image1']; ?>) center center; background-size: cover; height: 200px;" data-source="<?= $row['image1']; ?>"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title"><?= $row['paket_kamar']; ?></h4>
                  <h5 class="card-subtitle justify-content-end d-flex">Rp <?= number_format($row['harga'], 0, ",", "."); ?></h5>
                  <p class="card-text">
                    <i class="fa fa-user"></i>&nbsp; Kapasitas &nbsp; : <?= $row['kapasitas']; ?> Orang <br>
                    <i class="fa fa-check"></i>&nbsp; Tersedia &nbsp; : <?= $row['available']; ?> Kamar <br>
                  </p>
                </div>
                <div class="card-footer">
                  <a class="btn btn-info btn-block" role="button" href="detail.php?room=<?= str_replace(" ", "-", $row['paket_kamar']); ?>&checkin=<?= $checkin; ?>&checkout=<?= $checkout; ?>">Selengkapnya ...</a>
                </div>
              </div>
            </div>
          <?php } ?>
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
      $('.card .card-img').click(function() {
        var src = $(this).attr('data-source');
        $('#modalimg').find('img').attr('src', src);
      });
    </script>
  </body>
</html>
