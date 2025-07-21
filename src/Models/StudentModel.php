<?php

namespace Canete\Gs\Models;
use Canete\Gs\Core\Crud;
use Canete\Gs\Core\Database;

class StudentModel extends Database implements Crud {

  public int $id;
  public string $name;
  public string $course;
  public int $year_level;
  public string $section;

  public function __construct()
  {
    parent::__construct();
    $this->id = 0;
    $this->name = "";
    $this->course = "";
    $this->year_level = 0;
    $this->section = "";
  }
  public function find($id){
    $student = $this->conn->query("SELECT * FROM students WHERE id = $id LIMIT 1"); 
    $data = $student->fetch_assoc();
    $this->id = $data['id'] ?? 0;
    $this->name = $data['name'] ?? "";
    $this->course = $data['course'] ?? "";
    $this->year_level = $data['year_level'] ?? 0;
    $this->section = $data['section'] ?? ""; 
    return $data ?? []; 
  }

  public function create(){
  
   
  }
  public function read(){
    try {
      $sql = "SELECT * FROM students";
      $results = $this->conn->query($sql);
      return $results->fetch_all(MYSQLI_ASSOC);    
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }
  public function update($id){

    $stmt = $this->conn->prepare("UPDATE `students` SET `id`='$this->id',`name`='$this->name',`course`='$this->course',`year_level`='$this->year_level',`section`='$this->section' WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();  
    if($stmt->affected_rows > 0){
      $_SESSION['message'] = "Student Updated Successfully!";
      // echo "\nStudent Updated Successfully!\n";
    }else{
      $_SESSION['message'] = "No Student Updated!";
      // echo "\nNo Student Updated!\n";
    }
   
  }
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    if($stmt->affected_rows > 0){
      $_SESSION['message'] = "Student Deleted Successfully!";
      // echo "\nStudent Deleted Successfully!\n";
    }else{
      $_SESSION['message'] = "No Student Deleted!";
      // echo "\nNo Student Deleted!\n";
    }
  }
}