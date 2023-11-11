<!DOCTYPE html>
<html lang="en">
<?php
require_once("connection.php");
$connection = new Connection();

$db = $connection->connect();
if(isset($_GET['id'])){
    $id = $_GET["id"];
    $query = "DELETE FROM `ccs_630_final_project`.`2022_student` WHERE (`id` = ?);";    
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
$query = "SELECT id,email, CONCAT(first_name, ' ', middle_name, ' ' , last_name) as full_name, if(gender=0,'Male','Female') as gender,address FROM ccs_630_final_project.2022_student;";
$result = $db->query($query);




?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.7/datatables.min.css" rel="stylesheet">



</head>

<body>
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
                        <a class="nav-link " aria-current="page" href="index.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="view.php">View Student</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="container my-3">
        <div class="card p-3">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['id'] ?>
                                </td>
                                <td>
                                    <?php echo $row['email'] ?>
                                </td>
                                <td>
                                    <?php echo $row['full_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['gender'] ?>
                                </td>
                                <td>
                                    <?php echo $row['address'] ?>
                                </td>
                                <td class="d-flex align-items-center justify-content-center "><a type="button" href="index.php?id=<?php echo $row['id'] ?>"
                                        class="btn btn-info mx-1">Edit</a><a type="button" href="view.php?id=<?php echo $row['id'] ?>"
                                        class="btn btn-danger mx-1">Delete</a></td>
                            </tr>
                        <?php }
                    } ?>


                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.7/datatables.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
</body>

</html>