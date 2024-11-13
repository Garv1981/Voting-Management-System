<?php
 include("connect.php");
 $name = $_POST['name'];
 $mobile = $_POST['mobile'];
 $password = $_POST['pass'];
 $address = $_POST['address'];
 $cpassword = $_POST['cpass'];
 $image = $_FILES['photo']['name'];
 $tmp_name = $_FILES['photo']['tmp_name'];
 $role = $_POST['role'];

 if($password == $cpassword){
        move_uploaded_file($tmp_name,"../uploads/$image");

        $insert = mysqli_query($connect, "INSERT INTO user (name, mobile, password,address, photo, role, status, votes) VALUES ('$name', '$mobile', '$password', '$address','$image', '$role', 'active', 0)");

        if ($insert) {
            echo '
            <script>
            alert("Registration successful!");
            window.location = "../";
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Registration failed. Please try again.");
            window.location = "../routes/register.html";
            </script>
            ';
        }
 }
 else{
    echo '
    <script>
    alert("Password and Confirm Password does not match");
    window.location = "../routes/register.html";
    </script>
    ';
 }
?>