<?php
    session_start();

	if(!isset($_SESSION['user']) || $_SESSION['user'] != 0){
		header('Location:index.php');
	}

    require_once('conn.php');
    include_once('header.php');
    include_once('sessionHeader.php');

    if(!isset($_SESSION['student_id'])) {
        session_start();
    }
   $queryshow = "SELECT * FROM `user` WHERE id = :id";
   $datashow = [
    ':id' => $_SESSION['student_id']
   ];
   $stmshow = $conn->prepare($queryshow);
   $stmshow->execute($datashow);

   $payShow = "SELECT * FROM `payment` WHERE student_id = :id";
   $dataPay = [
    ':id' => $_SESSION['student_id']
   ];
   $payStm = $conn->prepare($payShow);
   $payStm->execute($dataPay);
?>

<form action="index.php?action=student" method="POST">
    <section class="main_section">
    <div class="container">
        <h2 class="title">Welcome to VUTP Dormitory</h2>
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
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row=$stmshow->fetch(PDO::FETCH_OBJ)) {
                        $id = $row->id;
                ?>
                    <tr>
                        <td> <?php echo $row->f_name;?></td>
                        <td> <?php echo $row->m_name;?></td>
                        <td> <?php echo $row->l_name;?></td>
                        <td> <?php echo $row->egn;?></td>
                        <td> <?php echo $row->fakNo;?></td>
                        <td> <?php echo $row->phone;?></td>
                        <td> <?php echo $row->email;?></td>
                        <td > <?php echo $row->university;?></td>
                        <td> <?php echo $row->course;?></td>
                        <td> <?php echo $row->semester;?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            <small><a href="contact.php" style="color:red">*If these aren't your data, please contact Admin.</a></small><br>
            <small><a href="index.php?action=newpass" style="color:blue">*If you want to change your password, click here.</a></small>
            <h4 class="title" style="margin-top:1rem">Your payments</h4>
            <div class="table-responsive-sm">
            <table class="table">
                <thead class="table-light">
                    <tr>
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
                    while($res=$payStm->fetch(PDO::FETCH_OBJ)) {
                   
                ?>
                    <tr>
                        <td> <?php echo $res->January;?></td>
                        <td > <?php echo $res->February;?></td>
                        <td> <?php echo $res->March;?></td>
                        <td> <?php echo $res->April;?></td>
                        <td > <?php echo $res->May;?></td>
                        <td> <?php echo $res->June;?></td>
                        <td> <?php echo $res->July;?></td>
                        <td> <?php echo $res->August;?></td>
                        <td> <?php echo $res->September;?></td>
                        <td> <?php echo $res->October;?></td>
                        <td> <?php echo $res->November;?></td>
                        <td> <?php echo $res->December;?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>

        <?php
            if(!empty($fakNo)) { 

            } else {
                ?>
        <div id="first">
        <div class="container">
            <div class="row">  
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
                <?php
                     if(isset($_POST['add'])) { 
                        $errors = [];
                        $fn = filter_input(INPUT_POST, 'fakNo', FILTER_SANITIZE_STRING);
                        $uni = strtoupper(filter_input(INPUT_POST, 'uni', FILTER_SANITIZE_STRING));
                        $course = strtoupper(filter_input(INPUT_POST, 'course', FILTER_SANITIZE_STRING));
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
                    
                      
                            $queryadd = "UPDATE `user` SET `fakNo`=:f, `university`=:u, `course`=:c, `semester`=:s WHERE id = $id"; 
    
                            $statementadd = $conn->prepare($queryadd);
    
                            $dataadd = [
                                ':f' => $_POST['fakNo'],
                                ':u' => strtoupper($_POST['uni']),
                                ':c' => strtoupper($_POST['course']),
                                ':s' => $_POST['sem'],
                            ];
                            $add = $statementadd->execute($dataadd); 
                            if ($add) {
                                ?>
                 <meta http-equiv="refresh" content="0;url='index.php?action=student'"/>

                                <?php
                            }
                        } else {
                            include_once ('errors.php');
                        }
                    }
                }
            }
            ?>
          

        <section style="text-align: justify" class="rules">
            <h3 class="title">Rules for living in a dormitory</h5>
            <span>The dormitory is meant for students and its most important function is to provide a substitute home during studies and good possibilities to study. The purpose of these rules is to create an open, pleasant and secure atmosphere and a peaceful living environment in the dormitory.</span><br>
            <span>These rules are made known to each and every student who comes to live in the dormitory.</span>
            <span>The right to live in the dormitory is granted primarily to students attending a university  in Sofia, based on the distance to their home or some other reason. The same rules apply to everyone living in the dormitory.</span><br>
            <span>A student may lose his or her right to live in the dormitory: </span><br>
            <span> - if the student does not comply with these rules</span><br>
            <span>- if the right to study in the school ends or is terminated</span><br>
            <span>- if the student does not regularly participate in education or related learning by working periods arranged by the school.</span><br>
            <span>Only persons who have been granted the right to live in the dormitory may live there. Living in the
            dormitory during school vacations without special permission is forbidden.
            Persons who do not live in the dormitory may stay in the dormitory only during visiting hours or with
            special permission from the dormitory supervisor. Visiting hours are 16:00–21:00. Visiting in other
            students’ rooms is allowed only by permission of the persons living in the room. The dormitory supervisor
            may limit or prohibit visits if they cause a disturbance. Anyone living in the dormitory must immediately
            report to the dormitory supervisor any persons entering the dormitory who do not belong there and who
            are not visiting someone living there.
            2
            The outer doors are locked 23:30 and unlocked 6:30. The doors to the apartments must always be kept
            locked. Under-18-year-olds must be inside the dormitory no later than 22:00. If necessary, the dormitory
            supervisor may grant a student permission to come in later. Under-18-year-olds must have permission
            from their guardian to be absent from the dormitory at night.
            To ensure peace and quiet for living and studying, students should avoid making noise in all rooms. All
            noisy behaviour is forbidden after 22:00. The dormitory must be quiet 22:00–07:00.
            Students may bring their own furniture and electrical equipment into the dormitory by permission of the
            dormitory supervisor. If a student’s electrical device causes a disturbance or noise, its use in the dormitory
            may be forbidden. The dormitory supervisor may confiscate and store equipment that causes a
            disturbance or noise until the student takes said equipment away from the dormitory.</span><br>
            <span>The following objects or materials may not be brought to or stored in the dormitory:</span><br>
            <span>- cutting weapons, firearms or equivalent devices, materials, sprays, etc. meant for injuring or
            incapacitating people</span><br>
            <span> - flammable and volatile fuels, solvents, etc.</span><br>
            <span>- pets.</span><br>
            <span>Use of auxiliary heaters in the dormitory is forbidden.</span><br>
            <span>Open fires in the dormitory and the surrounding area are forbidden (candles, incense).</span><br>
            <span>No nails may be driven and no holes may be drilled into the walls of the building.</span><br>
            <span>Any defects in the building must be reported to the dormitory supervisor immediately.</span><br>
        </div>
        </section>
    </section>
    <?php
    include_once('footer.php');
    ?>
</form>
