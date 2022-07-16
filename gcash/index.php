<?php
	//import another php file
	require 'mysqlconnection.php';

	//log in feature (not the safe way)
	session_start();
	if(!isset($_SESSION['loggedin'])){
		$_SESSION['loggedin'] = "";
		//if the session variable is not set (not logged in yet), header() redirects you to another page
		header("Location: login.php");
	}else{
		if($_SESSION['loggedin'] != $loginpassword){
			//redirect to login.php page
			header("Location: login.php");
		}else{
			//logged in, can now continue to access the page
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Gcash Tracker</title>
    
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="icons/c.png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div>
		<h1 class="gcashish">Insert a record</h1>

		<a href="logout.php">logout</a>

		<form action="index.php" method="post">
			<input type="date" name="hiddendate" style="display: none;">
			<input type="date" name="date">
			<input type="number" onkeyup="mult(this.value)" onchange="mult(this.value)" id="amount" placeholder="Amount" name="amount">
			<input type="hidden" id="fee" name="fee">
			<input type="number" placeholder="Fee" disabled id="kofee">
			<select name="ttype">
				<option value="" selected></option>
				<option value="Cash-in">Cash in</option>
				<option value="Cash-out">Cash out</option>
			</select>
			<input type="submit" class="s" name="add" value="Insert record">
			<a href="index.php"> Clear data</a>
		</form>





<?php
		//if the 'add' button is clicked, process the data
		if(isset($_POST['add']) && isset($_POST['amount']) && isset($_POST['date']) && $_POST['ttype']!=""){
			
			//get values from input fields
			$date = $_POST['date'];
			$hiddendate = $_POST['hiddendate'];
			//para mavalidate kung nag input ba ng date o hindi
			//gumawa ng dalawang date input, pero yung isa ginawang hidden gamit ang css para di makita
			//so if parehas sila ng value, then most likely hindi pa naga input ang user ng date
			if($date == $hiddendate){
				echo "<p class='pastelred'>Please set date</p>";
			}else{
				//get values from input fields
				$amount = $_POST['amount'];
				$fee = (int)($_POST['fee']);
				$transactiontype = $_POST['ttype'];
				$date = date('Y-m-d', strtotime($date));

				$sql = "INSERT INTO records (issuedate, amount, fee, transactiontype) VALUES('$date', $amount, $fee, '$transactiontype')";
				if ($conn->query($sql) === TRUE) {
				  echo "<p class='green'>New record created</p>";
				} else {
				  echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
			

		}else{
			echo "<p class='pastelred'>Please fill in all fields</p>";
		}
	?>
	</div>
<div class="newrow">








<?php
	//displaying data into table
	$sql = "SELECT * from records ORDER BY id DESC LIMIT 10";
	$result = $conn->query($sql);

	echo "<table>
			<tr>
				<td class='header'>ID</td>
				<td class='header'>Date</td>
				<td class='header'>Amount</td>
				<td class='header'>Fee</td>
				<td class='header'>Transaction Type</td>
			</tr>


	";
	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	    $id = $row['id'];
	    $amt = $row['amount'];
	    $fee = $row['fee'];
	    $date = $row['issuedate'];
	    $type = $row['transactiontype'];
	    echo "
	    	<tr>
		    	<td style='background: #eee'>$id</td>
		    	<td>$date</td>
		    	<td>".asPesos($amt)."</td>
		    	<td>".asPesos($fee)."</td>
		    	<td>$type</td>
		    </tr>";
	  }
	} else {
	  echo "0 results";
	}
	echo "</table>";


$sql = "SELECT SUM(amount) as total, SUM(fee) as revenue from records";
$result = $conn->query($sql);

//format money money
function asPesos($value) {
  if ($value < 0) return "-".asPesos(-$value);
  return '₱'.number_format($value, 2);
}

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
    $total = asPesos($row['total']);
    $revenue = asPesos($row['revenue']);
	
	echo "<h3><br>Total: $total <br>Revenue: $revenue</h3>";
}

$conn->close();
?>

</div>


<script type="text/javascript">
function mult(value){

	

    var val_2, val_1;
    val_1 = document.getElementById('amount').value;
    
        if (val_1 <= 500) {
            val_2 = 10;
        }
        else if (val_1 > 500 && val_1 <= 1000) {
            val_2 = 15; 
        }
        else if (val_1 > 1000 && val_1 <= 1500) {
            val_2 = 20;
        }
        else if(val_1 > 1500 && val_1 <= 2000) {
            val_2 = 30; 
        }
        else if (val_1 > 2000 && val_1 <= 2500) {
            val_2 = 40; 
        }
        else if (val_1 > 2500 && val_1 <= 3000) {
            val_2 = 45 
        }
        else if (val_1 > 3000 && val_1 <= 3500) {
            val_2 = 55;
        }
        else {
            val_2 = 60;
        }
    document.getElementById('fee').value = val_2;
    document.getElementById('kofee').value = val_2;
    
}
</script>
</body>
</html>