<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Cryptop</title>

  <!-- slider stylesheet -->
  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="../../../HTML%20Marco%20AUTONOLEGGIO/index.html">
            <span>
              Cryptop
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="../../../HTML%20Marco%20AUTONOLEGGIO/index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="about.blade.php"> About </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="how.html"> How </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span>Wallet</span> <img src="images/wallet.png" alt="" />
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Sign Up</a>
                </li>
              </ul>
              <div class="user_option">
                <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                </form>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

  </div>

  @extends('layouts.public')

  @section('title', 'Pagina Profilo')

  @section('content')

  <!-- profile section -->

  <section>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="heading_container">
            <h2>
              Pagina profilo di {{ $user->name }}
            </h2>
          </div>
          <div class="profile-info">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nome">Nome:</label>
                  <p id="nome">{{ $user->name }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="cognome">Cognome:</label>
                  <p id="cognome">{{ $user->surname }}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="username">Username:</label>
                  <p id="username">{{ $user->username }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="password">Password:</label>
                  <p id="password">********</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="email">Email:</label>
                  <p id="email">{{ $user->email }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="telefono">Telefono:</label>
                  <p id="telefono">{{ $user->cellulare }}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="genere">Genere:</label>
                  <p id="genere">@if ($user->genere == 0)
                    Maschio
                    @elseif ($user->genere == 1)
                    Femmina
                    @endif
                  </p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="data-nascita">Data di nascita:</label>
                  <p id="data-nascita">{{ $user->dataNascita }}</p>
                </div>
              </div>
            </div>
            @can('isAdmin')
            <div class="col-md-12">
              <div class="mb-3">
                <label for="coupon">Numero di coupon generati:</label>
                <p id="coupon">{{ $user->coupon }}</p>
              </div>
            </div>
            @endcan

            <div class="col-md-6">
              <div class="mb-3">
                @can('isUser')
                <div class="info_form ">
                  <a href="{{ route('pagina_modifica', ['userId' => $user->userId]) }}">
                    <button type="button" class="btn btn-success">Modifica</button>
                  </a>
                  @endcan

                  @can('isAdmin')
                  <form action="{{ route('admin.user.destroy', ['userId' => $user->userId]) }}" method="POST" class="confirm-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success delete-button" data-confirm="Sei sicuro di voler eliminare l'utente?">Elimina</button>
                  </form>
                  @endcan

                </div>
              </div>
            </div>
          </div>

          @can('isUser')
          <div class="info_form ">
            <button class="btn btn-success" id="toggleButton">Storico Coupon</button>
          </div>
          <section id="hiddenSection" style="display: none;">
            <h1>Storico Coupon</h1>
            <ul>
              @foreach ($coupons as $coupon)
              <li>Promozione:
                @if ( $coupon->coupPr)
                {{ $coupon->coupPr->nome }}
                @else
                Promozione eliminata dal sito
                @endif
                , Codice coupon: {{ $coupon->codice }}
              </li>
              @endforeach
            </ul>
          </section>
          @endcan

        </div>
      </div>
    </div>
  </section>

  @endsection

  <!-- info section -->
  <section class="info_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_contact">
            <div class="info_logo">
              <a href="../../../HTML%20Marco%20AUTONOLEGGIO/index.html">
                <span>
                  Cryptop
                </span>
              </a>
            </div>
            <h5>
              Contact Us
            </h5>
            <div>
              <div class="img-box">
                <img src="images/location.png" width="18px" alt="" />
              </div>
              <p>
                Page when looking at its layou
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="images/phone.png" width="18px" alt="" />
              </div>
              <p>
                +01 1234567890
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="images/envelope.png" width="18px" alt="" />
              </div>
              <p>
                demo@gmail.com
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_info">
            <h5>
              Invest Money
            </h5>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in some form, by injected humour,
            </p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="info_links">
            <h5>
              Useful Links
            </h5>
            <ul>
              <li>
                <a href="">
                  There are many
                </a>
              </li>
              <li>
                <a href="">
                  variations of
                </a>
              </li>
              <li>
                <a href="">
                  passages of
                </a>
              </li>
              <li>
                <a href="">
                  Lorem Ipsum
                </a>
              </li>
              <li>
                <a href="">
                  available, but the
                </a>
              </li>
              <li>
                <a href="">
                  majority have
                </a>
              </li>
              <li>
                <a href="">
                  suffered
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_form ">
            <h5>
              Newsletter
            </h5>
            <form action="">
              <input type="email" placeholder="Enter your email" />
              <button>
                Subscribe
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      &copy; 2019 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- owl carousel script
    -->
  <script type="text/javascript">
    $(".owl-carousel").owlCarousel({
      loop: true,
      margin: 0,
      navText: [],
      center: true,
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        1000: {
          items: 3
        }
      }
    });
  </script>
  <!-- end owl carousel script -->
</body>

</html>
