
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/ico" href="assets/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Magic Exports Admin</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="assets/css-admin/material-dashboard.css" rel="stylesheet" />
</head>
<?php
session_start();
$error='';

if(isset($_POST['login'])){

include('../dbs/connect.php');

$username=$_POST['username'];
$password=$_POST['password']; 
$sql="SELECT username, password, role, auth
    FROM admin 
    WHERE username='$username' AND password='$password' 
    UNION 
    SELECT username, password, role, auth
    FROM teammember 
    WHERE username='$username' AND password='$password'";
$results=$connect->query($sql);
$final=$results->fetch_assoc();

if($final>0) {
$_SESSION['username']=$final['username'];
$_SESSION['password']=$final['password'];
$_SESSION['auth']=$final['auth'];
}else{
  $error='Please enter correct login details.';
}
}
?>

<body>
  <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-profile" >
                    <div class="card-body">
                        <img style="height: 80px; width: 80px;" src="/favicon.ico"/>
                        <h3>Admin Login</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-profile" >
                    <div class="card-body">
                        <form action="/auth/login" method="POST">
                        <h6 class="card-category text-gray" for="username">Username</h6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <h6 class="card-category text-gray" for="password">Password</h6>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button class="btn btn-round btn-primary" type="submit"><i class="material-icons">login</i> Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="plugins/nav.js"></script> -->
    <script src="assets/js-admin/core/jquery.min.js"></script>
    <script src="assets/js-admin/core/popper.min.js"></script>
    <script src="assets/js-admin/core/bootstrap-material-design.min.js"></script>
    <script src="assets/js-admin/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/js-admin/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
</body>

</html>