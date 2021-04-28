<?php 
   include_once('header.php');
   include_once('common.php');

if (!isset($_SESSION)) {
	session_start();
}
require ('conn.php');

if (isset($_POST['login_user'])) {
	$errors = [];


		if (empty($_POST['user_name'])) {
			array_push($errors, 'Enter your username!');
		} 
		if (empty($_POST['pass'])) {
			array_push($errors, 'Enter your password!');
		}
		if (!empty($_POST['user_name']) && !empty($_POST['pass'])) {
			$salt = 'dorm987';
			$password = md5($salt . $_POST['pass']);

			$qAcount = "SELECT * FROM `user` WHERE `username`=:potrebitel AND `pass1`= :parola";
			$data = [
			':potrebitel' => $_POST['user_name'],
			':parola' => $password,
			];

			$statement = $conn->prepare($qAcount);
			$statement->execute($data);
			$result = $statement->fetch();


		if ($statement->rowCount() == 1) {
			$role = $result['role'];
			$_SESSION['user'] = $role;
			$_SESSION['student_id'] = $result['id'];
			switch ($role) {
                case '2':
					header('location: admin.php');
				break;

				case '1':
					header('location:guardian.php');
				break;

				case '0':
					header('location: index.php?action=student');
				break;
			}

		} elseif ($statement->rowCount() >= 2) {
			array_push($errors, 'Something went wrong! Please, contact Admin!');
		} else {
			array_push($errors, 'Invalid username/password!');
			
		}
		} 
}

?>
<form method="post" action="index.php?action=login">
    <section class="login">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="intro-heading">Sign in</h1>
                <img class="profile-img" src="img/19.jpg" alt="">
                <input type="text" class="form-control" placeholder="Username" name="user_name" >
                <input type="password" class="form-control" placeholder="Password"  name="pass" >
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_user"> Sign in</button><br>
                <p class="notmember" style="margin-bottom:0px">Not yet a member? <a href="registration.php">Registration</a></p>   
				<p class="notmember"><a href="index.php?action=passForgot" style="color:deeppink">Forgot password</a></p>     
  
				<div>
					<?php
					 if (!empty($errors)) {
						include_once ('errors.php');
						} 
					?>
				</div> 
            </div>
        </div>
    </section>
</form>


