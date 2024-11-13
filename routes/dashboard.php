<?php
session_start();

if (!isset($_SESSION['userdata'])) {
    header("Location: ../");
    exit;
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if ($userdata['status'] == 0) {
    $status = '<b style="color: red">Not Voted</b>';
} else {
    $status = '<b style="color: green">Voted</b>';
}
?>
<html>
    <head>
        <title>Online Voting System - Dashboard</title>
        <link rel="stylesheet" href="../css/style3.css">
    </head>
    <body>
        <div class="ansh">
            <a href="../"><button id="one">Back</button></a>
            <a href="../api/logout.php"><button id="two">Logout</button></a>
        </div>
        
        <h1>Online Voting System</h1>
        <hr>
        <div class="container">
            <div id="Profile">
                <img src="../uploads/<?php echo $userdata['photo']; ?>" height="100px" width="150px"><br><br>
                <b>Name: </b><?php echo $userdata['name']; ?><br><br>
                <b>Mobile: </b><?php echo $userdata['mobile']; ?><br><br>
                <b>Address: </b><?php echo $userdata['address']; ?><br><br>
                <b>Status: </b><?php echo $status; ?><br><br>
            </div>
            <div id="Group">
                <?php
                if ($groupsdata) {
                    foreach ($groupsdata as $group) {
                        ?>
                        <div>
                            <img style="float: right" src="../uploads/<?php echo $group['photo']; ?>" height="100px" width="150px">
                            <b>Group Name: </b><?php echo $group['name']; ?><br><br>
                            <b>Votes: </b><?php echo $group['votes']; ?><br><br>
                            <form action="../api/vote.php" method="POST">
                                <input type="hidden" name="gvotes" value="<?php echo $group['votes']; ?>">
                                <input type="hidden" name="gid" value="<?php echo $group['id']; ?>">
                                <?php
                                if ($userdata['status'] == 0) {
                                    ?>
                                    <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                    <?php
                                } else {
                                    ?>
                                    <button disabled type="button" id="voted">Voted</button>
                                    <?php
                                }
                                ?>
                            </form><br><br>
                        </div>
                        <hr class="nto">
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
