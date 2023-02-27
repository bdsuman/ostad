<?php
class Person
{

    private $name;
    private $email;

    function __construct($name = '', $email = '')
    {
        $this->set_name($name);
        $this->set_email($email);
    }

    public function set_name($name)
    {
        $this->name = $name;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_email($email)
    {
        $this->email = $email;
    }

    public function get_email()
    {
        return $this->email;
    }



    public function person_info()
    {
        return 'Name : ' . $this->get_name() . '<br>Email: ' . $this->get_email();
    }
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    if (!empty($name) && !empty($email)) {

        $person_obj = new Person();
        $person_obj->set_name($name);
        $person_obj->set_email($email);
        $result_msg = $person_obj->person_info();
        $success_msg = ' Successfully Save.';
    } else {
        $error_msg = ' Name & Email field required.';
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

    <title>Assignment Module - 5</title>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                Assignment Module 5
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title" style="border-bottom: 1px solid #bfbfbf;">Task 1: HTML Basics</h5>
                        <?php
                        // $error ='ok';
                        if (isset($error_msg)) {
                            echo <<<alert_error
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Caution!!</strong> {$error_msg}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                alert_error;
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
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Write your name here.">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Write your email here.">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-6" style="border-left: 3px solid black;">
                        <h5 class="card-title" style="border-bottom: 1px solid #bfbfbf;">Show Result</h5>
                        <?php
                        if (isset($result_msg)) {
                            echo <<<result
                                        <div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">Person Information :</h4>
                                            <p>{$result_msg}</p>
                                            <hr>
                                            <p class="mb-0">Task 2: Basic OOP in PHP & Task 3: Superglobal Variables in PHP</p>
                                        </div>
                                    result;
                        }
                        ?>
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