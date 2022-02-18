<?php include('includes/header.php') ?>
<?php include('includes/connection.php');
		if(isset($_GET['hid']))
		{
			$hid = "'".$_GET['hid']."'";
			$query = "SELECT * FROM `doctor` WHERE hid = $hid";
			$result = mysqli_query($conn,$query);
			$rows = mysqli_num_rows($result);
		}
		if(isset($_GET['did']))
		{
			$did = $_GET['did'];
		}
		
?>
<?php
 	function getUname($uid)
    {
    	include('includes/connection.php');
    	$u_query = "SELECT * FROM `users` WHERE id = $uid";
        $uresult = mysqli_query($conn,$u_query);
        $u_row = mysqli_fetch_array($uresult);
        return $u_row['username'];
    }
?>
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
 <div class="panel panel-default">
 	<?php if(isset($_GET['hid'])) : ?>
    <div class="panel-heading">
     Doctors Available In the Hospital
    </div>
    <div>
      <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
        <thead>
          <tr>
            <th>Name</th>
            <th>Specialzation</th>
            <th data-breakpoints="xs">From</th>
            <th data-breakpoints="xs sm md" data-title="">Till</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        	<?php if($rows) : ?>
        	<?php while($row = mysqli_fetch_array($result)) : ?>
          	<tr data-expanded="true">
            <td><?php echo getUname($row['uid']); ?></td>
            <td><?php echo $row['specialArea']; ?></td>
            <td><?php echo $row['avail_from']; ?></td>
            <td><?php echo $row['avail_till']; ?></td>
            <td><a href="book.php?did=<?php echo $row['did']; ?>">Book Appointment</a></td>
          	</tr>
          	<?php endwhile; ?>
          <?php else : ?>
          	<tr>
            <td class="view-message dont-show">No Doctors registered in the hospital</td>
            </tr>
          <?php endif; ?> 
        </tbody>
      </table>
    </div>
	<?php endif; ?>
	<?php if(isset($_GET['did'])) : ?>
    <div class="panel-heading">Finish up the following details : </div>
    <div>
        <h1></h1>
    <div class="bg-agile">
    <div class="book-appointment">
    <h2>Make an appointment</h2>
            <form action="insert.php?did=<?php echo $_GET['did']?>" method="post">
            <div class="left-agileits-w3layouts same">
                <div class="gaps">
                <p>Symptoms : </p>
                        <textarea name="symptoms" rows="4" cols="50" required="" style="height: 80px;" ></textarea>
                </div>
            </div>
            <div class="right-agileinfo same">
            <div class="gaps">
                <p>Select Date : </p><input type="date" name="datein" required="">
            </div>
            </div>
            <div class="clear"></div>
            <input type="submit" value="Make an appointment">
            </form>
        </div>
   </div>
    </div>
    <?php endif; ?>
  </div>
</div>
</section>

 <!-- footer -->
		   <div class="footer">
            <div class="wthree-copyright">
              <p>© 2019 HEALTHCARE. All rights reserved | Design by <a href="https://github.com/apurva19">Apurva Sharma</a></p>
            </div>
          </div>
  <!-- / footer -->
</section>
<!--main content end-->

</section>

<script src="js/bootstrap.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<script type="text/javascript" src="js/wickedpicker.js"></script>
<script type="text/javascript">
				$('.timepicker').wickedpicker({twentyFour: false});
			</script>
		<!-- Calendar -->
				<link rel="stylesheet" href="css/jquery-ui.css" />
				<script src="js/jquery-ui.js"></script>
				  <script>
						  $(function() {
							$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
						  });
				  </script>
			<!-- //Calendar -->
			</body>
</html>
