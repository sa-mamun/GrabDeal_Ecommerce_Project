<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	//include_once '../lib/Database.php';
	//include_once '../helpers/Format.php';
?>
<?php
class Cart {	
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function addToCart($quantity, $id){
		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$productId = mysqli_real_escape_string($this->db->link, $id);
		$sId	   = session_id();

		$squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
		$result = $this->db->select($squery)->fetch_assoc();

		$productName = $result['productName'];
		$price 		 = $result['price'];
		$image 		 = $result['image'];

		$chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
		$getPro = $this->db->select($chquery);
		if ($getPro) {
			$msg = "Product Already Added !!";
			return $msg;
		}else{
			$query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$image')";
	    	$inserted_row = $this->db->insert($query);
			if ($inserted_row) {
				header("Location:cart.php");
			}
			else{
				header("Location:404.php");
			}
		}
	}

	public function getCartProduct(){
		$sId	   = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function updateCartQuantity($cartId, $quantity){
		$cartId   = $this->fm->validation($cartId);
		$quantity = $this->fm->validation($quantity);
		$cartId   = mysqli_real_escape_string($this->db->link, $cartId);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$query = "UPDATE tbl_cart
				  SET
				  quantity = '$quantity'
				  WHERE cartId = '$cartId'";
		$updated_row = $this->db->update($query);
		if ($updated_row) {
			header("Location:cart.php");
		}else{
			$msg = "<span class='error'>Quantity Not Updated Successfully !!</span>";
			return $msg;
		}
	}

	public function delProductByCart($delId){
		$delId   = mysqli_real_escape_string($this->db->link, $delId);
		$query = "DELETE FROM tbl_cart WHERE cartId = '$delId'";
		$deldata = $this->db->delete($query);
		if ($deldata) {
			echo "<script>window.location = 'cart.php';</script>";
		}else{
			$msg = "<span class='error'>Product Not Deleted!!</span>";
			return $msg;
		}
	}

	public function checkCartTable(){
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function delCustomerCart(){
		$sId = session_id();
		$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
		$this->db->delete($query);
	}
}
?>