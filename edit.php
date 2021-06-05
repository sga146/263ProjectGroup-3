<!DOCTYPE HTML>
<html>
<head>
    <title>Edit</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <?php require_once("config.php");
       require_once("delete.php");
       $result = $conn ->query("select * from vw_front_event order by event_id desc") or die($conn->error);
        if (isset($_SESSION['message'])):
       ?>
    <div class = 'alert alert-<?$_SESSION['mes_type']?>'>
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message'])
        ?>
    </div>
        <?php endif ?>
        <div class = "front_action content center">
            <table class ='table'>
                <thread>
                    <tr>
                        <th>event_name</th>
                        <th>machine_group</th>
                        <th>clusters</th>
                        <th>date</th>
                        <th>start_time</th>
                        <th>test_time</th>
                        <th>time_offset</th>
                        <th colspan="2"></th>
                    </tr>
                </thread>
                    <?php
                    while($row = $result-> fetch_assoc() ) ?>
                    <tr>
                        <td><?php echo  $row['event_name']; ?></td>
                        <td><?php echo  $row['machine_group']; ?></td>
                        <td><?php echo  $row['clusters']; ?></td>
                        <td><?php echo  $row['date']; ?></td>
                        <td><?php echo  $row['start_time']; ?></td>
                        <td><?php echo  $row['test_time']; ?></td>
                        <td><?php echo  $row['time_offset']; ?></td>
                        <a href="edit.php?edit=<?php echo $row['event_id']; ?>"
                            class="btn btn-info">Edit</a>
                        <a href="delete.php?delete=<?php echo $row['event_id']; ?>"
                            class="btn btn-danger">Delete</a>
                    </tr>
                    <?php endwhile;?>
            </table>

        </div>
            <div class="Edit">
                <form action="delete.php" method="POST">
                    <div class="form group">
                        <label>event name</label>
                        <input type="text" name="event_name" class= "form-control" value="<?php echo $event_name?>" placeholder="event_name">
                    </div>
                    <div class="form group">
                        <label>machine group</label>
                        <input type="text" name="machine_group" class= "form-control" value="<?php echo $machine_group?>" placeholder="machine_group">
                    </div>
                    <div class="form group">
                        <label>cluster name</label>
                        <input type="text" name="cluster" class= "form-control" value="<?php echo $cluster?>" placeholder="cluster">
                    </div>
                    <div class="form group">
                        <label>date</label>
                        <input type="text" name="date" class= "form-control" value="<?php echo $date?>" placeholder="date">
                    </div>
                    <div class="form group">
                        <label>time</label>
                        <input type="text" name="start_time" class= "form-control" value="<?php echo $start_time?>" placeholder="start_time">
                    </div>
                    <div class="form group">
                        <label>test_time</label>
                        <input type="text" name="test_time" class= "form-control" value="<?php echo $test_time?>" placeholder="test_time">
                    </div>
                    <div class="form group">
                        <label>time_offset</label>
                        <input type="text" name="time_offset" class= "form-control" value="<?php echo $time_offset?>" placeholder="time_offset">
                    </div>
                    <div class="form group">
                        <button type="submit" class="btn btn-info" name="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

