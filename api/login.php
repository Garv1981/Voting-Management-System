<?php
session_start();
include("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

// Query to check the user's credentials
$check = mysqli_query($connect, "SELECT * FROM user WHERE mobile='$mobile' AND password='$password' AND role='$role'");

if (mysqli_num_rows($check) > 0) {
    // Fetch user data
    $userdata = mysqli_fetch_assoc($check);
    
    // Fetch groups for role 2 (assuming you want all users with role 2)
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    // Store user and group data in session
    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;

    // Redirect to dashboard
    header("Location: ../routes/dashboard.php");
    exit;
} else {
    // Invalid credentials
    echo '
    <script>
    alert("Invalid Credentials");
    window.location = "../";
    </script>
    ';
}
?>
