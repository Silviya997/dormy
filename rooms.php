<?php
$query = "SELECT * FROM rooms";
$statement = $conn->prepare($query);
$statement->execute();
?>

<form action="admin.php?action=rooms" method="post">
<section class="main_section">
    <div class="container">
        <h2 class="title">All rooms</h2>
<?php
while($res=$statement->fetch()) {
    $roomID = $res['id'];
    ?>              <div class="row">
                    <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Room Number</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td><?php echo $res['roomNo'];?></td>
                            <td> <?php echo $res['stateOfroom'];?></td>
                            <td><button type="button" name="EDIT" onclick="location.href='roomEdit.php?editRoomId=<?php echo $res['id'];?>'">Edit</button> </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <?php

}
?>
</div>
</section>
</form>
