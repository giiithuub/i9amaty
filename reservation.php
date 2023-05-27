<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('includes/header.php');
include('config/dbcon.php');

// Get the chamber ID and unv information from the URL
        $chamberId = $_GET['id'];
        $chamber = getByID('chambers',$chamberId);
        $unv_id = isset($chamber['unv_id']) ? $chamber['unv_id'] : '';



        // Fetch the available inforamtion
        $dates = getChamberDates($chamberId);
        $university = getByID('university_stays',$unv_id);


        // Extract the dates
        $from_date = isset($dates['available_date_from']) ? $dates['available_date_from'] : '';
        $to_date = isset($dates['available_date_to']) ? $dates['available_date_to'] : '';

        // Extract the price
        $pricePerNight = isset($chamber['price']) ? $chamber['price'] : 0;

        // Get today's date
        $todaysDate = date("Y-m-d");

        // Get the dates from form submission
        $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
        $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';

        // Calculate the total
        $numDays = ceil((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24));
        $total = $numDays * $pricePerNight;
?>


 <!-- breadcrumb part start-->
 <section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>confirmation</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb part end-->

  <!--================ confirmation part start =================-->
  <section class="confirmation_part p-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="confirmation_tittle">
            <span>Thank you. Your order has been received.</span>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>order info</h4>
            <ul>
              <li>
              <p>Order Date</p><span>: <?php echo $todaysDate; ?></span>
                          
              <li>
              <p>Price Per Night</p><span>: USD <?php echo $pricePerNight; ?></span>
              <li>
                <p>mayment method</p><span>: Check payments</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
            <div class="single_confirmation_details">
                <h4>University Stay Address</h4>
                <ul>
                    <li>
                        <p>city</p><span>: <?php echo isset($university['city']) ? $university['city'] : ''; ?></span>
                    </li>
                    <li>
                        <p>State</p><span>: <?php echo isset($university['state']) ? $university['state'] : ''; ?></span>
                    </li>
                    <li>
                        <p>Country</p><span>: <?php echo isset($university['country']) ? $university['country'] : ''; ?></span>
                    </li>
                </ul>
            </div>
        </div>


        <div class="billing_details pt-5">
          <div class="row">
            <div class="col-lg-8">
              <h3>Billing Details</h3>
              <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" id="first" name="first_name" required />
                  <span class="placeholder" data-placeholder="First name"></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" id="last" name="last_name" required />
                  <span class="placeholder" data-placeholder="Last name"></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" id="number" name="phone_number" required />
                  <span class="placeholder" data-placeholder="Phone number"></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input type="text" class="form-control" id="add1" name="address_line1" required />
                  <span class="placeholder" data-placeholder="Address line"></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input type="text" class="form-control" id="add2" name="address_line2" required />
                  <span class="placeholder" data-placeholder="Town/City"></span>
                </div>
                <div class="col-md-12 form-group p_star">
                  <input type="text" class="form-control" id="city" name="state" required />
                  <span class="placeholder" data-placeholder="State"></span>
                </div>
                <div class="col-md-12 form-group">
                  <input type="text" class="form-control" id="zip" name="postcode" placeholder="Postcode/ZIP" required />
                </div>
                <div class="col-md-12 form-group">
                  <div class="creat_account">
                    <h3>Order Details</h3>
                    <input type="hidden" id="price_per_night" value="<?php echo $pricePerNight; ?>">

                  </div>
                  <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                </div>
                 
                <div class="col-md-12 form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" min="<?php echo $from_date; ?>" max="<?php echo $to_date; ?>" required />
                </div>
                <div class="col-md-12 form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date" min="<?php echo $from_date; ?>" max="<?php echo $to_date; ?>" required />
                    <small class="text-danger" id="date-error" style="display: none;">End date should be after the start date.</small>
                </div>
                <div class="col-md-12 form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="order_details_iner">
                <h3>Order Details</h3>
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col" colspan="2">Product</th>
                      <th scope="col">Duration</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <th colspan="2"><span><?php echo $chamber['name']; ?></span></th>
                    <th><span id="duration">days</span></th>
                    <th><span id="total">DZD 0.00</span></th>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th scope="col" colspan="3">Quantity</th>
                      <th scope="col">Total</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ confirmation part end =================-->

<?php include('includes/footer.php'); ?>

<script>
  // Validation for start date and end date
  document.getElementById("start_date").addEventListener("change", function() {
    var selectedStartDate = new Date(this.value);
    var selectedEndDate = new Date(document.getElementById("end_date").value);

    if (selectedEndDate < selectedStartDate) {
      document.getElementById("date-error").style.display = "block";
    } else {
      document.getElementById("date-error").style.display = "none";
    }
  });

  document.getElementById("end_date").addEventListener("change", function() {
    var selectedStartDate = new Date(document.getElementById("start_date").value);
    var selectedEndDate = new Date(this.value);

    if (selectedEndDate < selectedStartDate) {
      document.getElementById("date-error").style.display = "block";
    } else {
      document.getElementById("date-error").style.display = "none";
    }
  });

  $(document).ready(function() {
    $("#start_date").on("change", function() {
        var selectedStartDate = new Date($(this).val());
        $("#end_date").attr("min", $(this).val());

      
        var selectedEndDate = new Date($("#end_date").val());
        if (selectedEndDate < selectedStartDate) {
            $("#end_date").val("");
        }
        
    });

    $("#end_date").on("change", function() {
        var selectedEndDate = new Date($(this).val());
        $("#start_date").attr("max", $(this).val());

        // Clear start date if it is after the selected end date
        var selectedStartDate = new Date($("#start_date").val());
        if (selectedEndDate < selectedStartDate) {
            $("#start_date").val("");
        }
    });

    // Validation for start date and end date
    $(".contact_form").on("submit", function(event) {
        var startDate = new Date($("#start_date").val());
        var endDate = new Date($("#end_date").val());

        if (endDate < startDate) {
            event.preventDefault(); // Prevent form submission
            $("#date-error").show();
        } else {
            $("#date-error").hide();
        }
    });
});


$(document).ready(function() {
    var pricePerNight = $("#price_per_night").val();

    // When either date input changes
    $("#start_date, #end_date").change(function() {
        var startDate = new Date($("#start_date").val());
        var endDate = new Date($("#end_date").val());

        if(startDate != "" && endDate != ""){
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var numDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

            // Update the duration and total
            $("#duration").text( numDays + 'Days' );
            $("#total").text('DZD ' + (numDays * pricePerNight).toFixed(2));
        } else {
            $("#duration").text('0 days');
            $("#total").text('DZD 0.00');
        }
    });
});






</script>
