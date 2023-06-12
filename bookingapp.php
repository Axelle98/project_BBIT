<?php
require('top.php');
isManager();

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='approve'){
			$status='pending';
		}else{
			$status='approve';
		}
		$update_status_sql="update book set status='$status' where booking_id='$id'";
	mysqli_query($con,$update_status_sql);}
	if($type=='post'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='postponed'){
			$status='pending';
		}else{
			$status='postponed';
		}
		$update_status_sql="update book set status='$status' where booking_id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['booking_id']);
		$delete_sql="delete from book where booking_id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">BOOKING </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th width="2%">ID</th>
							   <th width="10%">Userame</th>
							   <th width="10%">Check in</th>
							   <th width="8%">Duration</th>
							    <th width="10%">Room type</th>
								 <th width="10%">Hostel name</th>
								  <th width="10%">Payment type</th>
								  <th width="10%">Attachment</th>
							  <th width="4%">Status</th>
							  <th width="4%">Date</th>
							   <th width="26%">Action</th>
		
							</tr>
						 </thead>
						 <tbody>
							<?php 
							mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
							$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql="select * from book where status='pending' ";

$res=mysqli_query($conn, $sql);
							$i=1;
							
                         
                    if (mysqli_num_rows($res) > 0) {
							while($row = mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
						<td><?php echo $row['booking_id'];?></td>
			                 <td><?php echo $row['username'];?></td>
			                 <td><?php echo $row['check_in'];?></td>
			                 <td><?php echo $row['duration'];?></td>
			                 <td><?php echo $row['room_type'];?></td>
                             <td><?php echo $row['hostel_name'];?></td>
							  <td><?php echo $row['payment_type'];?></td>
							  <td><?php echo $row['attachment'];?></td>
				           <td><?php echo $row['status'];?></td>
							  <td><?php echo $row['created_date'];?></td>
							   <td>
								<?php
								if($row['status']=='pending'){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=pending&id=".$row['booking_id']."'>Approve</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=approve&id=".$row['booking_id']."'>Pending</a></span>&nbsp;";
								}
							    if($row['status']=='pending'){
									echo "<span class='badge badge-complete'><a href='?type=post&operation=pending&id=".$row['booking_id']."'>Postponed</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=post&operation=postponed&id=".$row['booking_id']."'>Pending</a></span>&nbsp;";
								}
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['booking_id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							
							<?php }} ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<div class="clearfix"></div>
         <footer class="site-footer">
            <div class="footer-inner bg-white">
               <div class="row">
                  <div class="col-sm-6">
                
				<p><center>  <h5><b>Welcome dear Manager</b></h5></center></p>
				 
                  </div>                
               </div>
            </div>
         </footer>
</div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>