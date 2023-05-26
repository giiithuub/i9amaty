

<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>
<style>
    .form-check-label {
        color: black;
    }
    .image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
    }

    .image-container {
        width: 100%;
        object-fit: cover;
        overflow: hidden;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $chamber = getByID("chambers", $id);

                $data = $chamber;
                $images = explode(",", $data['images']);
            ?>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Chamber</h4>
                    <a href="index.php" class="btn btn-primary float-end">retour</a>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <input type="hidden" name="chamber_id" value="<?= $data['id']; ?>">

                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="name">Chamber Name</label>
                                <input type="text" required name="name" placeholder="Enter chamber name" class="form-control mb-3" value="<?= $data['name'];?>">
                            </div>

                            <div class="col-md-6">
                                <label class="mb-0" for="slug">Slug</label>
                                <input type="text" required placeholder="Enter slug" value="<?= $data['slug'];?>" name="slug" class="form-control mb-3 ">
                            </div>

                            <div class="col-md-12">
                                <label class="mb-0 fw-bold text-dark" for="small_description">Small Description</label>
                                <textarea name="small_description" required rows="3" placeholder="Enter small description" class="form-control mb-3"><?= $data['small_description'];?></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="mb-0 fw-bold text-dark" for="description">Description</label>
                                <textarea name="description" required rows="3" placeholder="Enter description" class="form-control mb-3"><?= $data['description'];?></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="price">Price</label>
                                <input type="number" value="<?= $data['price'];?>" required name="price" placeholder="Enter price" class="form-control mb-3">
                            </div>

                            <div class="col-md-6">
                            <label class="mb-0 fw-bold text-dark" for="room_type">Room Type</label>
                            <select name="room_type" required class="form-control mb-3">
                                <option value="single" <?= $data['room_type'] == "single" ? 'selected' : ''?>>Single Room</option>
                                <option value="double" <?= $data['room_type'] == "double" ? 'selected' : ''?>>Double Room</option>
                                <option value="shared" <?= $data['room_type'] == "shared" ? 'selected' : ''?>>Shared Room</option>
                            </select>
                        </div>


                            <div class="col-md-6">
                                <label class="mb-0" for="unv_id">University Stay</label>
                                <select name="unv_id" class="form-select mb-2" aria-label="Default select example">
                                    <option selected>Select University Stay</option>
                                    <?php
                                    $university_stays = getAll("university_stays");

                                    if (mysqli_num_rows($university_stays) > 0) {
                                        foreach ($university_stays as $unv) {
                                            $selected = $data['unv_id'] == $unv['id'] ? "selected" : "";
                                    ?>
                                    <option value="<?= $unv['id']; ?>" <?= $selected; ?>><?= $unv['name']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "No University stays Available";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <input type="hidden" name="old_images" value="<?= $data['images']; ?>">
                                <label class="mb-0 fw-bold text-dark" for="">Upload Images</label>
                                <input type="file" name="images[]" multiple class="form-control mb-3 image-container" id="images">
                                <div class="image-grid">
                                    <?php foreach ($images as $image): ?>
                                    <img src="<?= $image; ?>" width="100px" height="100px" class="m-2">
                                    <?php endforeach; ?>
                                </div>
                                <div id="preview"></div>
                            </div>
                            <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label fw-bold text-dark "  for="capacity">Capacity</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="capacity" class="form-control" value="<?= $data['capacity'];?>">
                                    </div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="bathroom" class="form-check-input" id="bathroom" <?= $data['bathroom'] ? 'checked' : '' ?>> 
                                    <label class="form-check-label fw-bold text-dark " for="bathroom" >Bathroom</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="kitchen" class="form-check-input" id="kitchen" <?= $data['kitchen'] ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold text-dark " for="kitchen">Kitchen</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="ac" class="form-check-input" id="ac" <?= $data['ac'] ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold text-dark " for="ac">Air Conditioning</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="heating" class="form-check-input" id="heating" <?= $data['heating'] ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold text-dark " for="heating">Heating</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label fw-bold text-dark "  for="size">Size (sq ft)</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="size" class="form-control" value="<?= $data['size'];?>">
                                    </div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="furnished" class="form-check-input" id="furnished" <?= $data['furnished'] ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold text-dark " for="furnished" >Furnished</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="balcony" class="form-check-input" id="balcony" <?= $data['balcony'] ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold text-dark " for="balcony">Balcony</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="laundry" class="form-check-input" id="laundry" <?= $data['laundry'] ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold text-dark " for="laundry">Laundry</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="pet_friendly" class="form-check-input" id="pet_friendly" <?= $data['pet_friendly'] ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold text-dark " for="pet_friendly">Pet-friendly</label>
                                </div>
                            </div>
                            

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="edit_chamber_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            } else {
                echo "ID missing from URL";
            }
            ?>
        </div>
    </div>
</div>

<script>
    document.querySelector('#images').onchange = function() {
        let files = document.querySelector('#images').files;
        let preview = document.getElementById('preview');

        function readAndPreview(file) {
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                let reader = new FileReader();

                reader.addEventListener("load", function() {
                    let image = new Image();
                    image.height = 100;
                    image.width = 100;
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

<?php include('includes/footer.php'); ?>
