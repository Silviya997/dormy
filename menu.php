<?php
include_once('conn.php');
include_once('header.php');
?>

<nav class="navbar">
<div></div>
        <a href="#" class="toggle-button">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </a>
        <div class="navbar-links">
    <ul>
      <!-- Guest -->
    <?php 
    if(!isset($_SESSION['user'])) { ?>
      <li <?php
        if (!isset($_GET['action'])) {
          echo 'class="active"';
        }
          ?>><a href="index.php">Home</a></li>
        <?php     
        }
    if(!isset($_SESSION['user'])) { ?>
      <li <?php
        if (isset($_GET['action']) && $_GET['action'] == 'registration') {
          echo 'class="active"';
        }
        ?>><a href="index.php?action=registration">Registration</a></li>
        <?php     
      }
    if(!isset($_SESSION['user'])) { ?>
      <li <?php
        if (isset($_GET['action']) && $_GET['action'] == 'login') {
          echo 'class="active"';
        }
      ?>><a href="index.php?action=login">Log in</a></li>
      <?php     
      }   
      // STUDENT
      if(isset($_SESSION['user']) && $_SESSION['user'] == 0) { ?>
        <li <?php
          if (isset($_GET['action']) && $_GET['action'] == 'student') {
            echo 'class="active"';
          }
            ?>><a href="index.php?action=student">Home</a></li>
            <?php     
        } 
      // USER  
      if(isset($_SESSION['user']) && $_SESSION['user'] == 1) { ?>
        <li <?php
          if (!isset($_GET['action'])) {
            echo 'class="active"';
          }
            ?>><a href="guardian.php">Home</a></li>
            <?php     
        }
        // ADMIN
        if(isset($_SESSION['user']) && $_SESSION['user'] == 2) { ?>
          <li <?php
            if (isset($_GET['action']) && $_GET['action'] == 'admin') {
              echo 'class="active"';
            }
              ?>><a href="index.php?action=admin">Home</a></li>
              <?php     
          }
        // COMMON
        if(isset($_SESSION['user'])) { ?>
          <li <?php
            if (isset($_GET['action']) && $_GET['action'] == 'contact') {
              echo 'class="active"';
            }
              ?>><a href="index.php?action=contact">Contact</a></li>
              <?php     
          }
        // USER  
        if(isset($_SESSION['user']) && $_SESSION['user'] == 1) { ?>
          <li <?php
            if (isset($_GET['action']) && $_GET['action'] == 'payment') {
              echo 'class="active"';
            }
              ?>><a href="index.php?action=payment">Payment</a></li>
              <?php     
          }
        // ADMIN
        if(isset($_SESSION['user']) && $_SESSION['user'] == 2) { ?>
          <li <?php
            if (isset($_GET['action']) && $_GET['action'] == 'data') {
              echo 'class="active"';
            }
              ?>><a href="index.php?action=data">Data</a></li>
              <?php     
          }
          //COMMON
          if(isset($_SESSION['user']) && $_SESSION['user'] == 0) { ?>
            <li <?php
              if (isset($_GET['action']) && $_GET['action'] == 'room') {
                echo 'class="active"';
              }
                ?>><a href="admin.php?action=room">Rooms</a></li>
                <?php     
            }
            if (isset($_SESSION['user'])) {
              ?> <li class="nav-item"> <a href="logout.php" >Logout</a></li>
              <?php
              }
             ?>
      </ul>
    </div>
  </nav>
<script src="js/script.js"></script>
