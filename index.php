
 <?php 
	include_once '../db/connect.php';
	session_start();

 ?>
 <!-- check-dangnhap -->
<?php 
		if(isset($_POST['login'])){
		$email = $_POST['email'];
		$pass = md5($_POST['password']);
		$check = mysqli_query($mysqli,"SELECT * FROM tbl_admin WHERE email = '$email' AND password = '$pass'");
		$check_row = mysqli_num_rows($check);
		$get_account = mysqli_fetch_array($check);
		if($check_row > 0){
			$_SESSION['login'] = $get_account['name'];
			$_SESSION['admin_id'] = $get_account['adminId'];
			header('location:dashboard.php'); 
		}else{
			$_SESSION['login_fail'] = 'Email or Password invalid !!!';
		}
	}
 ?> 
<!-- end-check-dangnhap -->

<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Sign In Now</h2>
	<?php 
		if(isset($_SESSION['login_fail'])){
			echo '<div style="color:white">'.$_SESSION['login_fail'].'</div>';
			unset($_SESSION['login_fail']);
		}
	 ?>
		<form action="" method="post">
			<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
			<span><input type="checkbox" />Remember Me</span>
			<h6><a href="#">Forgot Password?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">
		</form>
		<p>Don't Have an Account ?<a href="registration.html">Create an account</a></p>
</div>
</div>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>

<?php 
	include 'include/header.php';
	//include 'include/slider.php';
 ?>
