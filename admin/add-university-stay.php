<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>
 <style>
        body { margin: 0; padding: 0; }
        #map {
        width: 100%; 
        height: 500px; 
    }

    .geocoder {
        position: relative;
        z-index: 1;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 20px;
    }
    </style>


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
                                    <label class="form-check-label" for="resturant">Resturant</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="library" id="library" name="library">
                                    <label class="form-check-label" for="library">Library</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="total_chambers">Total Number of Chambers</label>
                                <input type="number" name="total_chambers" required placeholder="Enter total number of chambers" class="form-control mb-3">
                            </div>

                            <div class="col-md-6">
                                <label class="mb-0 fw-bold text-dark" for="price_range">Price Range</label>
                                <input type="text" required name="price_range" placeholder="Enter price range" class="form-control mb-3">
                            </div>
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
                            <div id='map'></div>
                                     <div id='geocoder' class='geocoder'></div>
                              </div>
                              <input type="text" id="city" name="city">
                                <input type="text" id="state" name="state">
                                <input type="text" id="country" name="country">
                                <input type="text" id="lat" name="lat">
                                <input type="text" id="lng" name="lng">


                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_university_stay_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css" type="text/css" />
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css" />

<script>
    document.querySelector('input[type="file"]').onchange = function() {
        let files = document.querySelector('input[type="file"]').files;
        let preview = document.getElementById('preview');

        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
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

    mapboxgl.accessToken = 'pk.eyJ1IjoiYmxhbWFpcmlhIiwiYSI6ImNsaHYxaDFhdzA1Z2Iza3BjOG53enhtdjAifQ.HW5SGmGoYH_47pO1lIRGzQ';

    // Create a new map instance
    var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [0, 0],
            zoom: 2
        });

        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker: {
                color: 'orange'
            },
            placeholder: 'Search for places',
        });

        // Add geocoder result to the map
        map.addControl(geocoder);

        // Create a draggable marker
        var marker = new mapboxgl.Marker({
            draggable: true
        }).setLngLat([0, 0]).addTo(map);

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            fetchLocationInfo(lngLat.lng, lngLat.lat);
        }
        
        marker.on('dragend', onDragEnd);

        geocoder.on('result', function(ev) {
            marker.remove();  // remove old marker
            marker = new mapboxgl.Marker({ // create new marker
                draggable: true
            }).setLngLat(ev.result.geometry.coordinates).addTo(map);
            marker.on('dragend', onDragEnd);
            fetchLocationInfo(ev.result.geometry.coordinates[0], ev.result.geometry.coordinates[1]);
        });

        

        function fetchLocationInfo(lon, lat) {
    fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lon},${lat}.json?access_token=${mapboxgl.accessToken}`)
        .then(response => response.json())
        .then(data => {
            var place = data.features[0];
            var city = '', state = '', country = '';
            place.context.forEach(function (item) {
                if (item.id.includes('place')) city = item.text;
                if (item.id.includes('region')) state = item.text;
                if (item.id.includes('country')) country = item.text;
            });
            
            // store the values in hidden fields
            document.getElementById('city').value = city;
            document.getElementById('state').value = state;
            document.getElementById('country').value = country;
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lon;
        })
        .catch(error => console.error(error));
}

</script>
<?php include('includes/footer.php'); ?>
