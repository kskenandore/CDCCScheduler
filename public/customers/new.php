<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Customers'; ?>
<?php include('../../private/shared/header.php'); ?>

<?php

/*	// For troubleshooting purposes
	print_r($_POST);
	echo "<br />";
 */


  /* Set logic handling variables named to improve readability */
	$fieldsfilled = false;
	$firstpageload = empty($_POST);

  // Create arrays for processing conditions on data elements
	$rlist = array('fname', 'lname', 'address1', 'city', 'state', 'zipcode', 'phone', 'email');

  // Create code friendly handles for select form data elements
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zipcode = $_POST['zipcode'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];

  /* Determine page state and if any required fields are empty */
	if ( !$firstpageload ) {
		foreach ( $rlist as $vval ) {
			if ( $_POST[$vval] == NULL ) {
				$fieldsfilled = false;
				break;
			} else {
				$fieldsfilled = true;
			}
		}
	}

?>

    <div id="content" class="clear">
        <h2>New Customer</h2>
        <form id="fcform" class="clear" action=<?php
          /* Determine if form is good to proceed to confirmation page */
        	if ( $firstpageload || !$fieldsfilled ) {
        		echo '"new.php "';
        	} else {
        		echo '"newhandle.php "';
        		$autosubmit = true;
      	  }
        ?>
        method="post">
            <label for="fname">First name: </label>
            <input type="text" name="fname" value="<?php
              /* Determine if date to keep exists */
        			if ($_POST['fname'] != NULL) {
        				echo "$fname";
        			}
      			?>"/><?php
              /* Determine if field needed */
      				if ($_POST['fname'] == NULL && !$firstpageload) {
      					echo "<span class='valid'>* First Name Required</span><br/>";
      				}
             ?>

            <label for="lname">Last name: </label>
            <input type="text" name="lname" value="<?php
              /* Determine if date to keep exists */
        			if ($_POST['lname'] != NULL) {
        				echo "$lname";
        			}
      			?>"/><?php
              /* Determine if field needed */
      				if ($_POST['lname'] == NULL && !$firstpageload) {
      					echo "<span class='valid'>* Last Name Required</span><br/>";
      				}
             ?>

            <label for="address1">Address 1: </label>
            <input type="text" name="address1" value="<?php
              /* Determine if date to keep exists */
        			if ($_POST['address1'] != NULL) {
        				echo "$address1";
        			}
      			?>"/><?php
              /* Determine if field needed */
      				if ($_POST['address1'] == NULL && !$firstpageload) {
      					echo "<span class='valid'>* Address 1 Required</span><br/>";
      				}
             ?>

            <label for="address2">Address 2: </label>
            <input type="text" name="address2" value="<?php
              /* Determine if date to keep exists */
        			if ($_POST['address2'] != NULL) {
        				echo "$address2";
        			}
      			?>"/>

            <label for="city">City: </label>
            <input type="text" name="city" value="<?php
              /* Determine if date to keep exists */
        			if ($_POST['city'] != NULL) {
        				echo "$city";
        			}
      			?>"/><?php
              /* Determine if field needed */
      				if ($_POST['city'] == NULL && !$firstpageload) {
      					echo "<span class='valid'>* City Required</span><br/>";
      				}
             ?>

            <label for="state">State: </label>
            <input type="text" name="state" value="<?php
              /* Determine if date to keep exists */
        			if ($_POST['state'] != NULL) {
        				echo "$state";
        			}
      			?>"/><?php
              /* Determine if field needed */
      				if ($_POST['state'] == NULL && !$firstpageload) {
      					echo "<span class='valid'>* State Required</span><br/>";
      				}
             ?>

            <label for="zipcode">Zipcode: </label>
            <input type="text" name="zipcode" value="<?php
              /* Determine if date to keep exists */
        			if ($_POST['zipcode'] != NULL) {
        				echo "$zipcode";
        			}
      			?>"/><?php
              /* Determine if field needed */
      				if ($_POST['zipcode'] == NULL && !$firstpageload) {
      					echo "<span class='valid'>* Zip Code Required</span><br/>";
      				}
             ?>

            <label for="phone">Phone: (xxx-xxx-xxxx)</label>
            <input type="tel" name="phone" required pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
              placeholder="123-4567-8901" value="<?php
              /* Determine if date to keep exists */
        			if ($_POST['phone'] != NULL) {
        				echo "$phone";
        			}
      			?>"/><?php
              /* Determine if field needed */
      				if ($_POST['phone'] == NULL && !$firstpageload) {
      					echo "<span class='valid'>* Phone Required</span><br/>";
      				}
             ?>

            <label for="email">Email: </label>
            <input type="email" name="email" value="<?php
              /* Determine if date to keep exists */
        			if ($_POST['email'] != NULL) {
        				echo "$email";
        			}
      			?>"/><?php
              /* Determine if field needed */
      				if ($_POST['email'] == NULL && !$firstpageload) {
      					echo "<span class='valid'>* Email Required</span><br/>";
      				}
             ?>

            <label for="org">Organization: </label>
            <select name="org">
                <option value="NULL">None</option>
                <?php
                  // SQL to retrieve database records with formatted date result
                  $sql = "SELECT org_id, name FROM organizations order by name";

                  // Execute SQL and save result
                  $result = mysqli_query($dbc, $sql);

                  // Loop through each row returned by datbase
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if ( $_POST['org'] == $row['org_id'] ) {
                      echo '<option value="' . $row['org_id'] . '" selected>' . $row['name'] . '</option>';
                    } else {
                      echo '<option value="' . $row['org_id'] . '">' . $row['name'] . '</option>';
                    }
                  }
                ?>
            </select>

            <input type="submit" value="Create New Customer"/>
        </form>

        <?php if ($autosubmit) {
                //Submit form if all required fields are filled out
            echo"<script>document.getElementById('fcform').submit();</script> ";
        } ?>

        <a href="index.php" class="cancel-btn">&#8592; Cancel</a>
    </div>

<?php //include('../../private/shared/footer.php'); ?>
