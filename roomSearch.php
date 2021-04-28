<?php
  session_start();
  require_once('conn.php');
  include_once('header.php');
  include_once('sessionHeader.php');

    $acc= date('Y-m-d');
    $left = date('Y-m-d', strtotime("+6 months", strtotime($acc)));
    $errors = [];

?>
<form action="roomSearch.php?action=search" method="POST">
    <section class="Searchroom">
        <?php
        if(!empty($errors)) {
            include_once('errors.php');
        }
        ?>

        <div class="container">
        <h3 class="title">Search for a room</h3>

            <div class="row g-3" id="row_center">
                <div class="col-auto">
                    From:<input type="date"  class="form-control" name="acc" >
                </div>
                <div class="col-auto">
                    To:<input type="date"  class="form-control" name="left" >
                </div>
                <div class="col-auto">
                    <input type="submit" class="btn btn-primary " name="check" value="SEARCH" style="margin-top: 3rem;">
                </div>
            </div>
        </div>
    </section>
</form>

<section class="res_section">
<div class="container">
<?php

	if(isset($_POST['check'])) {
		$post_acc = $_POST['acc'];
        $post_left = $_POST['left'];

        if (empty($_POST['acc'])) {
			array_push($errors, 'Choose FROM date!');
		} 
		if (empty($_POST['left'])) {
			array_push($errors, 'Choose TO date!');
		}

        if (empty($errors)) {
            if ($_POST['left'] < $_POST['acc']) {
              array_push($errors, 'Invalid checkout date');
            } else {
                $queryCheck = "SELECT * FROM rooms r LEFT JOIN accdata a ON a.room_id=r.id 
                AND (accommodated <= :ACC AND is_left >= :IS_LEFT OR accommodated >= :ACC AND accommodated < :IS_LEFT OR is_left > :ACC AND is_left < :IS_LEFT) 
                WHERE a.room_id IS NULL";
                $d = [
                ':ACC' => $_POST['acc'],
                ':IS_LEFT' => $_POST['left'],
                ];
                $stmt = $conn->prepare($queryCheck);
                $stmt->execute($d);
                while ($row = $stmt->fetch()) {
                    ?>
                    <div class="table-responsive-sm">
                    <table class="table">
                        <thead class="table-light">
                        <th scope="col">Room</th>
                        <th scope="col">Status</th>
						</tr>
						</thead>
						<tbody>
                        <tr>
							<td> <?php echo $row['roomNo'];?></td>
							<td> <?php echo $row['stateOfroom'];?></td>
                            <?php
                            if(isset($_SESSION['user']) && $_SESSION['user'] == 1) { ?>
                            <td><button type="button" name="add" onclick="location.href='data.php?action=addData'">Edit</button> </td>
                            <?php
                            }
                            ?>
                        </thead>
                    </table>
                    </div>


                    <?php
                }
            }
        }     
    }

?>




