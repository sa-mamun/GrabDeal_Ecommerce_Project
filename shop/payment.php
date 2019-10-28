<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("customerlogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>
<style type="text/css">
.payment{width: 500px;min-height: 200px;text-align: center;border: 1px solid #ddd;margin: 0 auto;padding: 50px;}
.payment h2{border-bottom: 1px solid #ddd;margin-bottom: 40px;padding-bottom: 10px;}
.payment a{background: #4CAF50 none repeat scroll 0 0;border-radius: 3px;color: #fff;font-size: 25px;padding: 5px 30px;}
.back{width: 160px;margin: 5px auto 0;padding: 7px;text-align: center;display: block;background: #4CAF50;border: 1px solid #333;color: #ffff;border-radius: 3px;font-size: 25px;}
</style>
 <div class="main">
    <div class="content">
		<div class="section group">
			<div class="order">
				<div class="payment">
					<h2>Choose Payment Option</h2>
					<a href="paymentoffline.php">Offline Payment</a>
					<a href="paymentonline.php">Online Payment</a>
				</div>
				<div class="back">
					<a href="cart.php" style="color: white">Previous</a>
				</div>
			</div>
		</div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>
