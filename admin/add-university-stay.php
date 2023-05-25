<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add University Stay</h4>
                    <a href="index.php" class="btn btn-primary float-end">Back</a>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="name">University Stay Name</label>
                                <input type="text" required name="name" placeholder="Enter university stay name" class="form-control mb-3">
                            </div>

                           

                            <div class="col-md-12">
                                <label class="mb-0 fw-bold text-dark" for="description">Description</label>
                                <textarea name="description" required rows="3" placeholder="Enter description" class="form-control mb-3"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="mb-0 fw-bold text-dark" for="address">Address</label>
                                <textarea name="address" required rows="2" placeholder="Enter address" class="form-control mb-3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="facilities">Facilities</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="gym" id="gym" name="gym">
                                    <label class="form-check-label" for="gym">Gym</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="resturant" id="resturant" name="resturant">
                                    <label class="form-check-label" for="resturant">resturant</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="library" id="library" name="library">
                                    <label class="form-check-label" for="library">Library</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="total_chambers">Total Number of Chambers</label>
                                <input type="number" name='total_chambers' required name="total_chambers" placeholder="Enter total number of chambers" class="form-control mb-3">
                            </div>

                            

                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="price_range">Price Range</label>
                                <input type="text" required name="price_range" placeholder="Enter price range" class="form-control mb-3">
                                <div class="col-md-6">
                            <label class="mb-0 fw-bold text-dark" for="contact_person">Contact Person</label>
                            <input type="text" required name="contact_person" placeholder="Enter contact person's name" class="form-control mb-3">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-0 fw-bold text-dark" for="contact_email">Contact Email</label>
                            <input type="email" required name="contact_email" placeholder="Enter contact email" class="form-control mb-3">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-0 fw-bold text-dark" for="contact_phone">Contact Phone</label>
                            <input type="text" required name="contact_phone" placeholder="Enter contact phone number" class="form-control mb-3">
                        </div>

                        <div class="col-md-12">
                            <input type="hidden" name="old_images" value="<?= $data['images']; ?>">
                            <label class="mb-0 fw-bold text-dark" id="images">Upload Images</label>
                            <input type="file" name="images[]" multiple class="form-control mb-3">
                            <div id="preview"></div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="add_university_stay_btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
         </div>
    </div>
   </div>

   <script>
    document.querySelector('input[type="file"]').onchange = function() {
        let files = document.querySelector('input[type="file"]').files;
        let preview = document.getElementById('preview');

        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
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
 <?php include('includes/footer.php');?>
