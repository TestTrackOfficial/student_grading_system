<?php

use Canete\Gs\Models\StudentModel;

require 'vendor/autoload.php';

$student = new StudentModel(1, 'John Doe', 'Computer Science', 3);
$student->create();