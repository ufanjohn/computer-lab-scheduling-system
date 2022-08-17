<?php
	include('../includes/indexconfig.php');
    session_start();

	if(isset($_POST['fetch'])){		
		$uid=$_SESSION['UID'];
		$workgroup_id = $_POST['workgroup_id'];
		
		$query=mysqli_query($con,"select * from `chat` left join `tblusers` on tblusers.id=chat.user_id where workgroup_id='$workgroup_id' order by chat_date asc") or die(mysqli_error()); 
		while($row=mysqli_fetch_array($query)){
?>	
	<div class="chatcomp" data-id="<?php echo $row['user_id']?>">
		<div class="ms-5 chatelement" style="background:#f6f9ff">
			<img class="mt-2 rounded-circle" style="width:30px;height:30px" src="<?php echo $row['location']; ?>" alt="<?php echo $row['firstname'].' '.$row['surname'];?>">  
			<div class="ms-5" style="margin-top:-34px;">
				<h5 class="" style="display:inline; font-size:15px"><?php echo $row['firstname'].' '.$row['surname'];?></h5><br>
				<span class="text-muted" style="position:relative; display:inline; top:-1px; font-size:0.8rem"><?php echo date('M d ',strtotime($row['chat_date'])); ?> at <?php echo date('h:i A',strtotime($row['chat_date'])); ?></span>
			</div>
			<p class="wkmsg" style="margin-top: -5px;font-size: 14px;"><?php echo $row['message']; ?></p>
		</div>
	</div>		
			
			
<?php
		}
	}	
?>