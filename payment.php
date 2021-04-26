<?php
    session_start();

    include_once('conn.php');
    include_once('header.php');
    include_once('sessionHeader.php');

	if(isset($_POST['pay'])) {
		$errors = [];
		if(!empty($_POST['fakNo'])) {
			$query1 = "SELECT * FROM user u RIGHT JOIN accdata a ON u.id=a.userId  WHERE `fakNo`=:FakNo";
			$data = [
			':FakNo' => $_POST['fakNo']
			];
			$statement1 = $conn->prepare($query1);
			$statement1->execute($data);
			$result1 = $statement1->fetch();
			if ($statement1->rowCount() == 1) {
				$ID = $result1['id'];
				$select = $_POST['monthSelect'];
				if($select == "select") {
					echo "You must select month!";
				} else {	
					if($select == 'January') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->January == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `January`=:mesec, `date1`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for January has already been made";
						}
					}
					if($select == 'February') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->February == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `February`=:mesec, `date2`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for February has already been made";
						}
					}
					if($select == 'March') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->March == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `March`=:mesec, `date3`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for March has already been made";
						}
					}
					if($select == 'April') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->April == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `April`=:mesec, `date4`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for April has already been made";
						}
					}
					if($select == 'May') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->May == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `May`=:mesec, `date5`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for May has already been made";
						}
					}
					if($select == 'June') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->June == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `June`=:mesec, `date6`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for June has already been made";
						}
					}
					if($select == 'July') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->July == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `July`=:mesec, `date7`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for July has already been made";
						}
					}
					if($select == 'August') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->August == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `August`=:mesec, `date8`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for August has already been made";
						}
					}
					if($select == 'September') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->September == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `September`=:mesec, `date9`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for September has already been made";
						}
					}
					if($select == 'October') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->October == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `October`=:mesec, `date10`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for October has already been made";
						}
					}
					if($select == 'November') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->November == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `November`=:mesec, `date11`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "Successfully added payment!";	
						} else {
							echo "Payment for November has already been made";
						}
					}
					if($select == 'December') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$ID";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->December == 0000-00-00 ) {
							$fee = 80;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `December`=:mesec, `date12`=:den WHERE student_id = $ID";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							if($paySt) {							
								echo "Successfully added payment!";	
							}
						} else {
							echo "Payment for December has already been made";
						}
					}	
				}
			} else {
				echo "No room has been assigned to this faculty number.";
			}
		} else {
			echo "Faculty No is required!";
		}
	}	

?>
<form action="payment.php?action=stud_payment" method="POST">
	<section class="homesection">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon3" style="margin-top:10px">Enter students Faculty No</span>
					<input type="text" name="fakNo" class="form-control" id="basic-url" aria-describedby="basic-addon3">
				</div>
				<div class="form-floating">
					<select name="monthSelect" class="form-select" id="floatingSelect" aria-label="Floating label select example">
						<option value="select">Select</option>
						<option name="January" value="January">January</option>
						<option name="February" value="February">February</option>
						<option name="March"  value="March">March</option>
						<option name="April" value="April">April</option>
						<option name="May" value="May">May</option>
						<option name="June" value="June">June</option>
						<option name="July" value="July">July</option>
						<option name="August" value="August">August</option>
						<option name="September" value="September">September</option>
						<option name="October" value="October">October</option>
						<option name="November" value="November">November</option>
						<option name="December" value="December">December</option>
					</select>
					<label for="floatingSelect">Select month</label>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" style="margin-top:10px">BGN</span>
						<input type="text" name="fee" class="form-control" aria-label="Amount (to the nearest dollar)" value="80.00" style="background-color:white" disabled>
					<span class="input-group-text" style="background-color:lightblue;margin-top:10px" >+</span>

						<input type="text" name="add_fee" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" value="0.00">
						<span class="input-group-text" style="margin-top:10px">BGN</span>
						<span class="input-group-text" style="margin-top:10px;background-color:lightpink">Additional fee</span>
					</div>
                </div>
				<div class="row g-3" id="row_center">
				<div class="col-auto">
                    <button type="submit" class="btn btn-primary" name="pay" value= "submit" >Submit</button>     
                </div>
					<center><a href="paySearch.php?action=pay_search" style="color:#fd0d66;">Click here to search for payments</a>	</center>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</section>
</form>    
