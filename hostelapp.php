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
		$update_status_sql="update hostel set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from hostel where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select * from hostel where status='pending' order by id desc";

$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">HOSTEL </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th width="2%">ID</th>
							   <th width="10%">Hostel Name</th>
							   <th width="8%">Number of room</th>
							   <th width="10%">Location</th>
							    <th width="10%">Room type</th>
								 <th width="10%">Room price</th>
								  <th width="10%">Status</th>
								  <th width="10%">image</th>
								  <th width="10%">Date</th>
							   <th width="20%">Action</th>
		
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
						<td><?php echo $row['id'];?></td>
			                 <td><?php echo $row['hostel_name'];?></td>
			                 <td><?php echo $row['number_of_room'];?></td>
			                 <td><?php echo $row['location'];?></td>
			                 <td><?php echo $row['room_type'];?></td>
                             <td><?php echo $row['room_price'];?></td>
							  <td><?php echo $row['status'];?></td>
							  <td><?php echo $row['image'];?></td>
							  <td><?php echo $row['created_date'];?></td>
							   <td>
								<?php
								if($row['status']=='pending'){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=pending&id=".$row['id']."'>Approve</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=approve&id=".$row['id']."'>Pending</a></span>&nbsp;";
								}
							
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							
							<?php } ?>
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