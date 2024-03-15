<?php
include "database.php";

$obj = new Database();
// $obj->insert('students', ['student_name' => 'Mahmudullah', 'age' => 17, 'city' => 'Dhaka']);
// echo "Insert result is: ";
// print_r($obj->getResult());

// $obj->update('students', ['student_name' => 'Mahmud', 'age' => 17, 'city' => 'Dhaka'], 'id = "4"');
// echo "Update result is: ";
// print_r($obj->getResult());

// $obj->delete('students', 'id = "3"');
// echo "Delete result is: ";
// print_r($obj->getResult());

$obj->select('students');
echo "Select result is: ";
print_r($obj->getResult());
