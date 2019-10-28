<?php
 
?>

<?php include 'inc/header.php'; ?>
<div class="main">
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db_shop";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM tbl_product";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    echo '<div class="section group">';
	    while($row = $result->fetch_assoc()) {
	    	if($_POST["search"]==$row["productName"])
	    	{
	    		
				echo '<div class="grid_1_of_4 images_1_of_4">';
					 echo '<a href="preview-3.html"><img src="admin/'.$row["image"].'" alt="" /></a>';
					 echo '<h2>'.$row["productName"].'</h2>';
					 echo '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>';
					 echo '<p><span class="price">'.$row["price"].'</span></p>';
				     echo '<div class="button"><span><a href="/details.php?proid='.$row["productId"].'" class="details">Details</a></span></div>';
				echo '</div>';
	    	}
	    }
	    echo '</div>';
	} else {
	    echo "0 results";
	}
	$conn->close();
?>


<?php include 'inc/footer.php'; ?>