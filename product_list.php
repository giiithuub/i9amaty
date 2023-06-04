<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
    include('includes/header.php');
    
    
// put the parameters in the $index variable
$link = "http://" . $_SERVER['SERVER_NAME'] . '/UniStay';
// index.php link with the current parameters




?>

<!-- breadcrumb part start-->
<section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>Product list</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb part end-->
    
   <!-- product list part start -->
<section class="product_list section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="product_sidebar">
                    <div class="single_sedebar">
                        <form action="#">
                            <input type="text" name="#" placeholder="Search keyword">
                            <i class="ti-search"></i>
                        </form>
                    </div>
                    <div class="single_sedebar">
                        <div class="select_option">
                            <div class="select_option_list">Location <i class="right fas fa-caret-down"></i></div>
                            <div class="select_option_dropdown">
                                <p><a href="#">Location 1</a></p>
                                <p><a href="#">Location 2</a></p>
                                <p><a href="#">Location 3</a></p>
                                <p><a href="#">Location 4</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="single_sedebar">
                        <div class="select_option">
                            <div class="select_option_list">Price Range <i class="right fas fa-caret-down"></i></div>
                            <div class="select_option_dropdown">
                                <p><a href="#">$100 - $500</a></p>
                                <p><a href="#">$500 - $1000</a></p>
                                <p><a href="#">$1000 - $1500</a></p>
                                <p><a href="#">$1500+</a></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-8">
                <div class="product_list">
                    <div class="row">
                    <?php 
                        // Fetch the chambers from the database
                        $products = getAll('Products'); 
                       

                        while($product = mysqli_fetch_assoc($products)) {
                             // Extract the first image from the images string
                             
                             $category = getById('Categories',$product['categoryId']);
                        $images = explode(",", $product['images']);
                        $firstImage = count($images) > 0 ? $images[0] : '';
                        ?>

                        <div class="col-lg-6 col-sm-6">
                            <div class="single_product_item">
                                <img src="admin/<?php echo $firstImage; ?>" alt="#" class="img-fluid">
                                <h3><a href="single-product.html"><?php echo $product['name']; ?></a></h3>
                                
                                <p>Category: <?php echo $category['name']; ?></p>
                               
                                <a href="single-product.php?id=<?= $product['id']?>"  class="btn_3">Show More</a>
                            </div>
                        </div>

                        <?php 
                        } 
                    ?>
                    </div>
                    <div class="load_more_btn text-center">
                        <a href="#" class="btn_3">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product list part end -->

 

    <!-- Footer Choices end-->

    <?php include('includes/footer.php');
      ?>