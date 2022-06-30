<?php

include 'config.php';

if (isset($_POST['submit'])) {
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $sex = mysqli_real_escape_string($conn, $_POST['sex']);
   $date = mysqli_real_escape_string($conn, $_POST['date']);
   $nubcall = mysqli_real_escape_string($conn, $_POST['nubcall']);
   $line = mysqli_real_escape_string($conn, $_POST['line']);
   $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $role = mysqli_real_escape_string($conn, $_POST['role']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   $select = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' OR username = '$username' AND password = '$password'") or die('query failed');

   if (mysqli_num_rows($select) > 0) {
      $message[] = 'user already exist';
   } else {
      if ($password != $cpass) {
         $message[] = 'confirm password not matched!';
      } elseif ($image_size > 2000000) {
         $message[] = 'image size is too large!';
      } else {
         $insert = mysqli_query(
            $conn,
            "INSERT INTO user
         -- (username,email, password, image,firstname,lastname,role,sex,date,nubcall,line,facebook,address) 
         VALUES
         ('',
            '$email',
            '$username',
            '$password',
            '$firstname',
            '$lastname',
            '$role',
            '$sex',
            '$date',
            '$nubcall',
            '$line',
            '$facebook',
            '$address',
            current_timestamp,
            '$image'
         )"
         )
            or die('query failed');

         if ($insert) {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         } else {
            $message[] = 'registeration failed!';
         }
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <div class="form-container">
      <form action="" method="post" enctype="multipart/form-data">
         <h3>register now</h3>
         <?php
         if (isset($message)) {
            foreach ($message as $message) {
               echo '<div class="message">' . $message . '</div>';
            }
         }
         ?>
         <input type="text" name="username" placeholder="enter username" class="box" required>
         <input type="email" name="email" placeholder="enter email" class="box" required>
         <input type="password" name="password" placeholder="enter password" class="box" required>
         <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
         <input type="text" name="firstname" placeholder="enter firstname" class="box" required>
         <input type="text" name="lastname" placeholder="enter lastname" class="box" required>
         <input type="text" name="role" placeholder="enter role" class="box" required>
         <input type="text" name="sex" placeholder="enter sex" class="box" required>
         <input type="date" name="date" placeholder="enter date" class="box" required>
         <input type="text" name="nubcall" placeholder="enter nubcall" class="box" required>
         <input type="text" name="line" placeholder="enter line" class="box" required>
         <input type="text" name="facebook" placeholder="enter facebook" class="box" required>
         <input type="text" name="address" placeholder="enter address" class="box" required>
         <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
         <input type="submit" name="submit" value="register now" class="btn">
         <p>already have an account? <a href="login.php">login now</a></p>
      </form>

   </div>

</body>

</html>