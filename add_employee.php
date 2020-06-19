<?php
require('top.inc.php');
$name='';
$email='';
$mobile='';
$services_id='';
$address='';
$CIN='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	if($_SESSION['ROLE']==2 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from employee where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$name=$row['name'];
	$email=$row['email'];
	$mobile=$row['mobile'];
	$services_id=$row['services_id'];
	$address=$row['address'];
	$CIN=$row['CIN'];
}
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$services_id=mysqli_real_escape_string($con,$_POST['services_id']);
	$address=mysqli_real_escape_string($con,$_POST['address']);
	$CIN=mysqli_real_escape_string($con,$_POST['CIN']);
	if($id>0){
		$sql="update employee set name='$name',email='$email',mobile='$mobile',password='$password',services_id='$services_id',address='$address',CIN='$CIN' where id='$id'";
	}else{
		$sql="insert into employee(name,email,mobile,password,services_id,address,CIN,role) values('$name','$email','$mobile','$password','$services_id','$address','$CIN','2')";
	}
	mysqli_query($con,$sql);
	header('location:employee.php');
	die();
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>employee</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
									<label class=" form-control-label">Name</label>
									<input type="text" value="<?php echo $name?>" name="name" placeholder="Enter employee name" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Email</label>
									<input type="email" value="<?php echo $email?>" name="email" placeholder="Enter employee email" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Mobile</label>
									<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter employee mobile" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Password</label>
									<input type="password"  name="password" placeholder="Enter employee password" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">services</label>
									<select name="services_id" required class="form-control">
										<option value="">Select services</option>
										 <?php
										$res=mysqli_query($con,"select * from services order by services desc");
										while($row=mysqli_fetch_assoc($res)){
											if($services_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['services']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['services']."</option>";
											}
										}
										?> 
									</select>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Address</label>
									<input type="text" value="<?php echo $address?>" name="address" placeholder="Enter employee address" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">CIN</label>
									<input type="text" value="<?php echo $CIN?>" name="CIN" placeholder="Enter employee CIN" class="form-control" required>
								</div>
							   <?php if($_SESSION['ROLE']==1){?>
							   <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							 <?php } ?>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
                  
<?php
require('footer.inc.php');
?>