<?php
require_once 'includes/autenticarMenu.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>

  <DIV class="container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="./imagens/TLD_SERVICOS_HOME.png" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./imagens/banner2.png" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./imagens/banner3.png" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </DIV>

  <section class="py-6 mt-5 bg-gray-100">
    <div class="container">
      <div class="text-center pb-lg-4">
        <h2 class="mb-5">Contrate um dos nossos serviços</h2>
      </div>
      <div class="row">
        <div class="col-lg-4 mb-3 mb-lg-0 text-center">
          <div class="px-0 px-lg-3">
            <div class="icon-rounded bg-primary-light mb-3">
              <img class="img-thumbnail" src="./imagens/bussines_man.jpg" />
            </div>
            <h3 class="h5">Encontre o serviço que está precisando!
            </h3>
            <p class="text-muted">Nosso portifólio possui diversos serviços pronto para serem contratados.</p>
          </div>
        </div>
        <div class="col-lg-4 mb-3 mb-lg-0 text-center">
          <div class="px-0 px-lg-3">
            <div class="icon-rounded bg-primary-light mb-3">
              <img class="img-thumbnail" src="https://sp-ao.shortpixel.ai/client/to_auto,q_glossy,ret_img,w_1100,h_745/https://fredericoporto.com.br/wp-content/uploads/2016/12/change_orig.jpg" />
            </div>
            <h3 class="h5">Escolha rápida e fácil
            </h3>
            <p class="text-muted">Escolha qual melhor o atende, basta apenas adicionar a data que deseja e pronto.</p>
          </div>
        </div>
        <div class="col-lg-4 mb-3 mb-lg-0 text-center">
          <div class="px-0 px-lg-3">
            <div class="icon-rounded bg-primary-light mb-3">
              <img class="img-thumbnail" src="https://www.pousadadossonhos.com.br/wp-content/uploads/2017/12/147772-atividades-na-praia-6-opcoes-diferentes-para-curtir-com-a-familia-1.jpg" />
            </div>
            <h3 class="h5">Depois é só aproveitar!
            </h3>
            <p class="text-muted">Depois da contratação, não precisa se preocupar com nada! Deixe tudo conosco.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Vendor Start -->
  <div class="container-fluid py-5">
    <div class="row px-xl-5">
      <div class="col">
        <div class="owl-carousel vendor-carousel">
          <div class="bg-light p-4">
            <img src="../img/vendor-1.jpg" alt="">
          </div>
          <div class="bg-light p-4">
            <img src="../img/vendor-2.jpg" alt="">
          </div>
          <div class="bg-light p-4">
            <img src="../img/vendor-3.jpg" alt="">
          </div>
          <div class="bg-light p-4">
            <img src="../img/vendor-4.jpg" alt="">
          </div>
          <div class="bg-light p-4">
            <img src="../img/vendor-5.jpg" alt="">
          </div>
          <div class="bg-light p-4">
            <img src="../img/vendor-6.jpg" alt="">
          </div>
          <div class="bg-light p-4">
            <img src="../img/vendor-7.jpg" alt="">
          </div>
          <div class="bg-light p-4">
            <img src="../img/vendor-8.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Vendor End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Contact Javascript File -->
  <script src="mail/jqBootstrapValidation.min.js"></script>
  <script src="mail/contact.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
</body>

</html>



<?php
require_once 'includes/rodape.inc.php';
?>