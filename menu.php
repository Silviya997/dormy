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
      if(isset($_SESSION['user']) && $_SESSION['user'] == 0) { ?>
        <li <?php
          if (isset($_GET['action']) && $_GET['action'] == 'student') {
            echo 'class="active"';
          }
            ?>><a href="index.php?action=student">Home</a></li>
            <?php     
        } 
      if(isset($_SESSION['user']) && $_SESSION['user'] == 1) { ?>
        <li <?php
          if (!isset($_GET['action'])) {
            echo 'class="active"';
          }
            ?>><a href="guardian.php">Home</a></li>
            <?php     
        }
        if(isset($_SESSION['user']) && $_SESSION['user'] == 2) { ?>
          <li <?php
            if (!isset($_GET['action'])) {
              echo 'class="active"';
            }
              ?>><a href="admin.php">Home</a></li>
              <?php     
          }
            if(isset($_SESSION['user']) && $_SESSION['user'] != 2) { ?>
          <li <?php
            if (isset($_GET['action']) && $_GET['action'] == 'contact') {
              echo 'class="active"';
            }
              ?>><a href="index.php?action=contact">Contact</a></li>
              <?php     
          }
        if(isset($_SESSION['user']) && $_SESSION['user'] == 1) { ?>
          <li <?php
            if (isset($_GET['action']) && $_GET['action'] == 'stud_payment') {
              echo 'class="active"';
            }
              ?>><a href="payment.php?action=stud_payment">Payment</a></li>
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
