<?php
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user'] != 2){
        header('Location:index.php');
    }
    require_once('conn.php');
    include_once('header.php');
    include_once('sessionHeader.php');

    $editid=$_GET['editId'];

    $editQuery = "SELECT * FROM user u INNER JOIN accdata a ON u.id=a.userId  WHERE u.id=:id";
    $editStm = $conn->prepare($editQuery);
			$editData = [
			':id' => $editid
			];
			$editStm->execute($editData);
            $row=$editStm->fetch();
            $room = $row['RoomNo'];
            // var_dump($room);exit;
            if(isset($_POST['reg_user'])) {   
                
                $errors=[];

                $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
                $mid_name = filter_input(INPUT_POST, 'mid_name', FILTER_SANITIZE_STRING);
                $l_name = filter_input(INPUT_POST, 'l_name', FILTER_SANITIZE_STRING);
                $egn = filter_input(INPUT_POST, 'egn', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
                $fn = filter_input(INPUT_POST, 'fakNo', FILTER_SANITIZE_STRING);
                $uni = strtoupper(filter_input(INPUT_POST, 'uni', FILTER_SANITIZE_STRING));
                $course = strtoupper(filter_input(INPUT_POST, 'course', FILTER_SANITIZE_STRING));
                $sem = filter_input(INPUT_POST, 'sem', FILTER_SANITIZE_STRING);
                $acc = $_POST['acc'];
                $is_left = $_POST['is_left'];
                $roomNo = $_POST['roomNo'];


                if (empty($first_name)) { 
                    array_push($errors, "First name is required"); 
                } else {
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$first_name)) {
                        array_push($errors, "First name->Only letters and white space allowed" ) ;
                      }
                }
                if (empty($l_name)) { 
                    array_push($errors, "Last name is required"); 
                }  else {
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$l_name)) {
                        array_push($errors, "Last name->Only letters and white space allowed" ) ;
                      }
                }
                if (!preg_match("/^[a-zA-Z-' ]*$/",$mid_name)) {
                    array_push($errors, "Middle name->Only letters and white space allowed" ) ;
                  }
                if (empty($uni)) { 
                    array_push($errors, "Last name is required"); 
                }  else {
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$uni)) {
                        array_push($errors, "University->Only letters and white space allowed" ) ;
                      }
                }
                if (empty($course)) { 
                    array_push($errors, "Last name is required"); 
                }  else {
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$course)) {
                        array_push($errors, "Cours->Only letters and white space allowed" ) ;
                      }
                }
                if(!empty($sem)) {
                    if(!preg_match('/^[0-9]*$/', $sem)){ 
                        array_push($errors, "Semester->Only digits and white space allowed");
                    }
                }
                    if(!preg_match('/^[0-9]*$/', $egn)){ 
                        array_push($errors, "EGN is invalid");
                    } 
                    if(!preg_match('/^[0-9]*$/', $fn)){ 
                        array_push($errors, "Fak NO is invalid");
                    } 
                if (empty($egn)) { 
                    array_push($errors, "PINs is required"); 
                } 
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                        array_push($errors, "Email is invalid");
                    } 
                if (empty($email)) { 
                    array_push($errors, "Email is required"); 
                }
                if (empty($phone)) { 
                    array_push($errors, "Phone is required");
                } else {
                    if (strlen($phone) < 10 || strlen($phone) > 14) {
                        array_push($errors, "Invalid input. Phone must be between 10 and 14 numbers.");
                    }
                }
            
                 if (empty($fn)) { 
                    array_push($errors, "Fak No is required"); 
                }
                if (empty($acc)) { 
                    array_push($errors, "Accommodated is required");
                } 
                if (empty($is_left)) { 
                    array_push($errors, "Left is required");
                } else {
                    if ($is_left < $acc) {
                        array_push($errors, "Invalid input. Left can not be < than Accommodated.");
                    }
                }
              
                if(empty($errors)) {
                    $queryy = "SELECT * FROM rooms WHERE roomNo = :nomer AND stateOfroom = 'free'";
                    $dataa = [
                        ':nomer' => $_POST['roomNo']
                    ];
                    $stt = $conn->prepare($queryy);
                    $stt->execute($dataa);
                    $rez=$stt->fetch();

                    if($stt->rowCount() == 1) {
                        $roomId = $rez['id']; 

                    $querya = "UPDATE user INNER JOIN accdata ON user.id = accdata.userId SET `f_name`=:fn, `m_name`=:md, `l_name`=:ln, `egn`=:egn, `email`=:mail, `phone`=:tel,
                      `fakNo`=:f, `university`=:u, `course`=:c, `semester`=:s, `accommodated`=:acc, `is_left`=:isleft, `RoomNo`=:roomno, `room_id`=:roomId
                       WHERE accdata.userId = :ID"; 
                    $statementup = $conn->prepare($querya);

                    $dataadd = [
                        ':ID' => $editid,
                        ':fn' => $_POST['first_name'],
                        ':md' => $_POST['mid_name'],
                        ':ln' => $_POST['l_name'],
                        ':egn' => $_POST['egn'],
                        ':mail' => $_POST['email'],
                        ':tel' => $_POST['phone'],
                        ':f' => $_POST['fakNo'],
                        ':u' => strtoupper($_POST['uni']),
                        ':c' => strtoupper($_POST['course']),
                        ':s' => $_POST['sem'],
                        ':acc' => $_POST['acc'],
                        ':isleft' => $_POST['is_left'],
                        ':roomno' => $_POST['roomNo'],
                        ':roomId' => $roomId,
                    ];
                    $update1 = $statementup->execute($dataadd); 
                    if ($update1 == true) {
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
                          
                          $U = "UPDATE `rooms` SET `stateOfroom` = 'free' WHERE roomNo=$room";
                            $SU = $conn->prepare($U);
                            $SU->execute();
                          }  
                       ?>
                       <meta http-equiv="refresh" content="0;url='editUser.php?editId=<?php echo $row['id'];?>'"/>
                        <?php
                    }
                           
                } else {
                    array_push($errors,  'This room is occupied');
                }
    
                    
                }
            }
            
