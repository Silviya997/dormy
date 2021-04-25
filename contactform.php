<form action="index.php?action=contact" method="POST">
<section class="contact">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1 class="intro-heading">Contact</h1>  
            <h6>Address: street Academic Stefan Mladenov, Sofia, Bulgaria</h6>
            <h6>Dormitory: +0236458795</h6>
            <h6>Email: vutpdorm@gmail.com</h6>
            <h6>Rectorate: +35978654896</h6>
            <div id="map"></div>  
        </div> 
        <div class="col-md-2"></div>

    </div>
            <?php
            if(!isset($_SESSION['user'])) {
         ?>
               <center><a href="index.php?action=login"><small style="color:red">If you have a question, please login to contact us</small></a></center> 
        <?php
            }
            elseif(isset($_SESSION['user']) && $_SESSION['user'] == 1) {
        ?>
        <div class="container-fluid">
                <p style="color:#ea3453;">Please, check email inbox recently. For answering to user, do not replay to his/her email. Use email address from name to compose a new message.</p>
               <img src="img/email.jpg" class="intro-img">
            <?php
                
            }
        ?>
    </div>
</section>
<script src="js/googlemap.js"></script>

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFnabL8WhVzYb6KAicPpV-wHGu_Eikh5A&callback=initMap&libraries=&v=weekly"

defer
></script>