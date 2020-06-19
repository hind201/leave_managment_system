<?php
require('top.inc.php');
if($_SESSION['ROLE']!=1){
	header('location:add_employee.php?id='.$_SESSION['USER_ID']); // cette condition pour revient à la page de add employee c'a d lorsque le role devient >1 le role prend 2 et 2 c'est l'employe.
   die();
}
$services='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$res=mysqli_query($con,"select * from services where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$services=$row['services'];
}
if(isset($_POST['services'])){
	$services=mysqli_real_escape_string($con,$_POST['services']);
	if($id>0){
		$sql="update services set services='$services' where id='$id'";
	}else{
		$sql="insert into services(services) values('$services')";
	}
	mysqli_query($con,$sql);
	header('location:index.php');
	die();
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>services</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
								<label for="servises" class=" form-control-label">services Name</label>
								<input type="text" value="<?php echo $services ?>" name="services" placeholder="Enter your services name" class="form-control" required></div>
							   
							   <button  type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
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