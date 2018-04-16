<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login - Spa Management System</title>
    <link rel="stylesheet" href="../assets/frontend-assets/css/style.css">
  </head>
  <body>
    <div class="login">
    	<h1>LOGIN</h1>
        <?php echo form_open("auth/login");?>
        	<input type="text" name="identity" placeholder="Username" required="required" />
          <input type="password" name="password" placeholder="Password" required="required" />
          <div id="infoMessage"><?php echo $message;?></div>
          <button type="submit" class="btn btn-primary btn-block btn-large">SIGN IN</button>
        <?php echo form_close(); ?>
    </div>
  </body>
</html>
