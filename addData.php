<?php
session_start();

require_once('conn.php');
include_once('header.php');
include_once('sessionHeader.php');

$roomId = $_GET['roomId'];

$acc= date('Y-m-d');
$left = date('Y-m-d', strtotime("+12 months", strtotime($acc)));
$errors = [];

$queryy = "SELECT * FROM rooms WHERE id = :id";
$dataa = [
':id' => $roomId
];
$stt = $conn->prepare($queryy);
$stt->execute($dataa);
$row=$stt->fetch();


if (isset($_POST['submit'])) {
    $fakNo = $_POST['fakNo'];
   

    if (empty($_POST['fakNo'])) {
        array_push($errors, 'Enter faculty number!');
    } 

    if (!empty($_POST['fakNo'])) {
        $qAcount = "SELECT * FROM `user` WHERE `fakNo`=:FakNo";
        $data = [
        ':FakNo' => $_POST['fakNo']
        ];
        $statement = $conn->prepare($qAcount);
        $statement->execute($data);
        $result = $statement->fetch();
        if ($statement->rowCount() == 1) {
            $ID = $result['id'];
            $roomNo = $row['roomNo'];
            $check= "SELECT * FROM user u INNER JOIN accdata a ON u.id=a.userId WHERE u.id = :ID ";
            $d = [
            ':ID' => $ID
            ];
            $stm = $conn->prepare($check);
            $stm->execute($d);
            $r=$stm->fetchAll();

            if($stm->rowCount() > 0) {
                array_push($errors, 'This number has already been assigned a room'); 
            } else {
                $query = "INSERT INTO accdata (userId, accommodated, is_left, RoomNo, room_id) VALUES (:id, :acc, :isleft, :room, :roomId)";
                $Data = [
                ':id' => $ID,
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
                        $statusUpdate = "UPDATE `rooms` SET `stateOfroom` = 'occupied' WHERE roomNo=$roomNo";
                        $stUpdate = $conn->prepare($statusUpdate);
                        $stUpdate->execute();
                        echo "Successfully accommodated!";

                        $q= "SELECT * FROM accdata WHERE userId= $ID AND roomNo=$roomNo";
                        $stmm = $conn->prepare($q);
                        $stmm->execute();
                        $rezultatT = $stmm->fetch();
                        $accId = $rezultatT['data_id'];


                        $InsertInPayment = "INSERT INTO `payment` (student_id, accdata_id) VALUES (:STUDID, :ACDID)";
                        $InsertData = [
                        ':STUDID' => $ID,
                        ':ACDID' =>$accId
                        ];
                        $stmInser = $conn->prepare($InsertInPayment);
                        $stmInser->execute($InsertData);
                    }
                }
            }
        } else {
        array_push($errors, 'Faculty № does not exist');
        }
    }
}

?>

<form method="POST" action="addData.php?roomId=<?php echo $row['id'];?>">
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
                        <input type="text" name="fakNo" class="form-control" placeholder="Faculty No">
                    </div>
                    <div class="col-auto">
                        <input type="text" name="roomNo" value=<?php echo $row['roomNo'];?> class="form-control" id="limit" disabled  >
                    </div>
                    <div class="col-auto">
                    <button type="submit" class="btn btn-primary" name="submit" value= "Add room" style="margin-top:15px" onclick="myFunction()">Add</button>     
                    </div>
                </div>
            </div>
        </div>    
    </section>
</form>

