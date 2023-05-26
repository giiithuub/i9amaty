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
<section class="popular_choices pt-5 pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center pb-5">
                    <h2>Popular Choices</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
            $universityStays = getAll("university_stays");
            while($row = mysqli_fetch_assoc($universityStays)){
                $images = explode(",", $row['images']);
                $firstImage = count($images) > 0 ? $images[0] : '';
            ?>
            <div class="col-lg-4 col-sm-6 mb-4 d-flex align-items-stretch">
                <div class="card shadow-lg rounded" style="width: 26rem;">
                    <img src="admin/<?= $firstImage ?>" class="card-img-top" alt="#">
                    <div class="card-body d-flex flex-column justify-content-center text-center">
                        <h3 style="color : #4B3049 ;"><a style="color : #4B3049 ;" href="single-chamber.html"><?= $row['name'] ?></a></h3> 
                        <a href="unv_stay.php?id=<?= $row['id']?>" class="btn btn_3 mt-3 align-self-center">Explore</a>
                    </div>
                </div>
            </div>
            <?php } ?>
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