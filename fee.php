<?php

    $query = "SELECT price FROM fee";
    $statement = $conn->prepare($query);
    $statement->execute();
    $row = $statement->fetch();

    if(isset($_POST['update'])) {
        $new_fee = $_POST['fee'];

        if(empty($new_fee)) {
            array_push($errors, "New fee is required");
        } else {
            $update = "UPDATE `fee` SET `price` = :price";
            $data = [
                ':price' => $new_fee
            ];
            $stm = $conn->prepare($update);
            $result = $stm->execute($data);

            if($result == true) {
                ?>
                <meta http-equiv="refresh" content="0;url='admin.php?action=fee'"/>
                 <?php
            }
            
        }

    }

?>


<form action="admin.php?action=fee" method="POST">
    <section>
        <div class="container">
            <div class="row">
            <?php
                if(!empty($errors)) {
                    include_once('errors.php');
                }
            ?>
                <h3 class="title">Update fee</h3>
                <div class="row g-3" id="row_center">
                    <div class="col-auto">
                         Current fee <input type="text" name="fee" class="form-control" value="<?php echo $row['price'];?>" disabled  >
                    </div>
                    <div class="col-auto">
                        New fee <input type="text" name="fee" class="form-control">
                    </div>
                    <center>
                    <div class="">
                    <button type="submit" class="btn btn-primary" name="update" value= "Register" style="margin-top:15px">Update</button>     
                    </div></center>
            </div>
        </div>    
    </section>
</form>