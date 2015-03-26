
<html>
	<head>
		<title>Buy Tickets</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<div id="title_div" onclick="location.href='index.php';">
			<p id="title">E-Lottery Pool</p>
			
		</div>
		<div id="option_bar">
			<ul>
				<div id="home_tab" onclick="location.href='index.php';"><li class="bar">Home</li></div>	
				<div id="about_tab" onclick="location.href='about.php';"><li class="bar">How It Works</li></div>	
				<div id="buy_tab" onclick="location.href='buy.php';"><li class="bar">Buy Tickets</li></div>	
				<div id="contact_tab"><li class="bar">Contact Us</li></div>	
			</ul>
		</div>
		
	</head>
	<body>
	    <div id="approved" style="display:none;"><p><img src="green_checkmark.jpg" width="20" height="20"/> Your Payment has been approved. An email receipt will be sent to you shortly. Good Luck!</p></div>
		<div id="denied" style="display:none;"><p><img src="cancel.png" width="20" height="20"/>Sorry, your payment has been declined. Please try another card</p></div>
		<div id="purchase_form">
			<br>
			Last Name:<input id="lastname" type="text"></input><br>
			<br>
			First Name:<input id="firstname" type="text"></input><br>
			<br>
			E-mail:<input id="email" type="text"></input>
			<br>
			<br>
			Quantity:
			<input id="quantity" type="number" name="quantity" min="1" max="100"> A ticket is $5
			<br>
			<br>
			Credit Card number:<input id="cc_num" type="text"></input><br>
			<br>
			Credit Card Expiry Month:
			<select name='expireMM' id='expireMM'>
				<option value=''>Month</option>
				<option value='01'>January</option>
				<option value='02'>February</option>
				<option value='03'>March</option>
				<option value='04'>April</option>
				<option value='05'>May</option>
				<option value='06'>June</option>
				<option value='07'>July</option>
				<option value='08'>August</option>
				<option value='09'>September</option>
				<option value='10'>October</option>
				<option value='11'>November</option>
				<option value='12'>December</option>
			</select><br>
			<br>
			Credit Card Expiry Year:
			<select name='expireYY' id='expireYY'>
				<option value=''>Year</option>
				<option value='15'>2015</option>
				<option value='16'>2016</option>
				<option value='17'>2017</option>
				<option value='18'>2018</option>
				<option value='19'>2019</option>
				<option value='20'>2020</option>
				<option value='21'>2021</option>
				<option value='22'>2022</option>
				<option value='23'>2023</option>
				<option value='24'>2024</option>
				<option value='25'>2025</option>
				<option value='26'>2026</option>
				<option value='27'>2027</option>
				<option value='28'>2028</option>
				<option value='29'>2029</option>
				<option value='30'>2030</option>
				<option value='25'>2031</option>
				<option value='26'>2032</option>
				<option value='27'>2033</option>
				<option value='28'>2034</option>
				<option value='29'>2035</option>
				<option value='30'>2036</option>
			</select><br>
			<br>
			CVV number:<input id="cvv2" type="text"></input><br>
			<br>
			<button type="button" onclick="process()">Submit</button>
		</div>
		<p id="count"><p>
			
			
		</body>	
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
			
			function callback(response) {
				console.log("response: " + response + "\n");
				if(response=='approved'){
					//if(!$("#denied").css('display')=='none'){
						$("#denied").hide();
						
					//}
					$("#approved").show();
				}
				else{
					//if(!$("#approved").css('display')=='none'){
						$("#approved").hide();
						console.log("hid approved");
					//}
					$("#denied").show();
				}
				
				
			};
			function process(){
				
				var key='2d2d2d2d2d424547494e205055424c4943204b45592d2d2d2d2d4d494942496a414e42676b71686b6947397730424151454641414f43415138414d49494243674b4341514541376b4979756d62554445545847526d51663030796476327a644363514b4c3144516f636d4355466953753743764f506b6e70533033677076794c58526d506666574a4c79664734635549464d68384330356468614a566d49515a443068464d75574b2f2f326b2b43526b2b504b74777130744446613044356c5373764a5533684b6150743367476758516242784e35685759444c6341452f6a44313945636c4b74747a53426e4476797939563577414c4f41343751676f76384d6d587672734d364e7a315a4a4a2f6f652f65307572474e51514e3738744d6c68535831632b5a3269543470796b7343775a576a46413255385438316e6f6b2f3565625037464e646b5376316e38536666616e31684341424872594d6f534a304636614e727051466970536854686d36775936457a62753648556b4c4c4237514941572b4657724e64696c4d3245496c6e66455671524732494b6d4f774944415141422d2d2d2d2d454e44205055424c4943204b45592d2d2d2d2d';
				var lastname=$("#lastname").val();
				var firstname=$("#firstname").val();
				var email=$("#email").val();
				var quantity = $("#quantity").val();
				var cc_num = $("#cc_num").val();
				var exp_month = $("#expireMM").val();
				var exp_year = $("#expireYY").val();
				var cvv2 = $("#cvv2").val();
				var amount = quantity * 5;
				if(confirm("Your total is $"+amount+". Do you want to continue?"))
				{
					var payfirma = new Payfirma(key,{
						'card_number': cc_num,
						'card_expiry_month': exp_month,
						'card_expiry_year':  exp_year,
						'cvv2':cvv2
						},{
						'lastname': lastname,
						'firstname': firstname,
						'email':  email,
						'quantity':quantity,
						'amount':amount
						
					},'test_sale.php',callback); 
				}
			}
			
		</script>
		<script src="http://www.payfirma.com/media/payfirma.minified.js"></script>
		</html>				