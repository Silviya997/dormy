<?php
session_start();

require_once('conn.php');
include_once('header.php');
include_once('sessionHeader.php');
?>
<form action="paySearch.php?action=pay_search" method="POST" >
	<section class="search_sec">
		<div class="container">
			<div class="row">
					<h3 class="title">Search payment</h3> 
					<div class="row g-3" id="row_center">
					<div class="col-auto">

					<label>
						<select name="column" class="form-select" style="border-radius: 1rem; margin-top: .5rem" >
							<option value="select">Select</option>
							<option value="fakNo" >By student Id</option>
							<option value="RoomNo">Room No</option>
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
		
<!-- You need to select the fields from the interest table if you want to see them. Here I am selecting all the fields with interest.*.

SELECT user.FirstName, user.LastName, user.Profilepix, userinterest.UserId, userinterest.InterestId, interest.*
FROM user 
INNER JOIN userinterest ON user.UserId = userinterest.UserId 
INNER JOIN interest ON userinterest.InterestId = interest.InterestId -->
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
<div class="table-responsive-sm">
<table class="table">
	<thead class="table-light">
						<tr>
						<th scope="col">First name</th>
                        <th scope="col">Middle name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">PINs</th>
                        <th scope="col">Fak No</th>
                        <th scope="col">Room</th>
                        <th scope="col">January</th>
                        <th scope="col">February</th>
                        <th scope="col">March</th>
                        <th scope="col">April</th>
						<th scope="col">May</th>
                        <th scope="col">June</th>
                        <th scope="col">July</th>
                        <th scope="col">August</th>
                        <th scope="col">September</th>
                        <th scope="col">October</th>
                        <th scope="col">November</th>
                        <th scope="col">December</th>
						</tr>
						</thead>
						<tbody>
						<?php
       while ($row = $serachstm->fetch()) {

								$id=$row['id']; 
                        ?>
							<tr>
							<td> <?php echo $row['f_name'];?></td>
							<td> <?php echo $row['m_name'];?></td>
							<td> <?php echo $row['l_name'];?></td>
							<td> <?php echo $row['egn'];?></td>
							<td> <?php echo $row['fakNo'];?></td>
							<td> <?php echo $row['RoomNo'];?></td>
							<td> <?php echo $row['January'];?></td>
							<td > <?php echo $row['February'];?></td>
							<td> <?php echo $row['March'];?></td>
							<td> <?php echo $row['April'];?></td>
							<td > <?php echo $row['May'];?></td>
							<td> <?php echo $row['June'];?></td>
							<td> <?php echo $row['July'];?></td>
                            <td> <?php echo $row['August'];?></td>
							<td> <?php echo $row['September'];?></td>
							<td> <?php echo $row['October'];?></td>
							<td> <?php echo $row['November'];?></td>
							<td> <?php echo $row['December'];?></td>
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






























