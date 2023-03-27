<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
$error_msg = array();
if (isset($_POST['submit'])) {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $password = htmlspecialchars(strip_tags($_POST['password']));

    if (empty($name)) {
        $error_msg[]='Name is Required';
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
    }

    if (empty($_FILES["picture"]["name"])) {
        $error_msg[]='Picture is Required';
    }
    /**
     * Image Upload
     */
    $allowedExts = array("jpg","jpeg","png");
    //$extension = end((explode(".", )));
    $extension = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));
    $id = date("d-m-Y_H-i-s").'_'.uniqid();
    if (in_array($extension, $allowedExts))
      {
          $upload_dir = "uploads/";

        if(file_exists($upload_dir.$id.'.'.$extension)){
                unlink($upload_dir.$id.'.'.$extension); 
        }
            $filename = $id.'.'.strtolower($extension);
            $filepath=$upload_dir.$filename;

            $upload_dir = 'uploads/';
             
              if (!move_uploaded_file( $_FILES["picture"]['tmp_name'], $filepath ) ) {
                $error_msg[]= 'Error uploading file.';
              }
            
        }else{
            $error_msg[] = "Error: Image File Type";
        }
    /**
     * Save user Data in CSV File
     */

    if(count($error_msg)==0){
        $csv_file_name ='users.csv';
    $data = array( $name, $email,$password, $filename );
    if(!file_exists($csv_file_name)){
        fopen( '$csv_file_name', 'w' );
    }

    $file = fopen( $csv_file_name, 'a' );

    if ( fputcsv( $file, $data ) === false ) {
        die( 'Error writing to file.' );
    }

    fclose($file);
     //set cookie
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        setcookie('username', $name, time() + (86400 * 30), "/",$domain,true,true);
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

    <title>Assignment Module - 6</title>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                Assignment Module 6
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
                        <form action="" method="POST" enctype="multipart/form-data" >
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Write your name here.">
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
                                <label for="picture" class="form-label">Profile Picture <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg" >
                                <span class="text-danger">*&nbsp;<small><sub>Only JPG,JPEG,PNG file allowed</sub></small></span>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-6" style="border-left: 3px solid black;">
                        <h5 class="card-title" style="border-bottom: 1px solid #bfbfbf;">User Registration Information </h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Serial</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                        <?php
                          $csv_file ='users.csv';
                          $i = 1;
                          if (($handle = fopen($csv_file, "r")) !== FALSE) {
                           
                         
                            while ($data = fgetcsv($handle, 1000, ",")) {
                                    $serial = $i++;
                                    echo <<<result
                                                <tr>
                                                    <th scope="row">{$serial}</th>
                                                    <td><img  class="img-responsive" alt="Profile Image" src='uploads/{$data[3]}' width='50' height='60'></td>
                                                    <td>{$data[0]}</td>
                                                    <td>{$data[1]}</td>
                                                    <td>{$data[2]}</td>
                                                </tr>
                                            result;
                                }
                                
                                fclose($handle);
                        }
                        ?>
                             
                             </tbody>
                        </table>
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