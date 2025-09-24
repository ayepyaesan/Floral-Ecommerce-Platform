<?php
session_start();
$pageTitle = 'Home';
include './init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Romance in Blooms</title>
   <style>
    #welcome{
    background-image:url('assets/img/rosebg.jpg');
    background-size:cover;
    background-position:center center;
    background-repeat:no-repeat; 
    height:80vh;
    display:flex;
    justify-content:center;
    align-items:end;
    }
    #welcome .container{
      margin-bottom:80px;
    }
    .service-img{
      width:100%;
      height:500px;
      object-fit:cover;
    }
    .carousel-image{
    width:100%;
    height:600px;
    object-fit:cover;
    }
    .deal-card {
      border: none;
      text-align: center;
      padding: 20px;
      background-color: #fdf9fb;
      transition: transform 0.3s ease;
    }
    .deal-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .deal-card img {
      height: 300px;
      object-fit: cover;
      border-radius: 10px;
    }
    .deal-title {
      font-weight: bold;
      font-size: 1.2rem;
      margin-top: 15px;
      color: #6a1b9a;
    }
    .deal-text {
      font-size: 1rem;
      color: #333;
      margin-top: 8px;
    }
    .price-badge {
      background: #ffca28;
      padding: 5px 12px;
      border-radius: 20px;
      font-weight: bold;
      margin-top: 10px;
      display: inline-block;
    }

    #gallery img{
      object-fit: cover;
      width: 100%;
      height: 300px;
    }
   </style>
</head>
<body>
  <!-- Welcome Section -->
<section id="welcome" class="py-5 text-center">
  <div class="container">
    <h1 class="display-4">Welcome to Romance in Blooms </h1>
    <p class="lead">Let's make your favorite person happy with us!! 🌸</p>
    <a href="index.php" class="btn btn-primary mt-3">Shop Best Sellers</a>
  </div>
</section>

<!--Detail services -->
<section id="services" class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Our Floral Services</h2>
      <p class="text-muted mb-0">Beautifully crafted services designed to make every moment special.</p>
    </div>

    <!-- Carousel -->
    <div id="servicesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
      <div class="carousel-inner">

        <!-- Service 1 -->
        <div class="carousel-item active">
          <div class="card shadow-lg border-0">
            <div class="row g-0 align-items-stretch">
              <div class="col-md-5">
                <img src="assets/img/customfloral.jpeg" 
                     class="img-fluid rounded-start service-img" 
                     alt="Custom Floral Bouquets">
              </div>
              <div class="col-md-7 d-flex">
                <div class="card-body d-flex flex-column justify-content-center">
                  <h4 class="card-title">Custom Floral Bouquets 🌸</h4>
                  <p class="card-text">Say it your way with a made-to-order piece. Choose size, color story, and flower preferences; our designers will build a balanced, airy arrangement.</p>
                  <ul class="text-muted">
                    <li>Tailored for birthdays, anniversaries, and events.</li>
                    <li>Choose flowers, color palette, and style.</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Service 2 -->
        <div class="carousel-item">
          <div class="card shadow-lg border-0">
            <div class="row g-0 align-items-stretch">
              <div class="col-md-5">
                <img src="assets/img/personalnotes.jpeg" 
                     class="img-fluid rounded-start service-img" 
                     alt="Personalized Gift Notes">
              </div>
              <div class="col-md-7 d-flex">
                <div class="card-body d-flex flex-column justify-content-center">
                  <h4 class="card-title">Personalized Gift Notes ✍️</h4>
                  <p class="card-text">Make your bouquet extra meaningful with a heartfelt message. We offer beautifully designed cards where you can write your words of love.</p>
                  <ul class="text-muted">
                    <li>Add a heartfelt message to your bouquet.</li>
                    <li>Beautifully designed cards for every occasion.</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Service 3 -->
        <div class="carousel-item">
          <div class="card shadow-lg border-0">
            <div class="row g-0 align-items-stretch">
              <div class="col-md-5">
                <img src="assets/img/specialpack.jpeg" 
                     class="img-fluid rounded-start service-img" 
                     alt="Special Wrapping Styles">
              </div>
              <div class="col-md-7 d-flex">
                <div class="card-body d-flex flex-column justify-content-center">
                  <h4 class="card-title">Special Wrapping Styles 🎀</h4>
                  <p class="card-text">Choose from elegant wrapping options, including satin ribbons, eco-friendly kraft paper, or premium floral wraps to enhance your bouquet.</p>
                  <ul class="text-muted">
                    <li>Elegant ribbons, premium wraps, or eco-friendly paper.</li>
                    <li>Matches the mood and occasion.</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Service 4 -->
        <div class="carousel-item">
          <div class="card shadow-lg border-0">
            <div class="row g-0 align-items-stretch">
              <div class="col-md-5">
                <img src="assets/img/seasonalcharm.jpeg" 
                     class="img-fluid rounded-start service-img" 
                     alt="Seasonal Charm Additions">
              </div>
              <div class="col-md-7 d-flex">
                <div class="card-body d-flex flex-column justify-content-center">
                  <h4 class="card-title">Seasonal Charm Additions ✨</h4>
                  <p class="card-text">Add festive extras like dried flowers, mini balloons, or sparkling accents — perfect for birthdays, anniversaries, or holidays.</p>
                  <ul class="text-muted">
                    <li>Festive extras for all occasions</li>
                    <li>Customized accents for memories</li>
                    <li>Unique & personal touch</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Service 5 -->
        <div class="carousel-item">
          <div class="card shadow-lg border-0">
            <div class="row g-0 align-items-stretch">
              <div class="col-md-5">
                <img src="assets/img/consult.png" 
                     class="img-fluid rounded-start service-img" 
                     alt="bouquet styling consultation">
              </div>
              <div class="col-md-7 d-flex">
                <div class="card-body d-flex flex-column justify-content-center">
                  <h4 class="card-title">Bouquet Styling Consultation 💬</h4>
                  <p class="card-text">Not sure what to choose? Our florist will guide you with colors, flowers, and styling to ensure your bouquet is perfect for the occasion.</p>
                  <ul class="text-muted">
                    <li>Expert florist advice</li>
                    <li>Personalized suggestions</li>
                    <li>Perfect match for your occasion</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Service 6 -->
        <div class="carousel-item">
          <div class="card shadow-lg border-0">
            <div class="row g-0 align-items-stretch">
              <div class="col-md-5">
                <img src="assets/img/delivery.jpeg" 
                     class="img-fluid rounded-start service-img" 
                     alt="delivery service">
              </div>
              <div class="col-md-7 d-flex">
                <div class="card-body d-flex flex-column justify-content-center">
                  <h4 class="card-title">Same-Day Delivery 🚚</h4>
                  <p class="card-text">Order by 1 PM and we’ll deliver a fresh arrangement the same day — with real-time updates and care instructions.</p>
                  <ul class="text-muted">
                    <li>Real-time order tracking</li>
                    <li>Contactless delivery optional</li>
                    <li>Care card included</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>

