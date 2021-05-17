<?php

//variables
$error_open = "<label class='error'>";
$error_close = "</label>";
$valid_form = true;
$redirect="success.php";

$form_elements = array('name', 'phone', 'fax', 'email', 'comments');
$required_elements = array('name', 'phone', 'email');

//remove "variable not found" error messages
foreach ($required_elements as $required) {
  {
    $error[$required] = "";
  }
}

//Checks if form has been submitted
if (isset($_POST['submit'])) {
  //It has -> process form

} else {
  //It hasn't -> set value of every element to none
  foreach ($form_elements as $element) {
    $form[$element] = "";
  }

  //display form
  include "form.php";

}







?>
