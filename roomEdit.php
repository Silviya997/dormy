<?php

session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user'] != 2){
        header('Location:index.php');
    }
    require_once('conn.php');
    include_once('header.php');
    include_once('sessionHeader.php');

    $editId=$_GET['editRoomId'];
    $query = "SELECT * FROM `rooms`  WHERE `id` = $editId";
	$room = $conn->query($query);
	$row = $room->fetch(PDO::FETCH_OBJ);
		$roomNo = $row->roomNo;
        $status = $row->stateOfroom;
		// $status = $row->stateOfroom;
		if (isset($_POST['update'])) {
            $errors = [];
			$state = $_POST['stateOfroom'];
            if($state == "select") {
                echo "You must select month!";
            } else {
				$query2 = "UPDATE `rooms` SET  `stateOfroom` =:st WHERE id = $editId" ;
				$stm = $conn->prepare($query2);
                $data = [
                    ':st' => $state
                ];
                $stm->execute($data);
                if($stm) {
                    echo "bravo";
		?>
					<meta http-equiv="refresh" content="0;url='admin.php?action=rooms'"/>
		<?php
                }
            }
    }
?>
    <form action="roomEdit.php?editRoomId=<?php echo $editId;?>" method="POST">
        <section class="editRoom">
            <div class="container">
                <h2 class="title">Edit room</h2>
                <div class="row">
                    <input type="text" name="nomer" class="form-control" style="margin-bottom:10px; background-color:white" value="<?php echo $roomNo; ?>" disabled>
                    <select name="stateOfroom" class="form-select"  aria-label="Default select example">
                        <option value="select" >Select</option>
                        <option value="free">Free</option>
                        <option value="occupied">Occupied</option>
                        <option value="outOforder">Out of order</option>
                    </select>
                    <button type="submit" class="btn btn-primary" name="update" value= "submit" style="margin-top:15px">Submit</button>     
                </div>
            </div>
        </select>
    </form>
