<?php
//$form[] is used to communicate with the value of each field
//$error[] is used to display error message for necessary fields

//variables
$valid_form = TRUE;
$redirect="success.php";

$form_elements = array('name', 'phone', 'fax', 'email', 'comments');
$required_elements = array('name', 'phone', 'email');

//remove "variable not found" error messages
foreach ($required_elements as $required) {
    $error[$required] = "";
}

//Checks if form has been posted
if (isset($_POST['submit'])) {

  //Preserve what the user typed in
    foreach ($form_elements as $element) {
    //htmlspecialchars - makes sure there are no "invalid characters" in the input
    $form[$element]  = htmlspecialchars($_POST[$element]);
  }

  //check if required fields are empty, then set valid_form to false
  foreach ($required_elements as $required) {
    if ($form["$required"] == "") {
      $error["$required"] = "<label class='error'>The $required field is required.</label>";
      $valid_form = FALSE;
    }
  }

  //Check if form has been submitted successfuly
  if ($valid_form) {
    header("Location: $redirect");
  }
  else {
    include "form.php";
  }
}



//If the form hasn't yet been submitted, set all values to none

else {
  foreach ($form_elements as $element) {
    $form[$element] = "";
  }
  //display form
  include "form.php";
}

?>
