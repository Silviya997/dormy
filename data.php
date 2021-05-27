<?php
session_start();

require_once('conn.php');
include_once('header.php');
include_once('sessionHeader.php');


$acc= date('Y-m-d');
$left = date('Y-m-d', strtotime("+12 months", strtotime($acc)));

$errors = [];


if (isset($_POST['add_room'])) {
    $errors = [];

    if (empty($_POST['fakNo'])) {
        array_push($errors, 'Enter faculty number!');
    } 
    if (empty($_POST['roomNo'])) {
        array_push($errors, 'Enter room number!');
    }
    if (!empty($_POST['fakNo']) && !empty($_POST['roomNo'])) {
    $qAcount = "SELECT * FROM `user` WHERE `fakNo`=:FakNo";
    $data = [
    ':FakNo' => $_POST['fakNo']
    ];
    $statement = $conn->prepare($qAcount);
    $statement->execute($data);
    $result = $statement->fetch();

    if ($statement->rowCount() > 0) {
        $ID = $result['id'];
        $roomNo = $_POST['roomNo'];
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
                $check= "SELECT * FROM user u INNER JOIN accdata a ON u.id=a.userId WHERE u.id = :ID ";
                $d = [
                ':ID' => $ID
                ];
                $stm = $conn->prepare($check);
                $stm->execute($d);
                $r=$stm->fetch();
                if($stm->rowCount() > 0) {
                    array_push($errors, 'This number has already been assigned a room');  ?> <div class="row" style="margin-top:1rem"><center><a href="search.php?action=search">Search for a student</a></div></center> <?php 

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
                            ?>
                            <a href="search.php">Find student</a>
                            <?php

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
                    array_push($errors, "This room is occupied!"); ?> <div class="row" style="margin-top:1rem"><center><a href="roomSearch.php?action=search">Search for a room</a></div></center> <?php
                }
            } else {
            array_push($errors, "This room is out of order!"); ?> <div class="row" style="margin-top:1rem"><center><a href="roomSearch.php?action=search">Search for a room</a></div></center> <?php
            } 

        } else {
        array_push($errors, 'A room with this № does not exist'); ?> <div class="row" style="margin-top:1rem"><center><a href="roomSearch.php?action=search">Search for a room</a></div></center> <?php

        }
        } else {
        array_push($errors, 'Faculty № does not exist'); ?> <div class="row" style="margin-top:1rem"><center><a href="addStudent.php?action=addstudent">Add student</a></div></center> <?php
        }
    }
}


?>

<form method="POST" action="data.php?action=addData">
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
                        <input type="text" name="roomNo" class="form-control" placeholder="Room No" id="limit"  >
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary" name="add_room" value= "Add room" style="margin-top:15px" onclick="myFunction()">Add</button>     
                    </div>
                </div>
            </div>
        </div>    
    </section>
</form>

