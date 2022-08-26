<!DOCTYPE html>
<html>
<head>
  <title>Imágenes de bitácora</title>
  <meta charset="UTF-8">
</head>
<body>

  <section class="mySlide">
    @foreach($urls as $url)
    <div>
        <img src="{{ $url }}">
    </div>
    @endforeach
  </section>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
      $(document).ready(function(){
        $('.mySlide').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 2000,
            fade: true,
            cssEase: 'linear'
        });
      });
    });
</script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .mySlider {
        width: 100%;
        height: 100vh;
        margin: 10px auto;
    }

  </style>
</body>
</html>
