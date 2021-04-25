<?php
    $connection = "conn.php";
    if(file_exists($connection)) {
        include_once($connection);
    } else {
        die("Fatal error");
    }
        include_once('header.php');

        $errors = [];

    if (isset($_GET['action'])) {
        $page = $_GET['action'] . ".php";
        if(file_exists($page)) {
            include_once($page);
        } else {
            array_push($errors, 'Page does not exist. Please turn back <a href= "index.php">Home</a>');
        } 
    } else {
        include_once('common.php')
        ?> 
                    <div class="main">
                    <section class="section-intro"> 
                        <div class="container-fluid">
                            <h1 class="intro-heading">Welcome!</h1>
                            <img src="img/10.jpg" class="intro-img" alt="">
                            <p class="intro-par"> The longer I live, the more beautiful life becomes. If you
                            foolishly ignore beauty, you will soon find yourself without it.
                            Your life will be impoverished. But if you invest in beauty, it
                            will remain with you all the days of your life.</p>
                        </div>
                    </section>
                    <section class="blog">
                    <h2 class="display-6 mb-5"></h2>
                        <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                            <div class="card">
                                <img src="img/11.jpg" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title">About us</h5>
                                    <p class="card-con">Find more info...</p>
                                    <button type="button" class="btn btn-outline-secondary float-right">Read more...</button>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="card">
                                <img src="img/3.jpg" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title">Gallery</h5>
                                    <p class="card-con">See our gallery...</p>
                                    <button type="button" class="btn btn-outline-secondary float-right"> <a href="index.php?action=gallery">Read more...</a></button>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="card">
                                <img src="img/16.jpg" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title">Contact</h5>
                                    <p class="card-con">Have a question?</p>
                                    <button type="button" class="btn btn-outline-secondary float-right"><a href="index.php?action=contact">Read more...</a></button>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php
                        include_once ('footer.php') ?>
                    </section>
                </div>
            </div>
        </div>
        </div>
    

<?php
    }
  ?>
  
 