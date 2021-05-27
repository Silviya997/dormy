<?php
    require_once('conn.php');
    include_once('header.php');
    include_once('common.php');

    $errors = [];

    if(isset($_POST['reg_user'])) {   
   
            $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
            $mid_name = filter_input(INPUT_POST, 'mid_name', FILTER_SANITIZE_STRING);
            $l_name = filter_input(INPUT_POST, 'l_name', FILTER_SANITIZE_STRING);
            $egn = filter_input(INPUT_POST, 'egn', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $username = $_POST['username'];
            $password_1 = $_POST['password_1'];
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        
            if (empty($first_name)) { 
                array_push($errors, "First name is required"); 
            }  else {
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
            if (!empty($egn)) { 
                if(!preg_match('/^[0-9]*$/', $egn)){ 
                    array_push($errors, "EGN is invalid");
                } else {
                        $qUseregn = "SELECT * FROM `user` WHERE egn = :egnn";
                        $stmegn = $conn->prepare($qUseregn);
                        $egnData = [
                        ':egnn' => $_POST['egn']
                        ];
                        $stmegn->execute($egnData);
                            if ($stmegn->rowCount()) {
                        array_push($errors, 'PINs already exist');
                        } else {
                        $EGNN = $_POST['egn'];
                        }
                    }
            }
            if (empty($egn)) { 
                array_push($errors, "PINs is required"); 
            } 


            if (!empty($email)) { 
                if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    array_push($errors, "Email is invalid");
                } else {
                $qUsermail = "SELECT * FROM `user` WHERE email = :poshta";
                $stmmail = $conn->prepare($qUsermail);
                $mailData = [
                ':poshta' => $_POST['email']
                ];
                $stmmail->execute($mailData);
                if ($stmmail->rowCount()) {
                    array_push($errors, 'Email already exist');
                } else {
                    $poshta = $_POST['email'];
                    } 
                }
            }
            if (empty($email)) { 
                array_push($errors, "Email is required"); 
            }
            if (!empty($username)) {	 
                $qUsername = "SELECT * FROM `user` WHERE username = :potrebitelsko_ime";
                $stmuser = $conn->prepare($qUsername);
                $userData = [
                ':potrebitelsko_ime' => $_POST['username']
                ];
                $stmuser->execute($userData);
                if ($stmuser->rowCount()) {
                    array_push($errors, 'Username already exist');
                } else {
                    $potrebitelskoIme = $_POST['username'];
                } 
            } 
            if (empty($username)) { 
                array_push($errors, "Username is required"); 
            }
        
            if (empty($phone)) { 
                array_push($errors, "Phone is required");
            } else {
                if (strlen($phone) < 10 || strlen($phone) > 14) {
                    array_push($errors, "Invalid input. Phone must be between 10 and 14 numbers.");
                }
            }
            if ($password_1 != $_POST['password_2']) {
                array_push($errors, "The two passwords do not match");
            } 
        
            if (empty($errors)) {
                $salt = 'dorm987';
                $password_1 = md5($salt . $_POST['password_1']);

                $query = "INSERT INTO  `user` (f_name, m_name, l_name, egn, email, username, pass1,	 phone, salt)
                VALUES (:FN, :MN, :LN, :EGN, :MAIL, :UN, :PAS1,  :PHONE, :SALT)";
                
                $statement = $conn->prepare($query);

                $data = [
                    ':FN' => $_POST['first_name'],
                    ':MN' => $_POST['mid_name'],
                    ':LN' => $_POST['l_name'],
                    ':EGN' => $_POST['egn'],
                    ':MAIL' => $_POST['email'],
                    ':UN' => $_POST['username'],
                    ':PAS1' => $password_1,
                    ':PHONE' => $_POST['phone'],
                    ':SALT' => $salt,
                ];
                $result = $statement->execute($data); 

                if ($result) {
                   header("location:index.php?action=login");
                    
                }
            }
    }


?>
<div class="container">
    <form action="index.php?action=registration" method="POST" >
        <section class="register">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h1 class="intro-heading">Register</h1> 
                    <div>
					<?php
					 if (!empty($errors)) {
						include_once ('errors.php');
						} 
					?>    
                    <input type="text" name="first_name" class="form-control" placeholder="First name" style="text-transform:capitalize;" >
                    <input type="text" name="mid_name" class="form-control" placeholder="Middle name" style="text-transform:capitalize;" >
                    <input type="text" name="l_name" class="form-control" placeholder="Last name" style="text-transform:capitalize;">
                    <input type="" name="egn" class="form-control" placeholder="PINs">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <input type="password" id="psw" name="password_1" class="form-control" placeholder="Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <div id="message">
                        <h6>Password must contain the following:</h6>
                        <small id="letter" class="invalid">A <b>lowercase</b> letter</small>
                        <small id="capital" class="invalid">A <b>uppercase</b> letter</small>
                        <small id="number" class="invalid">A <b>number</b></small>
                        <small id="length" class="invalid">Minimum <b>8 characters</b></small>
                    </div>
                    <input type="password" name="password_2" class="form-control" placeholder="Confirm password">
                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                    <button type="submit" class="btn btn-primary" name="reg_user" value= "Register">Register</button>                   
                    <a href="login.php"><p> Already a member? Log in </p></a>
                </div>
                <div class="col-md-3"></div>
            </div>
        </section>
    </form>
    </div>

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

   
<?php
    include_once('footer.php');
?>





