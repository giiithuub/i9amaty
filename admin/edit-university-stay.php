<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the university stay ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $university_stay = getById("university_stays", $id);

    // Check if the university stay exists
    if ($university_stay) {
        // Get the facilities values
        $gym = $university_stay['gym'] == '1' ? 'checked' : '';
        $restaurant = $university_stay['resturant'] == '1' ? 'checked' : '';
        $library = $university_stay['library'] == '1' ? 'checked' : '';

        $images = explode(",", $university_stay['images']);
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit University Stay</h4>
                            <a href="university-stays.php" class="btn btn-primary float-end">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                    <input type="hidden" name="university_stay_id" value="<?= $university_stay['id']; ?>">

                                        <label class="mb-0 fw-bold text-dark" for="name">University Stay Name</label>
                                        <input type="text" required name="name" placeholder="Enter university stay name" class="form-control mb-3" value="<?= $university_stay['name']; ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0 fw-bold text-dark" for="description">Description</label>
                                        <textarea name="description" required rows="3" placeholder="Enter description" class="form-control mb-3"><?= $university_stay['description']; ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0 fw-bold text-dark" for="address">Address</label>
                                        <textarea name="address" required rows="2" placeholder="Enter address" class="form-control mb-3"><?= $university_stay['address']; ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0 fw-bold text-dark" for="facilities">Facilities</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="gym" name="gym" <?= $gym; ?>>
                                            <label class="form-check-label" for="gym">Gym</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="resturant" name="resturant" <?= $restaurant; ?>>
                                            <label class="form-check-label" for="resturant">Restaurant</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="library" name="library" <?= $library; ?>>
                                            <label class="form-check-label" for="library">Library</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0 fw-bold text-dark" for="total_chambers">Total Number of Chambers</label>
                                       
                                        <input type="number" required name="total_chambers" placeholder="Enter total number of chambers" class="form-control mb-3" value="<?= $university_stay['total_chambers']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0 fw-bold text-dark" for="price_range">Price Range</label>
                                        <input type="text" required name="price_range" placeholder="Enter price range" class="form-control mb-3" value="<?= $university_stay['price_range']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0 fw-bold text-dark" for="contact_person">Contact Person</label>
                                        <input type="text" required name="contact_person" placeholder="Enter contact person's name" class="form-control mb-3" value="<?= $university_stay['contact_person']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0 fw-bold text-dark" for="contact_email">Contact Email</label>
                                        <input type="email" required name="contact_email" placeholder="Enter contact email" class="form-control mb-3" value="<?= $university_stay['contact_email']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0 fw-bold text-dark" for="contact_phone">Contact Phone</label>
                                        <input type="text" required name="contact_phone" placeholder="Enter contact phone number" class="form-control mb-3" value="<?= $university_stay['contact_phone']; ?>">
                                    </div>
                                    <div class="col-md-12">
                                    <input type="hidden" name="old_images" value="<?= $university_stay['images']; ?>">
                                        <label class="mb-0" for="">Upload Images</label>
                                    <input type="file" name="images[]" multiple class="form-control mb-3 image-container" id="images">
                                    <?php foreach($images as $image): ?>
                                        <img src="<?= $image; ?>" width="100px" height="100px" class=" m-2">  
                                    <?php endforeach; ?>
                                    <div id="preview"></div>
                                </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                        <button type="submit" class="btn btn-primary" name="edit_university_stay_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
    document.querySelector('#images').onchange = function() {
    let files = document.querySelector('#images').files;
    let preview = document.getElementById('preview');

    function readAndPreview(file) {
        if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            let reader = new FileReader();

            reader.addEventListener("load", function() {
                let image = new Image();
                image.height = 100;
                image.width= 100;
                image.style.margin = "0.5rem";
                image.title = file.name;
                image.src = this.result;
                preview.appendChild(image);
            }, false);

            reader.readAsDataURL(file);
        }
    }

    if (files) {
        [].forEach.call(files, readAndPreview);
    }
};

</script>
<?php
    } else {
        
        exit();
    }
}
include('includes/footer.php');
?>