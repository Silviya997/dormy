<?php
session_start();

require_once('conn.php');
include_once('header.php');
include_once('sessionHeader.php');

$studentId=$_GET['studentId'];

$acc= date('Y-m-d');
$left = date('Y-m-d', strtotime("+12 months", strtotime($acc)));

$errors = [];

$editQuery = "SELECT * FROM user WHERE id=:id";
$editStm = $conn->prepare($editQuery);
$editData = [
':id' => $studentId
];
$editStm->execute($editData);
$row=$editStm->fetch();
// var_dump($row);exit;
$q="SELECT data_id FROM accdata  WHERE userId = $studentId AND toExtend = 'notExtended'";
                        $ss=$conn->prepare($q);
                        $ss->execute();
                        $r=$ss->fetch();
                        $data_id = $r['data_id'];
                        // var_dump($data_id);exit;

if (isset($_POST['add_room'])) {
    $errors = [];
    $roomNo = $_POST['roomNo'];

    if (empty($_POST['roomNo'])) {
        array_push($errors, 'Enter room number!');
    } else {
        $queryy = "SELECT * FROM rooms WHERE roomNo = :nomer";
        $dataa = [
        ':nomer' => $_POST['roomNo']
        ];
        $stt = $conn->prepare($queryy);
        $stt->execute($dataa);
        $rez=$stt->fetch();
        if($stt->rowCount() == 1) {
            $roomId = $rez['id'];
            $stateOfroom = $rez['stateOfroom'];
            if($stateOfroom != 'outOforder') {
                if($stateOfroom == 'free') {
                    $query = "INSERT INTO accdata (userId, accommodated, is_left, RoomNo, room_id) VALUES (:id, :acc, :isleft, :room, :roomId)";
                    $Data = [
                    ':id' => $studentId,
                    ':acc' => $acc,
                    ':isleft' => $left,
                    ':room' => $roomNo,
                    ':roomId' => $roomId
                    ];
                    $stmt = $conn->prepare($query);
                    $res = $stmt->execute($Data);
                    if ($res) {
                        
                        $query1 = "SELECT * FROM rooms WHERE roomNo = :nomer";
                        $danni = [
                        ':nomer' => $roomNo
                        ];
                        $st = $conn->prepare($query1);
                        $st->execute($danni);
                        $rezultat = $st->fetch();

                        if($rezultat) {
                          
                            $up = "UPDATE `accdata` SET `toExtend` = 'extended' WHERE userId = $studentId AND data_id = $data_id";
                            $stetm= $conn->prepare($up);
                            $stetm->execute();

                            $statusUpdate = "UPDATE `rooms` SET `stateOfroom` = 'occupied' WHERE roomNo=$roomNo";
                            $stUpdate = $conn->prepare($statusUpdate);
                            $stUpdate->execute();
                            echo "Successfully accommodated!";

                            $InsertInPayment = "INSERT INTO `payment` (student_id) VALUES (:STUDID)";
                            $InsertData = [
                            ':STUDID' => $studentId
                            ];
                            $stmInser = $conn->prepare($InsertInPayment);
                            $stmInser->execute($InsertData);
                        }
                    }
                } else {
                    array_push($errors, "This room is occupied");
                }
            } else {
                array_push($errors, "Room is out of order");
            }
        } else {
            array_push($errors, "Room with this number not exist");
        }
    }
}
  

?>

<form method="POST" action="extendStay.php?studentId=<?php echo $row['id'];?>">
    <section class="Addroom">
        <div class="container">
            <div class="row">
                <?php
                if (!empty($errors)) {
                    include_once ('errors.php');
                } 
                ?>
                <h3 class="title">Asign room</h3>
                <div class="row g-3" id="row_center">
                    <div class="col-auto">
                        <input type="text" name="fakNo" value=<?php echo $row['fakNo'];?> class="form-control" placeholder="Faculty No" disabled>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="roomNo" class="form-control" placeholder="Room No" id="limit" >
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary" name="add_room" value= "Add room" style="margin-top:15px" onclick="myFunction()">Add</button>     
                    </div>
                </div>
            </div>
        </div>    
    </section>
</form>

