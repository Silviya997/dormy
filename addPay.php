<?php
    session_start();

    include_once('conn.php');
    include_once('header.php');
    include_once('sessionHeader.php');

	$studId= $_GET['Id'];
    $queryy = "SELECT * FROM user u INNER JOIN accdata a ON u.id=a.userId INNER JOIN payment p ON a.data_id=p.accdata_id WHERE id = :id AND a.toExtend = :exd";
    $dataa = [
    ':id' => $studId,
	':exd' => 'notExtended'
    ];
    $stt = $conn->prepare($queryy);
    $stt->execute($dataa);
    $row=$stt->fetch();
    $FAKnO = $row['fakNo'];
	$dataId= $row['data_id'];

	$query = "SELECT price FROM fee";
	$statement = $conn->prepare($query);
	$statement->execute();
	$taxFee = $statement->fetchColumn();

	if(isset($_POST['submit']) ) {
		$errors = [];
				$select = $_POST['monthSelect'];
				if($select == "select") {
					echo "You must select month!";
				} else {	
					if($select == 'January') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->January == 0) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `January`=:mesec, `date1`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for January has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'February') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->February == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `February`=:mesec, `date2`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for February has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'March') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->March == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `March`=:mesec, `date3`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for March has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'April') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->April == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `April`=:mesec, `date4`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for April has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'May') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->May == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `May`=:mesec, `date5`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for May has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'June') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->June == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `June`=:mesec, `date6`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for June has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'July') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->July == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `July`=:mesec, `date7`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for July has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'August') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->August == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `August`=:mesec, `date8`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for August has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'September') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->September == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `September`=:mesec, `date9`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for September has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'October') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->October == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `October`=:mesec, `date10`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for October has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'November') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->November == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `November`=:mesec, `date11`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							echo "<p>Successfully added payment!</p>";	
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						} else {
							echo "<p>Payment for November has already been made</p>";
							echo "<p><a href='paySearch.php'>Search payment</a></p>";
						}
					}
					if($select == 'December') {
						$querycheck ="SELECT * FROM payment WHERE student_id=$studId AND paid=1";
						$stmCheck = $conn->prepare($querycheck);
						$stmCheck->execute();
						$row = $stmCheck->fetch(PDO::FETCH_OBJ);
						if($row->December == 0 ) {
							$fee = $taxFee;
							$add_fee = $_POST['add_fee'];
							$sum = $fee + $add_fee;
							$date = date('Y-m-d');

							$payUpdate = "UPDATE `payment` SET `December`=:mesec, `date12`=:den WHERE student_id = $studId AND paid=1";
							$dataUp = [
								':mesec' => $sum,
								':den' => $date
							];
							$paySt = $conn->prepare($payUpdate);
							$paySt->execute($dataUp);
							if($paySt) {							
								echo "<p>Successfully added payment!</p>";	
								echo "<p><a href='paySearch.php'>Search payment</a></p>";
							} else {
								echo "<p>Payment for December has already been made</p>";
								echo "<p><a href='paySearch.php'>Search payment</a></p>";
							}
						}
					}
					$query = "SELECT * FROM payment p INNER JOIN accdata a ON p.accdata_id=a.data_id WHERE accdata_id=$dataId";
					$stm=$conn->prepare($query);
					$stm->execute();
					$r=$stm->fetch();
					if($r == true) {
						$jan = $r['January'];
						$feb = $r['February'];
						$march = $r['March'];
						$april = $r['April'];
						$may = $r['May'];
						$june = $r['June'];
						$july = $r['July'];
						$aug = $r['August'];
						$sep = $r['September'];
						$oct = $r['October'];
						$nov = $r['November'];
						$dec = $r['December'];
						$Left= $r['is_left'];
						$paidd = $r['paid'];
						$date = date('Y-m-d');
						if ($jan != '0' && $feb != '0' && $march != '0' && $april != '0' && $may != '0' && $june != '0' && $july != '0' && 
						$aug != '0' && $sep != '0' && $oct != '0' && $nov != '0' && $dec != '0' && $paidd== '1') {
						
						$q ="UPDATE `payment` SET `paid`= 0 WHERE student_id = $ID AND accdata_id = $dataId ";
						
						$s = $conn->prepare($q);
						$s->execute();

					}
				}
			}
		}


?>
<form method="POST" action="addPay.php?Id=<?php echo $row['id'];?>">
	<section class="homesection">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
				<?php
					if(!empty($errors)) {
						include_once('errors.php');
					}
				?>
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon3" style="margin-top:10px">Enter students Faculty No</span>
					<input type="text" name="fakNo" value=<?php echo $row['fakNo']; ?> class="form-control" id="basic-url" aria-describedby="basic-addon3" disabled >
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
						<input type="text" name="fee" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?php echo $taxFee; ?>" style="background-color:white" disabled>
					<span class="input-group-text" style="background-color:lightblue;margin-top:10px" >+</span>

						<input type="text" name="add_fee" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" value="0.00">
						<span class="input-group-text" style="margin-top:10px">BGN</span>
						<span class="input-group-text" style="margin-top:10px;background-color:lightpink">Additional fee</span>
					</div>
                </div>
				<div class="row g-3" id="row_center">
				<div class="col-auto">
                    <button type="submit" class="btn btn-primary" name="submit" value= "submit" >Submit</button>     
                </div>
					<center><a href="paySearch.php?action=pay_search" style="color:#fd0d66;">Click here to search for payments</a>	</center>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</section>
</form> 