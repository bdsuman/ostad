<?php
date_default_timezone_set('Asia/Dhaka');
$error_msg = array();
if (isset($_POST['submit'])) {

    $fname = htmlspecialchars(strip_tags($_POST['fname']));
    $lname = htmlspecialchars(strip_tags($_POST['lname']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $password = htmlspecialchars(strip_tags($_POST['password']));
    $confirm_password = htmlspecialchars(strip_tags($_POST['confirm_password']));

    if (empty($fname)) {
        $error_msg[]='First Name is Required';
    }

    if (empty($lname)) {
        $error_msg[]='First Name is Required';
    }

    if (!empty($email)) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_msg[]='Invalid email address formatting!';
        }
    }else{
        $error_msg[]='Email is Required';
    }

    if (empty($password)) {
        $error_msg[]='Password is Required';
    }else if(empty($confirm_password)){
        $error_msg[]='Confirm Password is Required';
    }else if($password!=$confirm_password){
        $error_msg[]='Confirm Password Missmatch';
    }
    
    
    /**
     * Save register user Data in CSV File
     */

    if(count($error_msg)==0){
        $csv_file_name ='register_users.csv';
    $data = array( $fname,$lname,$email,$password);
    if(!file_exists($csv_file_name)){
        fopen( $csv_file_name, 'w' );
    }

    $file = fopen( $csv_file_name, 'a' );

    if ( fputcsv( $file, $data ) === false ) {
        die( 'Error writing to file.' );
    }

    fclose($file);
     //set cookie
          $success_msg = ' Successfully Save.';
    }
       
}
?>
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
                Assignment Module 8
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title" style="border-bottom: 1px solid #bfbfbf;">User Registration Form</h5>
                        <?php
                        if (count($error_msg)>0) {

                            foreach($error_msg as $msg){
                                echo <<<alert_error
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Caution!!</strong> {$msg}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    alert_error;
                            }
                           
                        }

                        if (isset($success_msg)) {
                            echo <<<alert_succes
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Congratulations!!</strong> {$success_msg}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    alert_succes;
                        }
                        ?>
                        <form action="" method="POST" >
                            <div class="mb-3">
                                <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="Write your first name here.">
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Write your last name here.">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Write your email here.">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Write your password here.">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Write again password here.">
                            </div>
                            
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-6" style="border-left: 3px solid black;">
                    <?php
                         $login_error_msg = array();
                        if(isset($_POST['loginsubmit'])){
                            $email = htmlspecialchars(strip_tags($_POST['loginemail']));
                            $password = htmlspecialchars(strip_tags($_POST['loginpassword']));
                            if (!empty($email)) {
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $login_error_msg[]='Invalid email address formatting!';
                                }
                            }else{
                                $login_error_msg[]='Email is Required';
                            }
                        
                            if (empty($password)) {
                                $login_error_msg[]='Password is Required';
                            }
                                              
                            if (count($login_error_msg)==0) {
                                unset($_COOKIE['firstname']);
                                setcookie('firstname', '', time() - 3600, '/'); 
                                $csv_file ='register_users.csv';
                                $user_found = false;
                                if (($handle = fopen($csv_file, "r")) !== FALSE) {
                                        while ($data = fgetcsv($handle, 1000, ",")) {
                                            if( ($email==$data[2]) && ($password==$data[3])){
                                                $user_found =true;
                                                setcookie('firstname',$data[0]);
                                                header("location:welcome.php");
                                            }
                                        }
                                    
                                    fclose($handle);
                                }

                                if(!$user_found){
                                    $login_error_msg[]='Password or Email Does Not Match Record.';
                                }
                            }

                        }
                        ?>
                        <h5 class="card-title" style="border-bottom: 1px solid #bfbfbf;">User Login Form</h5>
                        <?php
                        if (count($login_error_msg)>0) {

                            foreach($login_error_msg as $loginmsg){
                                echo <<<alert_error
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Caution!!</strong> {$loginmsg}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    alert_error;
                            }
                           
                        }
                        ?>
                        <form action="" method="POST" >
                            <div class="mb-3">
                                <label for="loginemail" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="loginemail" name="loginemail" placeholder="Write your email here.">
                            </div>
                            <div class="mb-3">
                                <label for="loginpassword" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="loginpassword" name="loginpassword" placeholder="Write your password here.">
                            </div>
        
                            <button type="submit" name="loginsubmit" class="btn btn-success">Login</button>
                        </form>
                           <hr>
                       
                             
                             
                    </div>
                </div>

            </div>
            <div class="card-footer text-muted">
                Submited by: Suman Sen
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>