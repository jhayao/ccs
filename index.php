<!DOCTYPE html>
<html lang="en">
<?php
require_once("connection.php");
$connection = new Connection();
$db = $connection->connect();
$edit = false;
if (isset($_GET["id"])) {
    $edit = true;
    $id = $_GET["id"];
    $query = "SELECT * FROM `ccs_630_final_project`.`2022_student` WHERE (`id` = ?);";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }else{
        echo "No record found.";
    }
}   

if (isset($_POST['add'])) {
    
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $query = "INSERT INTO `ccs_630_final_project`.`2022_student` (`email`, `first_name`, `last_name`, `middle_name`, `gender`, `address`) VALUES (?,?,?,?,?,?);";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssssis", $email, $first_name, $last_name, $middle_name, $gender, $address);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Insert operation was successful.";
        } else {
            echo "Insert operation failed.";
        }
    } else {
        echo "Error executing statement: " . $stmt->error;
    }
} else if (isset($_POST["edit"])) {
    $id = $_POST["id"];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $query = "UPDATE `ccs_630_final_project`.`2022_student` SET `email` = ?, `first_name` = ?, `last_name` = ?, `middle_name` = ?, `gender` = ?, `address` = ? WHERE (`id` = ?);";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssssisi", $email, $first_name, $last_name, $middle_name, $gender, $address,$id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Update operation was successful.";
        } else {
            echo "Update operation failed.";
        }
    } else {
        echo "Error executing statement: " . $stmt->error;
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- <nav class="navbar bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://getbootstrap.com/docs/5.2/assets/brand/bootstrap-logo.svg" alt="Bootstrap" width="30"
                    height="24">
            </a>
        </div>
    </nav> -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://getbootstrap.com/docs/5.2/assets/brand/bootstrap-logo.svg" alt="Bootstrap" width="30"
                    height="24">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">View Student</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="container my-3">
        <div class="card p-3">
            <form class="row g-3" method="post" action="index.php">
                <?php 
                    if ($edit)
                        echo "<input type='hidden' name='id' value='$id'>";
                ?>
                <div class="col-md-4">
                    <label for="validationDefault01" class="form-label">First name</label>
                    <input type="text" class="form-control" name="first_name" id="validationDefault01"
                        placeholder="First Name" value = "<?php if ($edit)  echo $row['first_name'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="mname" class="form-label">Middle name</label>
                    <input type="text" class="form-control" value = "<?php if ($edit)  echo $row['middle_name'] ?>"  name="middle_name" id="mname" placeholder="Middle Name"
                        required>
                </div>
                <div class="col-md-4">
                    <label for="validationDefault02" class="form-label">Last name</label>
                    <input type="text" class="form-control" value = "<?php if ($edit)  echo $row['last_name'] ?>"  name="last_name" id="validationDefault02"
                        placeholder="Last Name" required>
                </div>
                <div class="col-md-4">
                    <label for="validationDefault02" class="form-label">Email</label>
                    <input type="email" class="form-control" value = "<?php if ($edit)  echo $row['email'] ?>"  name="email" id="validationDefault02"
                        placeholder="Email Address" required>
                </div>
                <div class="col-md-4">
                    <label for="validationDefault04" class="form-label">Gender</label>
                    <select class="form-select" name="gender" id="validationDefault04" required>
                        <option selected disabled value="">Choose...</option>
                        <option <?php if ($edit) echo $row['gender'] == 0 ? "selected" : ""?>  value="0">Male</option>
                        <option <?php if ($edit) echo $row['gender'] == 1 ? "selected" : ""?> value="1">Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="validationDefault03" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="validationDefault03" value = "<?php if ($edit)  echo $row['address'] ?>"  required>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" name="<?php echo $edit ? "edit" : "add" ?>" type="submit"><?php echo $edit ? "Update" : "Save" ?></button>
                </div>
            </form>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>