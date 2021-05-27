<?php

	if(!isset($_SESSION['user']) || $_SESSION['user'] == 1){
		header('Location:index.php');
	}

    if(!isset($_SESSION['student_id'])) {
        session_start();
    }
    require_once('conn.php');
    include_once('header.php');
    include_once('sessionHeader.php');

  
    if(isset($_POST['change'])) {
        
        $nPass = $_POST['newPassword'];
        $rPass = $_POST['confirmPassword'];
        $mail = $_POST['mail'];

        $q= "SELECT * FROM user WHERE email=:mail";
        $d=[
            ':mail' => $mail
        ];
        $s=$conn->prepare($q);
        $s->execute($d);
        $r=$s->fetch();
        if($r) {
            $id = $r['id'];
        
        $errors = [];
        $salt = 'dorm987';


        if (empty($nPass)) { 
            array_push($errors, "New password is required"); 
        }
        if (empty($rPass)) { 
            array_push($errors, "Repeat new password is required"); 
        }
        if(empty($errors)) {
            $salt = 'dorm987';

            $nPass = md5($salt . $_POST['newPassword']);
            $rPass = md5($salt . $_POST['confirmPassword']);

           
                if(empty($errors)) {
                    $Query = "UPDATE `user` SET `pass1` = :newpass WHERE id = $id";
                    $Stm = $conn->prepare($Query);
                    $Data = [
                        ':newpass' => $nPass
                    ];
                    $result = $Stm->execute($Data);
                    if($result) {
                        echo "Successfully changed password";
                    } else {
                        echo "Try again";
                    }

                } else {
                    echo "try again";
                }
            
            }
    
        } else {
            ?>  <p>"Student with this email address does not exist in database!"</p> <?php
        }
    }
    
?>

    <form action="admin.php?action=updatePass" method="POST">
        <section class="updatePass">
        <div class="container">
            <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h3 class="title" >CHANGE PASSWORD</h3> <br>
                    <?php
                    include_once('errors.php');
                    ?>
                   Mail : <br> <input type="text"  class="form-control" name="mail">
                    New Password:
                    <input type="password" name="newPassword" id="psw" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <div id="message">
                        <h6>Password must contain the following:</h6>
                        <small id="letter" class="invalid">A <b>lowercase</b> letter</small>
                        <small id="capital" class="invalid">A <b>uppercase</b> letter</small>
                        <small id="number" class="invalid">A <b>number</b></small>
                        <small id="length" class="invalid">Minimum <b>8 characters</b></small>
                    </div>
                    <br>
                    Confirm Password:
                    <input type="password" name="confirmPassword" class="form-control">
                    <br>
                    <input type="submit" class="btn btn-primary" name="change">
                </div>    
            </div>    
        </div>
        </section>
    </form>
    <?php
include_once('footer.php');
?>
<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

myInput.onkeyup = function() {
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>