<!--Best Floral Deals-->
<div class="container my-5">
  <h2 class="text-center mb-4">🌸 Summer’s Best Floral Deals 🌸</h2>
  <div class="row g-4">
    
    <!-- Card 1 -->
    <div class="col-md-3">
      <div class="card deal-card">
        <img src="assets/img/dealweek.jpeg" class="card-img-top" alt="Deal of the Week">
        <div class="card-body">
          <div class="deal-title">Deal of the Week</div>
          <p class="deal-text">30% OFF + Free Vase</p>
        </div>
      </div>
    </div>
    
    <!-- Card 2 -->
    <div class="col-md-3">
      <div class="card deal-card">
        <img src="assets/img/strawberry.jpeg" class="card-img-top" alt="Bouquet of the Month">
        <div class="card-body">
          <div class="deal-title">Bouquet of the Month</div>
          <p class="deal-text">10% OFF + Free Shipping</p>
        </div>
      </div>
    </div>
    
    <!-- Card 3 -->
    <div class="col-md-3">
      <div class="card deal-card">
        <img src="assets/img/freeshipping.jpeg" class="card-img-top" alt="Free Shipping Collection">
        <div class="card-body">
          <div class="deal-title">Free Shipping</div>
          <p class="deal-text">On Our Dreamy Collection</p>
        </div>
      </div>
    </div>
    
    <!-- Card 4 -->
    <div class="col-md-3">
      <div class="card deal-card">
        <img src="assets/img/flowersale.jpeg" class="card-img-top" alt="Summer Garden Sale">
        <div class="card-body">
          <div class="deal-title">Summer Garden Sale</div>
          <p class="deal-text">30% OFF - New Flowers Added!</p>
        </div>
      </div>
    </div>
    
  </div>
</div>



<!-- Best Sellers Carousel -->
<section id="best-sellers" class="bg-light py-5">
  <div class="container text-center">
    <h2 class="mb-4">Best Seller Bouquets</h2>
    <div id="bouquetCarousel" class="carousel slide mx-auto" data-bs-ride="carousel" style="max-width: 600px;">
      <div class="carousel-inner">

        <div class="carousel-item active">
          <img src="assets/img/ponpon.jpeg" class="carousel-image d-block w-100 rounded" alt="Bouquet 1">
          <div class="carousel-caption d-none d-md-block">
            <h5>Pon Pon Smiles</h5>
            <p>Smiles, sunshine, and daisies – all in one bouquet🌼💛</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="assets/img/profile.jpeg" class="carousel-image d-block w-100 rounded" alt="Bouquet 2">
          <div class="carousel-caption d-none d-md-block">
            <h5>Everyday Mix</h5>
            <p>One flower for each month I’ve loved you – and still, a lifetime wouldn’t be enough 🌸❤️</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="assets/img/butterfly.jpeg" class="carousel-image d-block w-100 rounded" alt="Bouquet 3">
          <div class="carousel-caption d-none d-md-block">
            <h5>Butterfly Style Bouquet</h5>
            <p>Where blooms meet wings – a bouquet that dances with beauty and grace.🦋💐</p>
          </div>
        </div>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#bouquetCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#bouquetCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
