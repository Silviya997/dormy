<?php
session_start();

require_once('conn.php');
include_once('header.php');
include_once('sessionHeader.php');


?>
<form action="search.php?action=searchStudent" method="POST" >
	<section class="search_sec">
		<div class="container">
			<div class="row">
					<h3 class="title">Search for student </h3> 
					<div class="row g-3" id="row_center">
					<div class="col-auto">

					<label>
						<select name="column" class="form-select" style="border-radius: 1rem; margin-top: .5rem" >
							<option value="select">Select</option>
							<option value="fakNo" >By student Id</option>
							<option value="RoomNo">By room No</option>
							<option value="egn">By PINs</option>
							<option value="university">By University</option>
							<option value="course">By Course</option>
							<option value="semester">By Semester</option>
						</select>
					</label>
					</div>
					<div class="col-auto">
					<label>
						<input class="form-control" name="key_word" type="text" size=30/>
					</label>
					</div>
					<div class="col-auto">

					<label>
						<input class="form-control" type="submit" name="search" value="Search" style="color:blue"/>
					</label>
					<div>
					</div>
			</div>
		</div>
	</section>

</form>
		
<section class="res_section">
<div class="container">
<?php
	if(isset($_POST['search'])) {
		$column = $_POST['column'];
		if($column == "select") {
			echo "You must select type of search!";
		} else {
			$key_word = $_POST['key_word'];
			$searchquery = "SELECT * FROM user u INNER JOIN accdata a ON u.id=a.userId INNER JOIN payment p ON a.userId=p.student_id  
			WHERE ".$column." LIKE :search_word";
			$serachstm = $conn->prepare($searchquery);
			$searchdata = [
			':search_word' => '%'.$key_word.'%'
			];
			$serachstm->execute($searchdata);
			if ($serachstm->rowCount() > 0) {
?>
					<h2 class="title">Results</h2>
					<div class="klas">
					<div class="square1"></div>
					<small>In dorm and has NO debts</small> 
					<div class="square2"></div>
					<small>Expired period of stay and has NO debts</small> 
					<div class="square3"></div>
					<small>Expired period of stay and HAS debts</small>
					</div>
					<div class="table-responsive-sm">
					<table class="table">
					<thead class="table-light">
						<tr>
						<th scope="col">First name</th>
                        <th scope="col">Middle name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">PINs</th>
                        <th scope="col">Fak No</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">University</th>
                        <th scope="col">Course</th>
                        <th scope="col">Semester</th>
						<th scope="col">Accommodated</th>
                        <th scope="col">Left</th>
                        <th scope="col">Room No</th>
						<th scope="col">Payment</th>
						</tr>
						</thead>
						<tbody>
						<?php
       					while ($row = $serachstm->fetch()) {

								$id=$row['id']; 
								$paid = $row['paid'];
								$acc = date('Y-m-d');
								if($row['is_left'] <= $acc && $paid == '1') {
									$tdStyle='background-color:red;';

								} elseif($row['is_left'] <= $acc && $paid == '0') {
									$tdStyle='background-color:lightblue;';

								} else {
									$tdStyle='background-color:lightgreen;';
								}
                        ?>
							<tr>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['f_name'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['m_name'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['l_name'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['egn'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['fakNo'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['phone'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['email'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['university'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['course'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['semester'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['accommodated'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['is_left'];?></td>
							<td style=<?php echo $tdStyle; ?>> <?php echo $row['RoomNo'];?></td>
							<?php
							if($row['is_left'] <= $acc && $paid == '1') {
								?>
							<td style=<?php echo $tdStyle; ?>>Debts</td>

								<?php

							} elseif($row['is_left'] <= $acc && $paid == '0') {
								?>
								<td style=<?php echo $tdStyle; ?>>All paid</td>
	
									<?php
							} else {
								?>
								<td style=<?php echo $tdStyle; ?>>OK</td>
								<?php
								}
							if(isset($_SESSION['user']) && $_SESSION['user'] == 2) { ?>
							<td><button type="button" name="edit" onclick="location.href='editUser.php?editId=<?php echo $row['id'];?>'">Edit</button> </td>
							<?php } ?>
						</tr>
						<?php
                    }
					?>
					</tbody>
					</table>
					<?php
                   
                } 
			
			}
	}
	?>
</div>

</div>
</section>

<?php
	include_once('footer.php');
?>






























