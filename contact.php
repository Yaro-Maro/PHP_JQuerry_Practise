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
    $error[$required] = "";
}

//Checks if form has been submitted
if (isset($_POST['submit'])) {
  //It has -> process form
  //Put the each value posted, into each field, to preserve what the user typed in
  foreach ($form_elements as $element) {
    //htmlspecialchars - makes sure there are no "invalid characters" in the input
    $form[$element] = htmlspecialchars($_POST[$element]);
  }

  //check if required fields are empty, then set valid_form to false
  foreach ($required_elements as $required) {
    if ($required === "") {
      $error[$required] = "<label class='error'>$required is a required field.</label>";
    }
  }

} else {
  //It hasn't -> set value of every element to none
  foreach ($form_elements as $element) {
    $form[$element] = "";
  }

  //display form
  include "form.php";

}







?>
