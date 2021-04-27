<?php       
   include_once('header.php');
   include_once('common.php');
    include_once('sendEmail.php');
    
 
?>

    <form action="index.php?action=passForgot" method="POST">
        <section class="for_pass">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h4 class="title">Send email</h4> 
                    <input id="name" class="form-control" placeholder="Enter your email address" >
                    <input id="email" value="vutpdorm@gmail.com" class="form-control" name="poshta" disabled style="background-color:lightyellow">
                    <input id="subject" placeholder="Subject" class="form-control" value="Forgot password" disabled style="background-color:lightyellow">
                    <input id="body" class="form-check-input" name="checkbox" type="checkbox" value="I forgot my password" checked>
                    <label class="form-check-label" for="body">I forgot my password</label><br><br>
                    <input type="button" onclick="sendEmail()" value="Send An Email" class="btn btn-primary"><br>
                    <small>*You will receive an email with a new password within 24h</small>
                </div>
                <?php
                    if(!empty($errors)) {
                        include_once('errors.php');
                    }
                ?>
            </div>
        </section>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="js/sendEmail.js"></script>