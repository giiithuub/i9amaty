<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('includes/header.php');
include('config/dbcon.php');


// put the parameters in the $index variable
$link = "http://" . $_SERVER['SERVER_NAME'] . '/UniStay';
// index.php link with the current parameters

// Get the chamber ID from the URL
$chamberId = $_GET['id']; // Replace 'id' with the actual key you are using in the URL

// Fetch the available dates
$dates = getChamberDates($chamberId);

// Extract the dates
$from_date = isset($dates['available_date_from']) ? $dates['available_date_from'] : '';
$to_date = isset($dates['available_date_to']) ? $dates['available_date_to'] : '';

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
                <p>data</p><span>: Oct 03, 2017</span>
              </li>
              <li>
                <p>total</p><span>: USD 2210</span>
              </li>
              <li>
                <p>mayment methord</p><span>: Check payments</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>University Stay Address</h4>
            <ul>
              <li>
                <p>city</p><span>: Los Angeles</span>
              </li>
              <li>
                <p>country</p><span>: United States</span>
              </li>
              <li>
                <p>postcode</p><span>: 36952</span>
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
                    <h3>Shipping Details</h3>
                  </div>
                  <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                </div>
                 
                <div class="col-md-12 form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" min="<?php echo $from_date; ?>" max="<?php echo $to_date; ?>" required />
                </div>
                <div class="col-md-12 form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" min="<?php echo $from_date; ?>" max="<?php echo $to_date; ?>" required />
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
                    <tr>
                      <th colspan="2"><span>Pixelstore fresh Blackberry</span></th>
                      <th>x02</th>
                      <th><span>$720.00</span></th>
                    </tr>
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
</script>
