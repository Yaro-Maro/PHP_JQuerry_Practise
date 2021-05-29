<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Form validation</title>
    <script type="text/javascript" src="vvjquery.js"></script>
    <script type="text/javascript" src="vvjquery.validate.js"></script>
    <script type="text/javascript" src="vvadditional-methods.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#form").validate({
          rules: {
            phone: {
              phoneUS: true
            }
          }
        });
      });
    </script>


    <style media="screen">
      body {font-family: Arial; font-size: 12px;}
      fieldset {border: 0;}
      label {display: block; width: 180px; float: left; clear: both; margin-top: 10px;}
      label em {display: block; float: right; padding-right: 8px; color: red;}
      textarea, input {float: left; width: 220px; padding: 2px;}
      textarea {height: 180px;}
      #submit {margin-left: 180px; clear: both; width: 100px;}
      label.error {float: left; color: red; clear: none; width: 200px; padding-left: 10px; font-size: 11px;}
      .required_msg {padding-left: 180px; clear: both; float: left; color: red;}
    </style>
  </head>

  <body>
    <form action="" method="post" id="form">
      <fieldset>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="required" value="<?php echo $form['name'];?>">
        <?php echo $error['name']; ?>

        <label for="phone">Phone (212-999-0983): </label>
        <input type="text" name="phone" id="phone" class="required" value="<?php echo $form['phone'];?>">
        <?php echo $error['phone']; ?>

        <label for="fax">Fax:</label>
        <input type="text" name="fax" id="fax" value="<?php echo $form['fax'];?>">

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" class="required email" value="<?php echo $form['email'];?>">
        <?php echo $error['email']; ?>

        <label for="comments">Comments:</label>
        <textarea type="text" name="comments" id="comments"><?php echo $form['comments'];?></textarea>

        <p class="required_msg">* required fields</p>

        <input type="submit" name="submit" id="submit"><br>
      </fieldset>
    </form>


  </body>
</html>
