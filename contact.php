<?php
//$form[''] is used to communicate with the value of each field
//$error[''] is used to display error message for necessary fields


//email variables
$to = 'example@example.com, backup@example.com';
$subject = "Somebody submitted a form.";

//form variables
$valid_form = TRUE;
$redirect="success.php";

$form_elements = array('name', 'phone', 'fax', 'email', 'comments');
$required_elements = array('name', 'phone', 'email');

//remove "variable not found" error messages
foreach ($required_elements as $required) {
    $error[$required] = "";
}

//Checks if form has been posted, then do all these actions:
if (isset($_POST['submit'])) {

    //Preserve what the user typed in
    foreach ($form_elements as $element) {
    //htmlspecialchars - makes sure there are no "invalid characters" in the input
    $form[$element]  = htmlspecialchars($_POST[$element]);
  }

  //Check if the phone is of valid format
  if (!preg_match('/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]\d{2}-?\d{4}$/', $form['phone'])) {
    $error['phone'] = "<label class='error'>Please enter a valid phone number.</label>";
    $valid_form = FALSE;
  }

  //Check if email is the valid format
  if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
    $error["email"] = "<label class='error'>Please enter a valid email.</label>";
    $valid_form = FALSE;
  }


  //Check if required fields are empty
  foreach ($required_elements as $required) {
    if ($form["$required"] == "") {
      $error["$required"] = "<label class='error'>The $required field is required.</label>";
      $valid_form = FALSE;
    }
  }

  //Check for SPAM, before submitting
  foreach ($form_elements as $element) {
    contains_bad_str($form[$element]);
    contains_newlines($form[$element]);
  }


  //Check if form has been submitted successfuly
  if ($valid_form) {
    //create message
    $message = "Name" . $form ['name'] . "\n";
    $message .= "Email" . $form ['email'] . "\n";
    $message .= "Phone" . $form ['phone'] . "\n";
    $message .= "Fax" . $form ['fax'] . "\n";
    $message .= "Comment" . $form ['comments'] . "\n";

    $headers = "From: www.example.com <admin@example.com> /r/n";
    $headers = "CC: boss@example.com /r/n";
    $headers .= "X-Sender: <admin@example.com> /r/n";
    $headers .= "X-Mailer: PHP/" . phpversion . "/r/n";
    $headers .= "Reply-To: " . $form['email'];

    //send mail
    mail($to, $subject, $message, $headers);


    //redirect
    header("Location: $redirect");
  }
  else {

    include "form.php";
  }
}


//If the form hasn't been posted, set all values to none.
else {
  foreach ($form_elements as $element) {
    $form[$element] = "";
  }
  //display form
  include "form.php";
}


//FUNCTIONS to check for bad strings and new lines:
function contains_bad_str($str_to_test) {
  $bad_strings = array(
                "content-type:",
                "mime-version:",
                'multipart/mixed',
		            "Content-Transfer-Encoding:",
                "bcc:",
            		"cc:",
            		"to:"
  );

  foreach($bad_strings as $bad_string) {
    if(preg_match("#" . $bad_string . "#", strtolower($str_to_test))) {
      echo "$bad_string found. Suspected injection attempt - mail not being sent.";
      exit;
    }
  }
}

function contains_newlines($str_to_test) {
   if(preg_match("/(%0A|%0D|n+|r+)/i", $str_to_test) != 0) {
     echo "newline found in $str_to_test. Suspected injection attempt - mail not being sent.";
     exit;
   }
}

?>
