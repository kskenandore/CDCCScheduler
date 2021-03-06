<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Reservations'; ?>
<?php include('../../private/shared/header.php'); ?>

<?php
/*	// For troubleshooting purposes
  print_r($_POST);
  print_r($_GET);
  echo "<br />";
  // */


  // Create code friendly handles for select form data elements

  if ( $_POST['search'] != NULL ) {

    $searchstr = strtoupper($_POST['search']);

    if ( $_GET['src'] == "V") {
      $whereclause = ' where upper(v.name) like \'%' . $searchstr . '%\' ';
    }

    if ( $_GET['src'] == "C") {
      $whereclause = ' where upper(c.last_name) like \'%' . $searchstr . '%\' OR ' .
        'upper(c.first_name) like \'%' . $searchstr . '%\' ';
    }


  }

 ?>

    <div id="content" class="clear">
        <h2><?php echo $page_title; ?></h2>
        <a href="new.php" class="button">+ New</a>

        <form class="search" method="post">
            <input type="text" placeholder=" search..." name="search"/>
            <input type="submit" value="by Customer" formaction="index.php?src=C" class="button"/>
            <input type="submit" value="by Venue" class="button" formaction="index.php?src=V"/>
        </form>

        <table class="clear">
            <tr>
                <th>Reservation ID</th>
                <th>Customer</th>
                <th>Venue</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>Actions</th>
            </tr>
            <?php
              // SQL to retrieve database records with formatted date result
            	$sql = "SELECT a.reservation_id, concat(c.last_name, ', ', c.first_name  ) cname, v.name vname, DATE_FORMAT(`start_timestamp`, \"%c-%d-%Y\") rdate, DATE_FORMAT(`start_timestamp`, \"%l:%i %p\") rtime, cancellation
                      from reservations a
                      inner join customers c
                      on a.customer_id = c.customer_id
                      inner join venues v
                      on a.venue_id = v.venue_id
                      $whereclause
                      order by a.reservation_id";

              //echo $sql;

            	// Execute SQL and save result
            	$result = mysqli_query($dbc, $sql);

              // Loop through each row returned by datbase
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                  if ($row['cancellation'] == 1){
                      continue;
                  }
                echo '<tr>';
                echo '<td>' . $row['reservation_id'] . '</td>';
                echo '<td>' . $row['cname'] . '</td>';
                echo '<td>' . $row['vname'] . '</td>';
                echo '<td>' . $row['rdate'] . '</td>';
                echo '<td>' . $row['rtime'] . '</td>';
                echo '<td><a href="edit.php?id=' . $row['reservation_id'] . '" class="button">Edit</a> <a href="cancel.php?id=' . $row['reservation_id'] . '" class="button">Cancel</a></td>';
                echo '</tr>';
              }
             ?>
        </table>

        <p id="report">Reporting Options:</p>
        <a href="rptresbycust.php" class="report">Reservations by Customers</a>
        <a href="rptresbydate.php" class="report">Reservations by Date</a>
    </div>

<?php include('../../private/shared/footer.php'); ?>
