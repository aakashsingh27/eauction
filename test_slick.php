<html>
  <head>
  <title>My Now Amazing Webpage</title>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>

  <div class="your-class">
    <div><img src="https://eauction.gov.in/eauction/static/img/banner_4.d7db3ba.jpg" style="
    width: 100%;
"></div>
    <div><img src="https://eauction.gov.in/eauction/static/img/banner_3.ab056ab.jpg" style="width:100%;"></div>
    <div><img src="https://www.bidderwala.com/banner1.jpg" style="width:100%;"></div>
  </div>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.your-class').slick({
        dots: true,
  infinite: true,
  speed: 300,
infinite: true,
autoplay: true,
 arrows: false,
  autoplaySpeed: 2000,
  slidesToShow: 1,
  
  slidesToScroll: 1
      });
    });
  </script>

  </body>
</html>