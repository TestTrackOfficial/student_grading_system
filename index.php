<?php

use Canete\Gs\Models\StudentModel;

require 'vendor/autoload.php';


$student = new StudentModel;

$listOfStudents = $student->read();

print_r($listOfStudents);












if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['create'])){
        // add new record
        $student = new StudentModel();
        $student->id = htmlspecialchars($_POST['id']);
        $student->name = htmlspecialchars($_POST['name']);
        $student->course = htmlspecialchars($_POST['course']);
        $student->year_level = htmlspecialchars($_POST['year_level']);
        $student->section = htmlspecialchars($_POST['section']);
        $student->create();
    }elseif (isset($_POST['update'])) {
        // update record
        $student = new StudentModel();
        $student->id = htmlspecialchars($_POST['id']);
        $student->name = htmlspecialchars($_POST['name']);
        $student->course = htmlspecialchars($_POST['course']);
        $student->year_level = htmlspecialchars($_POST['year_level']);
        $student->section = htmlspecialchars($_POST['section']);
        $student->update($_POST['id']);
    }elseif (isset($_POST['delete'])) { 
        // delete record
        $student = new StudentModel();
        $student->delete($_POST['id']);
    }
}

if(isset($_GET['id'])){
    // get student data
    $student = new StudentModel;
    $studentData = $student->find($_GET['id']);
}

$student = new StudentModel();
$listsOfStudents = $student->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP APP</title>
    <link rel="stylesheet" href="public/bootstrap.min.css">
</head>
<body>
    <div class="container"> 
    <h1 class="mb-3">Student Management System</h1>
    <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
    <form action="index.php" method="POST" class="mb-3">
        <h3 class="mb-3">Add New Student</h3>
        <div class="mb-3">
            <label  for="id">Student ID : </label>
            <input class="form-control" type="number" name="id" value="<?php echo $studentData['id'] ?? ''; ?>" id="id">
        </div>
        <div class="mb-3">
            <label  for="name">Name : </label>
            <input class="form-control" type="text" name="name" value="<?php echo $studentData['name'] ?? ''; ?>" id="name">
        </div>
        <div class="mb-3">
            <label  for="course">Course : </label>
            <input class="form-control" type="text" name="course" value="<?php echo $studentData['course'] ?? ''; ?>" id="course">
        </div>
        <div class="mb-3">
            <label  for="year_level">Year Level : </label>
            <input class="form-control" type="number" name="year_level" value="<?php echo $studentData['year_level'] ?? ''; ?>" id="year_level">
        </div>
        <div class="mb-3">
            <label  for="section">Section : </label>
            <input class="form-control" type="text" name="section" value="<?php echo $studentData['section'] ?? ''; ?>" id="section">
        </div> 
        <a class="btn btn-dark" href="index.php">Reset</a>
        <?php if(isset($_GET['id'])): ?>
            <button class="btn btn-success" type="submit" name="update">Update</button>
            <button class="btn btn-danger" type="submit" name="delete">Delete</button>
        <?php else : ?>
            
            <button class="btn btn-primary" type="submit" name="create">Create</button>
        <?php endif ?>
    </form>
    <h3>List of Students</h3>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Year Level</th>
            <th>Section</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach ($listsOfStudents as $key => $student) : ?>
                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['course']; ?></td>
                    <td><?php echo $student['year_level']; ?></td>
                    <td><?php echo $student['section']; ?></td>
                    <td>
                        <a type="button" href="index.php?id=<?php echo $student['id']; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </div>
</body>
</html>