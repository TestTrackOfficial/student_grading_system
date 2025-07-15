<?php

namespace Canete\Gs\Models;

use Canete\Gs\Core\Crud;
use Canete\Gs\Core\DataStore;

class StudentModel implements Crud {

  public int $id;
  public string $name;
  public string $course;
  public int $year_level;

  public function __construct(int $id, string $name, string $course, int $year_level)
  {
    $this->id = $id;
    $this->name = $name;
    $this->course = $course;
    $this->year_level = $year_level;
  }

  public function create(){
    // append student data to the datastore
    $dataStore = new DataStore('students.json');
    $students = $dataStore->getConnection();
    $students[] = [
      'id' => $this->id,
      'name' => $this->name,
      'course' => $this->course,
      'year_level' => $this->year_level
    ];
    // eliminate duplicate entries
    file_put_contents('students.json', json_encode($students, JSON_PRETTY_PRINT));
  }
  public function read(){
    
  }
  public function update(){
   
  }
  public function delete(){
    
  }
}