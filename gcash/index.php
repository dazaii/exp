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
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$databasename = "gcash";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $databasename);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
?>
	<div>
		<h1 class="gcashish">Insert a record</h1>
		<form action="index.php" method="post">
			<input type="date" name="date">
			<input type="text" onkeyup="mult(this.value)" id="amount" placeholder="Amount" name="amount">
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
		if(isset($_POST['add']) && isset($_POST['amount']) && isset($_POST['date']) && isset($_POST['ttype'])){
			
			//get values from input fields
			$date = $_POST['date'];
			$amount = $_POST['amount'];
			$fee = (int)($_POST['fee']);
			$transactiontype = $_POST['ttype'];
			$date = date('Y-m-d', strtotime($date));

			$sql = "INSERT INTO records (issuedate, amount, fee, transactiontype) VALUES('$date', $amount, $fee, '$transactiontype')";
			if ($conn->query($sql) === TRUE) {
			  echo "<p class='green'>New record created successfully</p>";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}
			

		}else{
			echo "<p class='pastelred'>Please fill in all fields</p>";
		}
	?>
	</div>
<div class="newrow">

<?php
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
	    echo "<tr>
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