</section>

<!-- About Us Section -->
<section id="about" class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="assets/img/flowers.jpeg" alt="About Us" class="img-fluid rounded">
      </div>
      <div class="col-md-6">
      
        <p class="text-justify"><span class="fw-bold">Welcome to Romance in Blooms </span>– where every bouquet is a love story waiting to be told.</p>
        <p>We believe flowers speak the language of the heart, and our mission is to help you express life’s most beautiful emotions through exquisite floral designs. From vibrant mixed arrangements to romantic rose bouquets, each creation is thoughtfully crafted with fresh, handpicked blooms to make every moment unforgettable.</p>
        <p>Whether you’re celebrating love, friendship, gratitude, or simply adding beauty to your space, Romance in Blooms is here to turn your sentiments into stunning floral artistry.</p>
        <p>Because every petal deserves to tell your story. 🌸</p>
    </div>
  </div>
</section>
<!-- GALLERY -->
<section id="gallery" class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Gallery</h2>
      <p class="text-muted">A peek at our recent photos.</p>
    </div>
    <div class="row g-3">
      <div class="col-6 col-md-4"><img class="img-fluid rounded-4" src="assets/img/gallery1.jpeg" alt="Pastel bridal bouquet"></div>
      <div class="col-6 col-md-4"><img class="img-fluid rounded-4" src="assets/img/gallery2.jpeg" alt="Table centerpiece with candles"></div>
      <div class="col-6 col-md-4"><img class="img-fluid rounded-4" src="assets/img/gallery3.jpeg" alt="Flower cloud installation"></div>
      <div class="col-6 col-md-4"><img class="img-fluid rounded-4" src="assets/img/gallery4.jpeg" alt="Bright mixed bouquet"></div>
      <div class="col-6 col-md-4"><img class="img-fluid rounded-4" src="assets/img/gallery5.jpeg" alt="Boutonnieres"></div>
      <div class="col-6 col-md-4"><img class="img-fluid rounded-4" src="assets/img/gallery6.jpeg" alt="Daisy bouquet"></div>
    </div>
  </div>
</section>
<!-- Customer Testimonials Section -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">What Our Customers Say</h2>
    <div class="row">

      <!-- Testimonial 1 -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center">
            <p class="mb-3 fst-italic">
              "The bouquet I ordered was absolutely gorgeous! Fresh, vibrant, and delivered right on time."
            </p>
            <h6 class="fw-bold">— Emily R.</h6>
            <small class="text-muted">Anniversary Bouquet</small>
          </div>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center">
            <p class="mb-3 fst-italic">
              "Romance in Blooms never disappoints. The flowers were stunning and lasted for over a week!"
            </p>
            <h6 class="fw-bold">— Daniel K.</h6>
            <small class="text-muted">Mixed Flowers – Medium</small>
          </div>
        </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center">
            <p class="mb-3 fst-italic">
              "Such beautiful arrangements! My friend was over the moon when she received her birthday bouquet."
            </p>
            <h6 class="fw-bold">— Sarah L.</h6>
            <small class="text-muted">Birthday Surprise Bouquet</small>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Social Media Section -->
<section class="py-4 bg-white text-center">
  <div class="container">
    <h2 class="mb-3">Connect with Us</h2>
    <p class="mb-4">Follow us on social media for updates, discounts, and floral inspiration 🌼</p>
    
    <div class="d-flex justify-content-center gap-4">
      <a href="https://facebook.com/yourpage" target="_blank" class="text-decoration-none text-primary fs-3">
        <i class="fa-brands fa-facebook"></i>
      </a>
      <a href="https://instagram.com/yourpage" target="_blank" class="text-decoration-none text-danger fs-3">
        <i class="fa-brands fa-instagram"></i>
      </a>
      <a href="https://wa.me/yourphonenumber" target="_blank" class="text-decoration-none text-success fs-3">
        <i class="fa-brands fa-whatsapp"></i>
      </a>
      <a href="mailto:info@romanceinblooms.com" class="text-decoration-none text-secondary fs-3">
        <i class="fa-solid fa-envelope"></i>
      </a>
    </div>
  </div>
</section>
</body>
</html>

<?php
include $tpl . 'footer.php';
?>