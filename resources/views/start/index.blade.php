<!-- STRONA GŁÓWNA STARTOWA! -->

<!doctype html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Klub Sokół!</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <style>
    .navbar {
      background-color: #0077b6 !important; 
      position: fixed; 
      width: 100%; 
      top: 0; 
      z-index: 9999;
    }

    .navbar-brand,
    .navbar-nav {
      color: white !important; 
    }
        
    /* hero-image, czyli "zdjęcie w tle" */
.hero-image {
  background-image: url('hero_image.jpg');
  background-size: cover;
  background-position: center;
  height: 500px; 
  opacity: 0.7; 
  position: relative;
}

.hero-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #FAFDFF; 
  text-align: center;
  font-weight: bold;
  
text-shadow: 6px 6px 6px #000000;}

    .footer {
      background-color: #343a40;
      color: white;
      text-align: center;
      position: absolute;
      bottom: 0;
      width: 100%;
      z-index: 9999;
    }
  </style>
</head>
<body>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- NAVBAR -->
    @include('shared.navbar_start')

        <div class="container-fluid p-0">
            <div class="hero-image">
              <div class="hero-text">
                <h1><b>Gotowy na niezapomniane przeżycia?</b></h1>
                <p><b>Klub Lekkoatletyczny Sokół czeka na Twój talent!</b></p>
                <a href="#oferta" class="btn btn-primary"><b>Zaczynamy!</b></a>
              </div>
            </div>
          </div>

          <section id="oferta" style="transform: scale(0.9); transform-origin: top center;">    <div class="row">
        <div class="col-md-6 mb-1 mt-5">
            <div class="card h-100">
                <img src="zawody.jpg" class="card-img-top" alt="Zawody">
                <div class="card-body">
                    <h5 class="card-title">Zawody</h5>
                    <p class="card-text">Zapoznaj się z kalendarzem zawodów</p>
                    <a href="{{ route('events.view') }}" class="btn btn-primary">Więcej</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-1 mt-5">
            <div class="card h-100">
                <img src="trening.jpg" class="card-img-top" alt="Treningi">
                <div class="card-body">
                    <h5 class="card-title">Treningi</h5>
                    <p class="card-text">Zapoznaj się z kalendarzem treningów</p>
                    <a href="{{ route('trainings.view') }}" class="btn btn-primary">Więcej</a>
                </div>
            </div>
        </div>
    </div>
</section>


  @include('shared.footer') 

      
      
  </body>
</html>