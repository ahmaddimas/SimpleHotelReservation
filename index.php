<!DOCTYPE html>
<?php
require_once 'client.php';
$client = new Client();
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
          <li class="nav-item active">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
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
    <div class="carousel slide bg-inverse" data-ride="carousel" id="slider">
      <ol class="carousel-indicators">
        <li data-target="slider" data-slide-to="0" class="active"></li>
        <li data-target="slider" data-slide-to="0"></li>
        <li data-target="slider" data-slide-to="0"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active" style="background: url(images/hotel1.jpg) center center; background-size: cover; height: 550px">
        </div>
        <div class="carousel-item" style="background: url(images/hotel2.jpg) center center; background-size: cover; height: 550px">
        </div>
        <div class="carousel-item " style="background: url(images/hotel4.jpg) center center; background-size: cover; height: 550px">
        </div>
      </div>
      <a href="#slider" class="carousel-control-prev" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a href="#slider" class="carousel-control-next" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
    <button type="button" class="btn btn-circle btn-primary btn-circle-sm fixed-bottom mb-4 ml-4" data-toggle="modal" data-target="#modal-comment"><i class="fa fa-comments"></i></button>
    <div class="modal fade pt-5" role="dialog" tabindex="-1" id="modal-comment">
      <div class="modal-dialog ml-3" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Chat</h5>
          </div>
          <div class="modal-body chat-content">
            <div class="form-group row">
              <label for="" class="form-control-label col-md-4"> Email</label>
              <div class="col-md-8">
                <input type="email" class="form-control" placeholder="Masukkan Email ...">
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="form-control-label col-md-4"> Nama</label>
              <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Masukkan Nama ...">
              </div>
            </div>
            <div class="row d-flex justify-content-center">
              <button type="button" class="btn btn-warning px-5" name="button">Submit</button>
            </div>
            <div class="form-group">
              <label for="" class="form-control-label"> AdminService
                <p class="form-control">Hello</p>
              </label><br>
              <label for="" class="form-control-label"> Haha
                <p class="form-control">Hello</p>
              </label>
            </div>
            <div class="form-group">
              <label for="" class="form-control-label"> AdminService
                <p class="form-control">Hello</p>
              </label><br>
              <label for="" class="form-control-label"> Haha
                <p class="form-control">Hello</p>
              </label>
            </div>
          </div>
          <div class="modal-footer row">
            <div class="form-group col-md-12 row">
              <div class="col-md-8">
                <input type="text" class="form-control" name="" placeholder="Masukkan Pesan ...">
              </div>
              <div class="col-md-4">
                <button type="button" class="btn btn-success btn-block" name="button">Kirim</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="jumbotron jumbotron-fluid mb-auto">
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
                <input type="date" class="form-control" name="checkout" id="checkout">
              </div>
              <div class="col-md-2">
                <button type="submit" name="search" class="btn btn-success btn-block">Cari</button>
              </div>
            </div>
          </form>
      </div>
    </div>
    <div class="jumbotron jumbotron-fluid text-white bg-secondary mb-auto">
      <div class="container text-center">
        <h3>Kenapa Kami?</h3><hr class="bg-light">
          <div class="row">
            <div class="col-md-3">
              <button type="button" class="btn btn-info btn-circle-lg" name="button"><i class="fa fa-usd"></i></button><br><br>
              <p>Harga Terbaik</p>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-info btn-circle-lg" name="button"><i class="fa fa-hotel"></i></button><br><br>
              <p>Pelayanan Terbaik</p>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-info btn-circle-lg" name="button"><i class="fa fa-paper-plane"></i></button><br><br>
              <p>Memesan dengan Cepat dan Mudah</p>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-info btn-circle-lg" name="button"><i class="fa fa-mobile fa-2x"></i></button><br><br>
              <p>Kemudahan Mengakses</p>
            </div>
          </div>
      </div>
    </div>
    <div class="jumbotron jumbotron-fluid bg-light mb-auto">
      <div class="container text-center">
        <h3>Fasilitas Kami</h3><hr class="bg-dark">
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img5.jpg) center center; background-size: cover; height: 200px;" data-source="images/img5.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Swimming Pool</h4>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img14.jpg) center center; background-size: cover; height: 200px;" data-source="images/img14.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Restaurant</h4>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img49.jpg) center center; background-size: cover; height: 200px;" data-source="images/img49.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Fitness Area</h4>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img7.jpg) center center; background-size: cover; height: 200px;" data-source="images/img7.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Meeting Room</h4>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img27.jpg) center center; background-size: cover; height: 200px;" data-source="images/img27.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Coffee Cafe</h4>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img53.jpg) center center; background-size: cover; height: 200px;" data-source="images/img53.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Playground</h4>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img59.jpg) center center; background-size: cover; height: 200px;" data-source="images/img59.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Ballroom</h4>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img52.jpg) center center; background-size: cover; height: 200px;" data-source="images/img52.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Wedding Ballroom</h4>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <!-- <div class="jumbotron jumbotron-fluid bg-light mb-auto">
      <div class="container text-center">
        <h3>Promo Kami</h3><hr class="bg-dark">
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img5.jpg) center center; background-size: cover; height: 200px;" data-source="images/img5.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Swimming Pool</h4>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img14.jpg) center center; background-size: cover; height: 200px;" data-source="images/img14.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Restaurant</h4>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="#modalimg" data-toggle="modal">
                  <div class="card-img" style="background: url(images/img49.jpg) center center; background-size: cover; height: 200px;" data-source="images/img49.jpg"></div>
                </a>
                <div class="card-body">
                  <h4 class="card-title">Fitness Area</h4>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div> -->
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
    <footer class="text-center bg-dark text-white py-3">
      <h5>RanauHotel</h5>
      <p>&copy; All Right Reserved 2017</p>
    </footer>
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/popper.min.js" charset="utf-8"></script>
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <script type="text/javascript">
      $('.carousel').css('margin-top', $('.fixed-top').height());
      $('.card .card-img').click(function() {
        var src = $(this).attr('data-source');
        $('#modalimg').find('img').attr('src', src);
      });
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
    </script>
  </body>
</html>
