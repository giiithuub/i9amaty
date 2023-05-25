<?php   
session_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}

?>

<div class="conainer">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Chambers</h4>
                </div>
                <div class="card-body" id="chambers_table">
                    <table class="table table-bordred table-striped table-hover">
                        <thead>
                            <tr class="table-info">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Edit</th>   
                                <th>Delete</th>                       
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $chambers = getAll("chambers");
        
                            if(mysqli_num_rows($chambers) > 0)
                            {
                                foreach($chambers as $item)
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
                                        <td>
                                            <?= $item['status'] == '0' ? "Visible" : "Hidden"?>
                                        </td>
                                        <td>
                                            <?= $item['price']; ?>
                                        </td>
                                        <td>
                                            <a href="edit-chamber.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-danger btn-sm delete_chamber_btn" name="delete_chamber" value="<?= $item['id'];?>">Delete</button>
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

<?php   include('includes/footer.php');?>
