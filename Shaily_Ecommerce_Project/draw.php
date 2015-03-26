<?php 
	
	$servername = "mysql.bazow.info";
	$username = "shailyk";
	$password = "Kamble12";
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=payfirma_db", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully";
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
	
	$tickets = array();
	
	
	try{
		$stmt = $conn->prepare("SELECT * FROM Transactions");
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		     
			 $spaces = $row['Quantity'];
			 $email = $row['Email'];
			 
			 for($i=1;$i<=$spaces;$i++){
				 array_push($tickets,$email);
				 
				 }
			
		}
		
		//Delete all entries so that they do not participate in the next draw
		$stmt = $conn->prepare("DELETE FROM Transactions");
		$stmt->execute();
		
		//Reset pool to 0 (if thise were a real system, we would archive the winner and the pool amount)
		
		$stmt = $conn->prepare("INSERT INTO `payfirma_db`.`Pool_Value` (
			`ID` ,
			`Value`
			)
			VALUES (
			'1', '0'
			);");
			
		$stmt->execute();
		
		shuffle($tickets);
		$random_key = array_rand($tickets);
		echo "randomkey".$random_key;
		$winner_email = $tickets[$random_key];
		echo "Winner is".$winner_email;
		
		$msg = 'Congratulations, You are the winner!
		A cheque for the winning amount will be sent to your mailing address in 2-5 business days';
		
		mail($winner_email,"E-Lottery Pool Winner Announcement",$msg,"from:E-Lottery@bazow.info");
		
		echo "HELLO TEST";
	$myfile = fopen("testfile.txt", "w"); 
	fwrite($myfile, 'Winner is'.$winner_email);
	fclose($myfile);
	}
	catch(PDOException $e){
		
		echo "Error: " . $e->getMessage();
	}
	$conn=null;
	
	?>