?>

<form action="editUser.php?editId=<?php echo $row['id'];?>" method="POST">
<section>
<section class="" >
        <div class="container">
    <div class="row">
        <?php
if(!empty($errors)) {
include_once('errors.php');
}
        ?>
            <h3 class="title">Edit student</h3>
            <div class="row g-3" id="row_center">
               
                <div class="col-auto">
                   First name <input type="text" name="first_name" class="form-control" value="<?php echo $row['f_name'];?>">
                </div>
                <div class="col-auto">
                  Middle name  <input type="text" name="mid_name" class="form-control" value="<?php echo $row['m_name'];?>">
                </div>
                <div class="col-auto">
                  Last name  <input type="text" name="l_name" class="form-control" value="<?php echo $row['l_name'];?>">
                </div>
                <div class="col-auto">
                   PINs <input type="" name="egn" class="form-control" value="<?php echo $row['egn'];?>">
                </div>
                <div class="col-auto">
                   Email <input type="text" name="email" class="form-control" value="<?php echo $row['email'];?>">
                </div>
                <div class="col-auto">
                  Phone <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];?>">
                </div>
                <div class="col-auto">
                   Faculty No <input type="text" name="fakNo" class="form-control" value="<?php echo $row['fakNo'];?>"> 
                </div>
                <div class="col-auto">
                   University <input type="text" name="uni" class="form-control" value="<?php echo $row['university'];?>" id="uppercaseInput"> 
                </div>
                <div class="col-auto">
                   Course <input type="text" name="course" class="form-control" value="<?php echo $row['course'];?>" id="uppercaseInput" >
                </div>
                <div class="col-auto">
                   Semester <input type="text" name="sem" class="form-control" value="<?php echo $row['semester'];?>"> 
                </div>
                <div class="col-auto">
                       Room  <input type="text" name="roomNo" class="form-control" value="<?php echo $row['RoomNo'];?>" id="limit" >
                </div>
                <div class="col-auto">
                       Accommodated <input type="date" name="acc" class="form-control" value="<?php echo $row['accommodated'];?>" id="limit" >
                </div>
                <div class="col-auto">
                      Left <input type="date" name="is_left" class="form-control" value="<?php echo $row['is_left'];?>" id="limit" >
                </div>
                <center><div class="">
                    <button type="submit" class="btn btn-primary" name="reg_user" value= "Register" style="margin-top:15px">Update</button>     
                </div></center>
            </div>
        </div>
    </div>    
    </section>

</form>