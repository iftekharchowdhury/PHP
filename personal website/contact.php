<?php
  //Message Vars
  $msg = '';
  $msgClass = '';
  // Check for Submit
  if (filter_has_var(INPUT_POST, 'submit')){
    //get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Check required fields
    if (!empty($email) && !empty($name) && !empty($message)){
      //passed
      // check email
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $msg = "Please use a valid email";
        $msgClass = "alert-danger";
      } else {
        //passed
        // this things needs to check
        $toEmail = 'support@traversymedia.com';
        $subject = 'Contact Request From '.$name;
        $body = '<h2>Contact Request</h2>
              <h4>Name</h4><p>'.$name.'</p>
              <h4>Email</h4><p>'.$email.'</p>
              <h4>Message</h4><p>'.$message.'</p>';

        // Email Headers
        $headers = "MIME-Version: 1.0" ."\r\n";
        $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "From: " .$name. "<".$email.">". "\r\n";

        if(mail($toEmail, $subject, $body, $headers)){
          $msg = 'Your email has been sent';
          $msgClass = 'alert-success';
        } else{
          // Failed
          $msg = 'Your email was not sent';
          $msgClass = 'alert-danger';
        }
      }
    }else{
      //Failed
      $msg = 'Please fill in all fields';
      $msgClass = 'alert-danger';
    }
  }
?>

<!DOCTYPE html>
<html>  
<head>
  <title>iftekharjoy</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" type="text/css" href="css/style.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    body{
      background-color: #ffbb99;
    }
  </style>
</head>
<body>
  <!-- nav start from here -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li class="active"><a href="home.html">HOME</a></li>
        <li class="active"><a href="profile.html">PROFILE</a></li>
        <li class="active" ><a href="skill.html">SKILL</a></li>
        <li class="active"><a href="tutorial.html">TUTORIAL</a></li>
        <li class="active"><a href="contact.html">CONTACT</a></li>
      </ul>      
    </div>
  </nav>
<!-- end here -->
  
<!--form start here  -->
<div class="container">

  <?php if($msg != ''):?>
    <div class="alert <?php echo $msgClass; ?>" >
      <?php echo $msg;?>  
    </div>
  <?php endif; ?>

  <h2>Contact Form</h2>
  <form class="form-horizontal" action= "<?php echo $_SERVER['PHP_SELF'];?>">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Name</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="text" placeholder="Enter Name" name="name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="<?php echo isset($_POST['email']) ? $email: ''; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="comment">Comment</label>
      <div class="col-sm-5">
        <textarea class="form-control" rows="4" id="comment"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary btn-lg"> Send</button>
      </div>
    </div>
  </form>
</div>
<!--form end here  -->
<!-- footer -->
<div class="footer navbar-fixed-bottom">
    <footer class="footer">
      <p style="font-size: 14px">&copy;2018 COPYRIGHT: IFTEKHAR JOY</p>
    </footer>  
</div>
<!-- footer end here -->
</body>
</html>