<?php 
	if (isset($_POST['addtocart'])) {
		if (isset($_SESSION['shopping_cart'])) {
			$item_array_id = array_column($_SESSION['shopping_cart'], 'item_id');
			if (!in_array($_POST['hidden_id'], $item_array_id)) {
				$count = count($_SESSION['shopping_cart']);
				$item_array = array(
				'item_id' => $_POST['hidden_id'],
				'item_name' => $_POST['hidden_name'],
				'item_quantity' => $_POST['hidden_quantity'],
				'item_price' => $_POST['hidden_price'],
				'item_image' => $_POST['hidden_image']
			);
				$_SESSION['shopping_cart'][$count] = $item_array;
				echo'<script>alert("Added '.$_POST['hidden_name'].' in Cart")</script>';
				echo "<script>window.location = 'index.php' </script>";  
				
			}else{
				echo '<script>alert("Already Product in cart")</script>';
			}
		}else{
			$item_array = array(
				'item_id' => $_POST['hidden_id'],
				'item_name' => $_POST['hidden_name'],
				'item_quantity' => $_POST['hidden_quantity'],
				'item_price' => $_POST['hidden_price'],
				'item_image' => $_POST['hidden_image']
			);
			$_SESSION['shopping_cart'][0] = $item_array;
			echo'<script>alert("Added '.$_POST['hidden_name'].' in Cart")</script>';
			echo "<script>window.location = 'index.php' </script>";  		
		}
	}
 ?>

	<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<!-- <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>O</span>ur
				<span>N</span>ew
				<span>P</span>roducts</h3> -->
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic">Best Seller</h3>
							<div class="row">
								<?php 
									$get_pro_best = mysqli_query($mysqli,"SELECT * FROM tbl_product WHERE status = 1 LIMIT 6");
									foreach ($get_pro_best as $key => $value_probest) {
										# code...
									
								 ?>
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="uploads/<?php echo $value_probest['image'] ?>" width = "200px" height="200px">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="details.php?proid=<?php echo $value_probest['productId'] ?>" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="details.php?proid=<?php echo $value_probest['productId'] ?>"><?php echo $value_probest['productName'] ?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price"><?php echo number_format($value_probest['price']).' VND' ?></span>
												
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
												<form action="" method="post">
													<fieldset>
														<input type="hidden" name="hidden_image" value="<?php echo $value_probest['image'] ?>">
														<input type="hidden" name="hidden_id" value="<?php echo $value_probest['productId'] ?>">
														<input type="hidden" name="hidden_name" value="<?php echo $value_probest['productName'] ?>" />
														<input type="hidden" name="hidden_quantity" value="1" />
														<input type="hidden" name="hidden_price" value="<?php echo $value_probest['price'] ?>" />
														<input type="submit" name="addtocart" value="Add to cart" class="button btn" />
													</fieldset>
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php 
									}
								 ?>
							</div>
						</div>
						<!-- //first section -->
						<!-- second section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic">New Arrival</h3>
							<div class="row">
								<?php 
									$get_new_arr = mysqli_query($mysqli,"SELECT * FROM tbl_product ORDER BY productId desc LIMIT 6");
									foreach ($get_new_arr as $key => $value_new) {
										# code...
									
								 ?>
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="uploads/<?php echo $value_new['image'] ?>" width="200" height="200">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="details.php?proid=<?php echo $value_new['productId'] ?>" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="details.php?proid=<?php echo $value_new['productId'] ?>"><?php echo $value_new['productName'] ?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price"><?php echo number_format($value_new['price']).' VND' ?></span>
												
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
												<form action="" method="post">
													<fieldset>
														<input type="hidden" name="hidden_image" value="<?php echo $value_new['image'] ?>">
														<input type="hidden" name="hidden_id" value="<?php echo $value_new['productId'] ?>">
														<input type="hidden" name="hidden_name" value="<?php echo $value_new['productName'] ?>" />
														<input type="hidden" name="hidden_quantity" value="1" />
														<input type="hidden" name="hidden_price" value="<?php echo $value_new['price'] ?>" />
														<input type="submit" name="addtocart" value="Add to cart" class="button btn" />
													</fieldset>
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php 
									}
								 ?>
									
							</div>
						</div>
						<!-- //second section -->
					</div>
				</div>
				<!-- //product left -->

				<!-- product right -->
				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						 
						<!-- price -->
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Price</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="price_search.php?from=1000000&to=3000000">1.000.000 VND - 3.000.000 VND</a>
									</li>
									<li class="my-1">
										<a href="price_search.php?from=3000000&to=5000000">3.000.000 VND - 5.000.000 VND</a>
									</li>
									<li class="my-1">
										<a href="price_search.php?from=5000000&to=7000000">5.000.000 VND - 7.000.000 VND</a>
									</li>
									<li>
										<a href="price_search.php?from=7000000&to=9000000">7.000.000 VND - 9.000.000 VND</a>
									</li>
									<li class="my-1">
										<a href="price_search.php?from=10000000">More 10.000.000 VND</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- //price -->
						<!-- discounts -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Discount</h3>
							<ul>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">5% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">10% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">20% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">30% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">50% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">60% or More</span>
								</li>
							</ul>
						</div>
						<!-- //discounts -->
						<!-- reviews -->
						<div class="customer-rev border-bottom left-side py-2">
							<h3 class="agileits-sear-head mb-3">Customer Review</h3>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>5.0</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>4.0</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half"></i>
										<span>3.5</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>3.0</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half"></i>
										<span>2.5</span>
									</a>
								</li>
							</ul>
						</div>
						<!-- //reviews -->
						
						<!-- best seller -->
						<div class="f-grid py-2">
							<h3 class="agileits-sear-head mb-3">Best Seller</h3>
							<div class="box-scroll">
								<div class="scroll">
									<?php 
									$get_pro_best = mysqli_query($mysqli,"SELECT * FROM tbl_product WHERE status = 1");
									foreach ($get_pro_best as $key => $value_probest) {
										# code...
									
								 ?>
									<div class="row my-4">
										<div class="col-lg-3 col-sm-2 col-3 left-mar">
											<img src="uploads/<?php echo $value_probest['image'] ?>" alt="" class="img-fluid">
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href="details.php?<?php echo $value_probest['productId'] ?>"><?php echo $value_probest['productName'] ?></a>
											<a href="details.php?<?php echo $value_probest['productId'] ?>" class="price-mar mt-2"><?php echo number_format($value_probest['price']).' VND' ?></a>
										</div>
									</div>
								<?php 
									}
								 ?>
								</div>
							</div>
						</div>
						<!-- //best seller -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->
<?php 
	include 'include/footer.php';
 ?>

