<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
    include('includes/header.php');
    include('config/dbcon.php');
    
    
// put the parameters in the $index variable
$link = "http://" . $_SERVER['SERVER_NAME'] . '/UniStay';
// index.php link with the current parameters




?>
<!-- banner part start-->
<section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1>Comfortable University Stays</h1>
                            <p>Experience our well-furnished chambers designed for your convenience and comfort.</p>
                            <a href="chamber_list.php" class="btn_1">Explore Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner_img">
            <img src="img/banner.jpg" alt="University Stay Chamber" class=" img-fluid">
            <img src="img/banner_pattern.png" alt="#" class="pattern_img img-fluid">
        </div>
    </section>
    <!-- banner part end-->

    <!-- Popular Choices start-->
    <section class="popular_choices">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Popular Choices</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="single_product_item">
                        <div class="single_product_item_thumb">
                            <img src="img/popular_choice_1.jpg" alt="#" class="img-fluid">
                        </div>
                        <h3> <a href="single-chamber.html">Comfortable Chamber 1</a> </h3>
                        <p>From $100/month</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_product_item">
                        <div class="single_product_item_thumb">
                            <img src="img/popular_choice_2.jpg" alt="#" class="img-fluid">
                        </div>
                        <h3> <a href="single-chamber.html">Luxurious Chamber</a> </h3>
                        <p>From $150/month</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_product_item">
                        <div class="single_product_item_thumb">
                            <img src="img/popular_choice_1.jpg" alt="#" class="img-fluid">
                        </div>
                        <h3> <a href="single-chamber.html">Spacious Chamber</a> </h3>
                        <p>From $120/month</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Popular Choices end-->

    <!-- Features part here -->
  <section class="features_part section_padding">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="feature_part_tittle">
                        <h3>Credibly Innovate Granular Internal or Organic Sources</h3>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="feature_part_content">
                        <p>Seamlessly empower fully researched growth strategies and interoperable internal or "organic" sources. Credibly innovate granular internal or "organic" sources whereas high standards in web-readiness.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="single_feature_part">
                        <img src="img/icon/feature_icon_1.svg" alt="#">
                        <h4>Credit Card And Baridi Mob Support</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_feature_part">
                        <img src="img/icon/feature_icon_2.svg" alt="#">
                        <h4>Online Booking</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_feature_part">
                        <img src="img/icon/feature_icon_3.svg" alt="#">
                        <h4>24/7 Security</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_feature_part">
                        <img src="img/icon/feature_icon_4.svg" alt="#">
                        <h4>Family-Friendly</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features part end -->

    <?php include('includes/footer.php');
      ?>