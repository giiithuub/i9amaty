<?php 
    session_start();
    include('../config/dbcon.php');
    include('../functions/myfunctions.php');

    if (isset($_POST['add_university_stay_btn'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $address = $_POST['address'];
        $gym = isset($_POST['gym']) ? 1 : 0;
        $resturant = isset($_POST['resturant']) ? 1 : 0;
        $library = isset($_POST['library']) ? 1 : 0;
        $total_chambers = $_POST['total_chambers'];
        $price_range = $_POST['price_range'];
        $contact_person = $_POST['contact_person'];
        $contact_email = $_POST['contact_email'];
        $contact_phone = $_POST['contact_phone'];
    
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];

        $images = [];
        if (isset($_FILES['images'])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['images']['name'][$key];
                $file_tmp = $_FILES['images']['tmp_name'][$key];
    
                // Assuming you want to put images into an 'uploads/' directory
                $newFilePath = "uploads/" . $file_name;
                if (move_uploaded_file($file_tmp, $newFilePath)) {
                    $images[] = $newFilePath;
                }
            }
        }
        $imagesStr = implode(",", $images);
    
        $query = "INSERT INTO university_stays (name, description, address, gym, resturant, library, total_chambers, price_range, contact_person, contact_email, contact_phone, images, city, state, country, lat, lng)
    VALUES ('$name', '$description', '$address', '$gym', '$resturant', '$library', '$total_chambers', '$price_range', '$contact_person', '$contact_email', '$contact_phone', '$imagesStr', '$city', '$state', '$country', '$lat', '$lng')";

    
        $query_run = mysqli_query($con, $query);
    
        if ($query_run) {
            $_SESSION['message'] = "University Stay Added";
            header('Location: add-university-stay.php');
        } else {
            $_SESSION['message'] = "University Stay Not Added";
            header('Location: add-university-stay.php');
        }
    }

    if (isset($_POST['add_chamber_btn'])) {
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $small_description = $_POST['small_description'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $unv_id = $_POST['unv_id'];
       
        $room_type = $_POST['room_type'];

        $unv = getByID("university_stays", $unv_id);
        $unv_name = $unv['name'];
    
    
        $status = isset($_POST['status']) ? 1 : 0;
        $capacity = $_POST['capacity'];
        $bathroom = isset($_POST['bathroom']) ? 1 : 0;
        $kitchen = isset($_POST['kitchen']) ? 1 : 0;
        $ac = isset($_POST['ac']) ? 1 : 0;
        $heating = isset($_POST['heating']) ? 1 : 0;
        $furnished = isset($_POST['furnished']) ? 1 : 0;        
        $size = $_POST['size'];
        $balcony = isset($_POST['balcony']) ? 1 : 0;
        $laundry = isset($_POST['laundry']) ? 1 : 0;
        $pet_friendly = isset($_POST['pet_friendly']) ? 1 : 0;
    
        $images = [];
        if (isset($_FILES['images'])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['images']['name'][$key];
                $file_tmp = $_FILES['images']['tmp_name'][$key];
    
                // Assuming you want to put images into an 'uploads/' directory
                $newFilePath = "uploads/" . $file_name;
                if (move_uploaded_file($file_tmp, $newFilePath)) {
                    $images[] = $newFilePath;
                }
            }
        }
        $imagesStr = implode(",", $images);
    
        $query = "INSERT INTO chambers (name, slug, small_description, description, price, status, capacity, bathroom, kitchen, ac, heating, furnished, size, balcony, laundry, pet_friendly, images, unv_id, unv_name, room_type)
                  VALUES ('$name', '$slug', '$small_description', '$description', '$price', '$status', '$capacity', '$bathroom', '$kitchen', '$ac', '$heating', '$furnished', '$size', '$balcony', '$laundry', '$pet_friendly', '$imagesStr', '$unv_id', '$unv_name', '$room_type')";
    
        $query_run = mysqli_query($con, $query);
        
        if ($query_run) {
            $_SESSION['message'] = "Chamber Added";
            header('Location: index.php');
        } else {
            $_SESSION['message'] = "Chamber Not Added";
            header('Location: add-chamber.php');
        }
        
    }
    


    if (isset($_POST['edit_chamber_btn'])) {
        // Connect to your database
        
        // Retrieve form inputs and sanitize them
        $chamber_id = mysqli_real_escape_string($con, $_POST['chamber_id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $slug = mysqli_real_escape_string($con, $_POST['slug']);
        $small_description = mysqli_real_escape_string($con, $_POST['small_description']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
         // new variables from the form
        $unv_id = mysqli_real_escape_string($con, $_POST['unv_id']);
        $unv = getByID("university_stays", $unv_id);
        $unv_name = $unv['name'];
    
        $room_type = mysqli_real_escape_string($con, $_POST['room_type']);
        
        
        $capacity = mysqli_real_escape_string($con, $_POST['capacity']);
        $size = mysqli_real_escape_string($con, $_POST['size']);
        $bathroom = isset($_POST['bathroom']) ? 1 : 0;
        $kitchen = isset($_POST['kitchen']) ? 1 : 0;
        $ac = isset($_POST['ac']) ? 1 : 0;
        $heating = isset($_POST['heating']) ? 1 : 0;
        $furnished = isset($_POST['furnished']) ? 1 : 0;
        $balcony = isset($_POST['balcony']) ? 1 : 0;
        $laundry = isset($_POST['laundry']) ? 1 : 0;
        $pet_friendly = isset($_POST['pet_friendly']) ? 1 : 0;
    
        // Handle file uploads
        $old_images = explode(",", $_POST['old_images']);
        $new_images = $_FILES['images'];
    
        if (isset($_FILES['images'])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['images']['name'][$key];
                $file_tmp = $_FILES['images']['tmp_name'][$key];
    
                // Assuming you want to put images into an 'uploads/' directory
                $newFilePath = "uploads/" . $file_name;
                if (move_uploaded_file($file_tmp, $newFilePath)) {
                    $old_images[] = $newFilePath;
                }
            }
        }
    
        // Convert the array back into a string
        $images = implode(",", $old_images);
    
        // Update the database
        $query = "UPDATE chambers SET name='$name', slug='$slug', small_description='$small_description', description='$description', price='$price', capacity='$capacity', size='$size', bathroom='$bathroom', kitchen='$kitchen', ac='$ac', heating='$heating', furnished='$furnished', balcony='$balcony', laundry='$laundry', pet_friendly='$pet_friendly', images='$images', unv_id='$unv_id', unv_name='$unv_name', room_type='$room_type' WHERE id='$chamber_id'";
        
        if (mysqli_query($con, $query)) {
            // Redirect to some success page
            header('Location: edit-chamber.php?id=' . $chamber_id);
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($con);
        }
    }
    
       else if (isset($_POST['edit_university_stay_btn'])) {
            // Connect to your database
            
            // Retrieve form inputs and sanitize them
            $university_stay_id = mysqli_real_escape_string($con, $_POST['university_stay_id']);
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $address = mysqli_real_escape_string($con, $_POST['address']);
            $gym = isset($_POST['gym']) ? 1 : 0;
            $resturant = isset($_POST['resturant']) ? 1 : 0;
            $library = isset($_POST['library']) ? 1 : 0;
            $total_chambers = mysqli_real_escape_string($con, $_POST['total_chambers']);
            $price_range = mysqli_real_escape_string($con, $_POST['price_range']);
            $contact_person = mysqli_real_escape_string($con, $_POST['contact_person']);
            $contact_email = mysqli_real_escape_string($con, $_POST['contact_email']);
            $contact_phone = mysqli_real_escape_string($con, $_POST['contact_phone']);
        
            // Handle file uploads
            $old_images = explode(",", $_POST['old_images']);
            $new_images = $_FILES['images'];
            
            if (isset($_FILES['images'])) {
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES['images']['name'][$key];
                    $file_tmp = $_FILES['images']['tmp_name'][$key];
        
                    // Assuming you want to put images into an 'uploads/' directory
                    $newFilePath = "uploads/" . $file_name;
                    if (move_uploaded_file($file_tmp, $newFilePath)) {
                        $old_images[] = $newFilePath;
                    }
                }
            }
        
            // Convert the array back into a string
            $images = implode(",", $old_images);
        
            // Update the database
            $query = "UPDATE university_stays SET name='$name', description='$description', address='$address', gym='$gym', resturant='$resturant', library='$library', total_chambers='$total_chambers', price_range='$price_range', contact_person='$contact_person', contact_email='$contact_email', contact_phone='$contact_phone', images='$images' WHERE id='$university_stay_id'";
        
            if (mysqli_query($con, $query)) {
                // Redirect to some success page
                header('Location: edit-university-stay.php?id=' . $university_stay_id);
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($con);
            }
        }
        
        

    
    
        if (isset($_GET['delete_chamber'])) {
            $chamber_id = $_GET['delete_chamber'];
        
            // Perform the deletion query
            $query = "DELETE FROM chambers WHERE id='$chamber_id'";
            if (mysqli_query($con, $query)) {
                // Deletion successful
                header('Location: chambers.php');
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($con);
            }
        }

        if (isset($_GET['delete_university_stay'])) {
            $university_stay_id = $_GET['delete_university_stay'];
        
            // Perform the deletion query
            $query = "DELETE FROM university_stays WHERE id='$university_stay_id'";
            if (mysqli_query($con, $query)) {
                // Deletion successful
                header('Location: university-stays.php');
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($con);
            }
        }
        
        
    
    
?>