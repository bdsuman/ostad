<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Assignment Module - 8</title>
</head>

<body>
<div class="container">
        <div class="card mt-5">
            <div class="card-header">
                User Dashboard
            </div>
            <div class="card-body">
<?php
if(!isset($_COOKIE['firstname']))
{
    header("location:assignment_8th.php");
}

 echo <<<result
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Welcome!!</strong> {$_COOKIE['firstname']}
            
        </div>
        <a href="welcome.php?logout=true" class="btn btn-info" >Logout</a>
    result;
if(isset($_GET['logout']) && $_GET['logout']==true){
    unset($_COOKIE['firstname']);
    setcookie('firstname', ''); 
    header("location:assignment_8th.php");
}
?>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>