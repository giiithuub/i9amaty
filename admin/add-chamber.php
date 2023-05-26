<?php   
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>
<style>
    .form-check-label {
        color: black;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Chamber</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark " for="name">Chamber Name</label>
                                <input type="text" required name="name" placeholder="Enter chamber name" class="form-control mb-3 ">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="">University Stay</label>
                                <select name="unv_id" class="form-select mb-2" aria-label="Default select example">
                                    <option selected>Select University Stay</option>
                                    <?php
                                    $university_stays = getAll("university_stays");

                                    if (mysqli_num_rows($university_stays) > 0) {
                                        foreach ($university_stays as $unv) {
                                            ?>
                                            <option value="<?= $unv['id']; ?>"><?= $unv['name']; ?></option>
                                        <?php
                                        
                                        }
                                    } else {
                                        echo "No University stays Available";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark " for="slug">Slug</label>
                                <input type="text" required placeholder="Enter slug" name="slug" class="form-control mb-3  ">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold text-dark " for="small_description">Small Description</label>
                                <textarea name="small_description" required rows="3" placeholder="Enter small description" class="form-control mb-3 "></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold text-dark " for="description">Description</label>
                                <textarea name="description" required rows="3" placeholder="Enter description" class="form-control mb-3 "></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark " for="price">Price</label>
                                <input type="number" required name="price" placeholder="Enter price" class="form-control mb-3 ">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark " for="room_type">Enter Room Type</label>
                                <input type="text" required name="room_type" placeholder="Enter Room Type" class="form-control mb-3 ">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0 fw-bold text-dark " for="images">Upload Images</label>
                                <input type="file" name="images[]" multiple class="form-control mb-3 ">
                                <div id="preview"></div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label fw-bold text-dark " for="capacity">Capacity</label>
                                <div class="col-sm-9">
                                    <input type="number" name="capacity" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="bathroom" class="form-check-input" id="bathroom">
                                <label class="form-check-label fw-bold text-dark " for="bathroom">Bathroom</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="kitchen" class="form-check-input" id="kitchen">
                                <label class="form-check-label fw-bold text-dark " for="kitchen">Kitchen</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="ac" class="form-check-input" id="ac">
                                <label class="form-check-label fw-bold text-dark " for="ac">Air Conditioning</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="heating" class="form-check-input" id="heating">
                                <label class="form-check-label fw-bold text-dark " for="heating">Heating</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label fw-bold text-dark " for="size">Size (sq ft)</label>
                                <div class="col-sm-9">
                                    <input type="number" name="size" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="furnished" class="form-check-input" id="furnished">
                                <label class="form-check-label fw-bold text-dark " for="furnished">Furnished</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="balcony" class="form-check-input" id="balcony">
                                <label class="form-check-label fw-bold text-dark " for="balcony">Balcony</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="laundry" class="form-check-input" id="laundry">
                                <label class="form-check-label fw-bold text-dark " for="laundry">Laundry</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="pet_friendly" class="form-check-input" id="pet_friendly">
                                <label class="form-check-label fw-bold text-dark " for="pet_friendly">Pet-friendly</label>
                            </div>
                        </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_chamber_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
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
