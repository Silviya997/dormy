
<?php
    include_once('conn.php');
    include_once('header.php');
    
    if (!isset($_SESSION)) {
        session_start();
    }
//  <!-- STUDENT  -->
 
    if(isset($_SESSION['user']) && $_SESSION['user'] == 0) {
        if(!isset($_SESSION['student_id'])) {
            session_start();
        }
            $query = "SELECT * FROM `user` WHERE id=:id";
            $data = [
                ':id' => $_SESSION['student_id']
               ];
               $stmm = $conn->prepare($query);
               $stmm->execute($data);
               $res=$stmm->fetch(PDO::FETCH_OBJ);
               
        include_once('sessionHeader.php');
        include_once('contactform.php');
    ?>
        <section class="mail">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h4 class="text-center">Send email</h4> 
                    <input id="name" value="<?php echo $res->email; ?>" class="form-control" >
                    <input id="email" value="vutpdorm@gmail.com" class="form-control" name="poshta">
                    <input id="subject" placeholder="Subject" class="form-control">
                    <textarea class="form-control" id="body" placeholder="Textarea"></textarea>                    
                    <input type="button" onclick="sendEmail()" value="Send An Email" class="btn btn-primary">
                </div>
            </div>
        </section>

 <?php
    
// ADMIN
    }
    elseif(isset($_SESSION['user']) && $_SESSION['user'] == 1) {
        include_once('sessionHeader.php');
        include_once('contactform.php');

    // }
    // elseif(isset($_SESSION['user']) && $_SESSION['user'] == 2) {
    // 
     // <div>Admin</div>
  
    } else {
        include_once('common.php');
        include_once('contactform.php');
    }


?>

 
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="js/sendEmail.js"></script>