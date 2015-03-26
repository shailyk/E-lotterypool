<?php 
	//perform the sale
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://ecom.payfirma.com/sale');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, true);
	
	$data = array(
	'merchant_id'=>'784fbc372d',
	'key'=>'557bb384359231adcddd3edf25db395cba04ce56',
	'amount'=>$_REQUEST['amount'],
	'token'=>$_REQUEST['token'],
	'first_name'=>$_REQUEST['firstname'],
	'last_name'=>$_REQUEST['lastname'],
	'test_mode'=> true
	);
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$output = curl_exec($ch);
	curl_close($ch);
	
	//echo $output;
	$obj = json_decode($output);
	echo $obj->{'result'};
	
	if($obj->{'result'}=='approved'){
		$email = $_REQUEST['email'];
		$msg = 'Thank you for your purchase.
		Amount : $'.$_REQUEST['amount'].'';
		
		mail($email,"E-Lottery Pool Receipt",$msg,"from:E-Lottery@bazow.info");
		
		
		
	
	
	
	//STORE INFO IN CUSTOMER VAULT.
	/* 	$token = $_REQUEST['token'];
		
		
		//$url = 'https://ecom.payfirma.com/vault/'.$_REQUEST['email'].'?merchant_id=784fbc372d&key=557bb384359231adcddd3edf25db395cba04ce56';
		$url = 'https://ecom.payfirma.com/vault/'.$_REQUEST['email'];
		
		//echo $url;
		
		$post_fields = array(
		'key' => '557bb384359231adcddd3edf25db395cba04ce56',
		'merchant_id' => '784fbc372d',
		'token' => $token, // contains card info
		'first_name' => $_REQUEST['firstname'],
		'last_name' => $_REQUEST['lastname'],
		'test_mode' => true
		);
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch); */
	
	//echo $result;
	
	
	// Retrieve customer info from credit card vault
	/* 	$url = 'https://ecom.payfirma.com/vault/'.$_REQUEST['email'];
		
		$post_fields = array(
		'key' => '557bb384359231adcddd3edf25db395cba04ce56',
		'merchant_id' => '784fbc372d',
		'method' => 'GET',// override POST method
		'test_mode'=> true
		);
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		
		$amount = $_REQUEST['amount'];
		$total_amount = $total_amount+$amount;
		
	*/
	
	//store info into a database
	$servername = "mysql.bazow.info";
	$username = "shailyk";
	$password = "Kamble12";
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=payfirma_db", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully";
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
	
	try{
		$stmt = $conn->prepare("INSERT INTO Transactions (Firstname, Lastname, Email,Quantity) VALUES (:firstname, 'Smith', :email, :quantity)");
		$stmt->bindParam(':firstname', $firstname);
		//	$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':quantity', $quantity);
		
		$firstname = $_REQUEST['firstname'];
		//$lastname = $REQUEST['lastname'];
		$email = $_REQUEST['email'];
		$quantity = $_REQUEST['quantity'];
		
		
		
		$stmt->execute(); 
	}
	
	catch(PDOException $e){
		
		echo "Error: " . $e->getMessage();
	}
	
	//ONLY ADD TICKET INTO POOL IF PAYMENT APPROVED
	
	try{
		$amount = $_REQUEST['amount'];
		
		$stmt1 = $conn->prepare("select * from Pool_Value where ID='1'");
		$stmt1->execute(); 
		
		while ($row_total = $stmt1->fetch(PDO::FETCH_ASSOC)) {
			
			$total = $row_total['Value'];
			
		}
		$new_total = $total+$amount;
		
		$stmt2 = $conn->prepare("update Pool_Value set Value =:new_total where ID='1'");
		$stmt2->bindParam(':new_total', $new_total);
		$stmt2->execute();
	}
	catch(PDOException $e){
		
		echo "Error: " . $e->getMessage();
	}
	
	$conn=null;
	}
?>