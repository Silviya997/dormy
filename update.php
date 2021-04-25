<?php

if(isset($_POST['add'])) { 
    $errors = [];

    $fn = filter_input(INPUT_POST, 'fakNo', FILTER_SANITIZE_STRING);
    $uni = filter_input(INPUT_POST, 'uni', FILTER_SANITIZE_STRING);
    $course = filter_input(INPUT_POST, 'course', FILTER_SANITIZE_STRING);
    $sem = filter_input(INPUT_POST, 'sem', FILTER_SANITIZE_STRING);


    if (!empty($fn)) { 
        if(!preg_match('/^[0-9]*$/', $fn)){ 
            array_push($errors, "Fak NO is invalid");
        } else {
        $qfakNo = "SELECT * FROM `user` WHERE fakNo = :fn";
        $stmfakNo = $conn->prepare($qfakNo);
        $fakNodata = [
        ':fn' => $_POST['fakNo'],
        ];
        $stmfakNo->execute($fakNodata);

        if ($stmfakNo->rowCount()) {
            array_push($errors, 'Fak No already exist');
        } else {
            $fakultetenno = $_POST['fakNo'];
            } 
        }
    }
    if (empty($fn)) { 
        array_push($errors, "Fak No is required"); 
    }
    if (empty($uni)) { 
        array_push($errors, "University is required"); 
    }   else {
        if (!preg_match("/^[a-zA-Z-' ]*$/",$uni)) {
            array_push($errors, "University->Only letters and white space allowed" ) ;
          }
    } 
    if (empty($course)) { 
        array_push($errors, "Course is required"); 
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/",$course)) {
            array_push($errors, "Course->Only letters and white space allowed" ) ;
          }
    }
    if (empty($sem)) { 
        array_push($errors, "Semester is required"); 
    }
    if(!empty($sem)) {
        if(!preg_match('/^[0-9]*$/', $sem)){ 
            array_push($errors, "Semester->Only digits and white space allowed");
        }
    }
    if (empty($errors)) {

        $queryadd = "UPDATE  `user` SET `fakNo`=:f, `universitu`=:u, `course`=:c, `semester`=:s WHERE id = $id"; 

        $statementadd = $conn->prepare($queryadd);

        $dataadd = [
            ':f' => $_POST['fakNo'],
            ':u' => $_POST['uni'],
            ':c' => $_POST['course'],
            ':s' => $_POST['sem'],
        ];
        $add = $statementadd->execute($dataadd); 
        if ($add) {
            echo "bravo";
           
        }
    }
}
}

?>


<div id="first">
        <div class="container">
            <div class="row">
                <?php
                if (!empty($errors)) {
                include_once ('errors.php');
                } 
                ?>   
                <h3 class="title">Please add missing data</h3>
                <div class="row g-3" id="row_center">
                    <div class="col-auto">
                        <input type="text" name="fakNo" class="form-control" placeholder="Fak No"> 
                    </div>
                    <div class="col-auto">
                        <input type="text"  name="uni" class="form-control" placeholder="University" id="uppercaseInput">
                    </div>
                    <div class="col-auto">
                        <input type="text"  name="course" class="form-control" placeholder="Course" id="uppercaseInput">
                    </div>
                    <div class="col-auto">
                        <input type="text" name="sem" class="form-control" placeholder="Semester"> 
                    </div>
                    <div class="col-auto">
                        <input type="submit" name="add" class="btn btn-primary"> 
                    </div>
                </div>
            </div>
        </div>
</div>