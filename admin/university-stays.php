<?php   
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>University Stays</h4>
                </div>
                <div class="card-body" id="university_stays_table">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="table-info">
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                
                                <th>Address</th>
                                
                                <th>Total Chambers</th>
                                
                                
                                <th>Contact Email</th>
                                <th>Contact Phone</th>
                                <th>Edit</th>   
                                <th>Delete</th>                       
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $university_stays = getAll("university_stays");
        
                            if(mysqli_num_rows($university_stays) > 0)
                            {
                                foreach($university_stays as $item)
                                {
                                    // Extract the first image from the images string
                                    $images = explode(",", $item['images']);
                                    $firstImage = count($images) > 0 ? $images[0] : '';
                                    ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td>
                                            <img src="<?= $firstImage; ?>" width="50px" height="50px" alt="<?= $item['name'] ?>">
                                        </td>
                                    
                                    
                                        
                                       
                                        <td><?= $item['address']; ?></td>
                                        
                                        <td><?= $item['total_chambers']; ?></td>
                                        
                                        
                                        <td><?= $item['contact_email']; ?></td>
                                        <td><?= $item['contact_phone']; ?></td>
                                        <td>
                                            <a href="edit-university-stay.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-danger btn-sm delete_university_stay_btn" name="delete_university_stay_btn" value="<?= $item['id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                              <?php      
                                }
                            }
                            else
                            {
                                echo "No Record Found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
