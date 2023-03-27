<?php
$error_msg = array();
if (isset($_POST['submit'])) {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $age = htmlspecialchars(strip_tags($_POST['age']));
   
    if (empty($name)) {
        $error_msg[]='Name is Required';
    }

    if (empty($age)) {
        $error_msg[]='Age is Required';
    }

  
  
    /**
     * Save user Data in CSV File
     */

    if(count($error_msg)==0){
        $csv_file_name ='users_data.csv';
    $data = array( $name,  $age );
    if(!file_exists($csv_file_name)){
        fopen( $csv_file_name, 'w' );
    }

    $file = fopen( $csv_file_name, 'a' );

    if ( fputcsv( $file, $data ) === false ) {
        die( 'Error writing to file.' );
    }

    fclose($file);
 
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

    <title>Live Test 8 </title>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                Live Test 8
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title" style="border-bottom: 1px solid #bfbfbf;">Add User</h5>
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
                                <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="Write your age here.">
                            </div>
                           
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-6" style="border-left: 3px solid black;">
                        <h5 class="card-title" style="border-bottom: 1px solid #bfbfbf;">User Display </h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Age</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                        <?php
                          $csv_file ='users_data.csv';
                     
                          if (($handle = fopen($csv_file, "r")) !== FALSE) {

                            while ($data = fgetcsv($handle, 1000, ",")) {
                                   
                                    echo <<<result
                                                <tr>
                                                    <td>{$data[0]}</td>
                                                    <td>{$data[1]}</td>
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