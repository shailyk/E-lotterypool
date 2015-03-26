<?php
	
	
	
	
	if(isset($_POST['action'])&&($_POST['action']=='get_total')){
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
			$stmt = $conn->prepare("select * from Pool_Value where ID='1'");	
			$stmt->execute(); 
			
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				
				$r_total = $row['Value'];
				
			}
			echo $r_total;
		}
		
		
		
		catch(PDOException $e){
			
			echo "Error: " . $e->getMessage();
		}
		$conn=null;
	}
	
	
?>