<?php
session_start();
require_once('conn.php');
$errors = [];
if(!isset($_SESSION['user']) && $_SESSION['user'] != 1){
  header('location:index.php');
 }
     include_once('header.php');
     include_once('sessionHeader.php');

if(!isset($_GET['action'])) {
    $query = "SELECT COUNT(*) FROM rooms WHERE stateOfroom = 'outOforder'";
    $statement= $conn->prepare($query);
    $statement->execute();
    $outOforder= $statement->fetchColumn(); 

    $query = "SELECT COUNT(*) FROM rooms WHERE stateOfroom = 'occupied'";
    $statement= $conn->prepare($query);
    $statement->execute();
    $occupied= $statement->fetchColumn(); 

    $query = "SELECT COUNT(*) FROM rooms WHERE stateOfroom = 'free'";
    $statement= $conn->prepare($query);
    $statement->execute();
    $free= $statement->fetchColumn(); 
   
    ?>
<form action="guardian.php" method="post">
<section class="homesection">
<div class="container">
<div class="row">
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="rooms text-info">30</h3>
                  <p class="mb-0">Total rooms</p>
                </div>
                <div class="align-self-center">
                  <i class="fas fas fa-home text-info fa-3x"></i>
                </div>
              </div>
              <div class="px-md-1">
                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                  <div
                       class="progress-bar bg-info"
                       role="progressbar"
                       style="width: 80%"
                       aria-valuenow="80"
                       aria-valuemin="0"
                       aria-valuemax="100"
                       ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="occ_rooms text-warning"><?php  echo $occupied; ?></h3>
                  <p class="mb-0">Occupied rooms</p>
                </div>
                <div class="align-self-center">
                  <i class="fas fa-users text-warning fa-3x"></i>
                </div>
              </div>
              <div class="px-md-1">
                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                  <div
                       class="progress-bar bg-warning"
                       role="progressbar"
                       style="width: 35%"
                       aria-valuenow="35"
                       aria-valuemin="0"
                       aria-valuemax="100"
                       ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="free_rooms text-success"><?php  echo $free; ?></h3>
                  <p class="mb-0">Free rooms</p>
                </div>
                <div class="align-self-center">
                  <i class="fas fa-users-slash text-success fa-3x"></i>
                </div>
              </div>
              <div class="px-md-1">
                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                  <div
                       class="progress-bar bg-success"
                       role="progressbar"
                       style="width: 60%"
                       aria-valuenow="60"
                       aria-valuemin="0"
                       aria-valuemax="100"
                       ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between px-md-1">
                <div>
                  <h3 class="out_order text-danger"><?php  echo $outOforder; ?></h3>
                  <p class="mb-0">Out of order</p>
                </div>
                <div class="align-self-center">
                  <i class="fas fa-times text-danger fa-3x"></i>
                </div>
              </div>
              <div class="px-md-1">
                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-danger" 
                       role="progressbar" 
                       style="width: 40%"
                       aria-valuenow="40"
                       aria-valuemin="0"
                       aria-valuemax="100"
                       ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-md-1">
                <div class="d-flex flex-row">
                  <div class="align-self-center">
                    <i class="fas fa-user-plus  fa-3x me-4" style="color:deeppink"></i>
                  </div>
                  <div>
                    <h4></h4>
                    <p class="mb-0"></p>
                  </div>
                </div>
                <div class="align-self-center">
                <h2 class="h1 mb-0" ><a href="guardian.php?action=addstudent" style="color:deeppink">Add user</a></h2 >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-md-1">
                <div class="d-flex flex-row">
                  <div class="align-self-center">
                    <i class="fas fa-search  fa-3x me-4" style="color:purple"></i>
                  </div>
                  <div>
                    <h4></h4>
                    <p class="mb-0"></p>
                  </div>
                </div>
                <div class="align-self-center">
                <h2 class="h1 mb-0" ><a href="search.php?action=searchStudent" style="color:purple">Search for a student</a></h2 >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-md-1">
                <div class="d-flex flex-row">
                  <div class="align-self-center">
                    <i class="fas fa-door-open  fa-3x me-4" style="color:brown"></i>
                  </div>
                  <div>
                    <h4></h4>
                    <p class="mb-0"></p>
                  </div>
                </div>
                <div class="align-self-center">
                <h2 class="h1 mb-0" ><a href="data.php?action=addData" style="color:brown">Choose room </a></h2 >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-md-1">
                <div class="d-flex flex-row">
                  <div class="align-self-center">
                    <i class="fas fa-search  fa-3x me-4" style="color:yellow"></i>
                  </div>
                  <div>
                    <h4></h4>
                    <p class="mb-0"></p>
                  </div>
                </div>
                <div class="align-self-center">
                <h2 class="h1 mb-0" ><a href="roomSearch.php?action=search" style="color:yellow">Search for a room </a></h2 >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php

} else {
  $file = $_GET['action'] .".php";
  if(file_exists($file)){
    include_once ($file);
  } 
}
    ?>
    </section>
</form>
<?php
    include_once('footer.php');
?>

