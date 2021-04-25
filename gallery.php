<?php
    require_once('conn.php');
    include_once('header.php');
    include_once('menu.php');
?>

<form method="post" action="index.php?action=gallery">
    <section class="gallery min-vh-100">
        <div class="container-lg">
            <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
                <div class="col">
                    <img src="img/1.jpg" class="gallery-item" alt="">
                </div>
                <div class="col">
                    <img src="img/11.jpg" class="gallery-item" alt="">
                </div>
                <div class="col">
                    <img src="img/3.jpg" class="gallery-item" alt="">
                </div>
                <div class="col">
                    <img src="img/4.jpg" class="gallery-item" alt="">
                </div>
                <div class="col">
                    <img src="img/5.jpg" class="gallery-item" alt="">
                </div>
                <div class="col">
                    <img src="img/6.jpg" class="gallery-item" alt="">
                </div>
                <div class="col">
                    <img src="img/7.jpg" class="gallery-item" alt="">
                </div>
                <div class="col">
                    <img src="img/8.jpg" class="gallery-item" alt="">
                </div>
                <div class="col">
                    <img src="img/9.jpg" class="gallery-item" alt="">
                </div>
                <div class="col">
                    <img src="img/10.jpg" class="gallery-item" alt="">
                </div>
                
            </div>
            <?php
include_once('footer.php');
?>
        </div>
    </section>  
</form>
<div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="img/1.jpg" class="modal-img" alt="modal img">
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scriptgallery.js"></script>
