<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 12px 0 6px 0;
}

img.avatar {
  width: 20%;
  border-radius: 30%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
<title>STATE PROJECT INFORMATION SYSTEM</title>
</head>
<body>
<button class="btn btn-default" style="float:right">
  <a href="#" class="btn btn-lg btn-primary">User Guide</a>
</button>
<h2 align="center" >ADMIN LOGIN PANEL</h2>

<form action="Login/officer_login" method="post">
  <div class="imgcontainer">
    <img src="<?php echo base_url('assests/css/loGO.png'); ?>" alt="Avatar" class="avatar">
  </div>
  <div>
  <?php if($error = $this->session->flashdata('login_failed')): ?>
    <div class="alert alert-dismissible alert-danger">
    
        <div class="alert alert-dismissible alert-danger">
          <?= $error ?>
        
    </div></div>
  <?php endif; ?>

        <div class="container">
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" required>

          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>
              
          <button type="submit">Login</button>
        </div>
  
  </div>
</form>
<br><br><br><br><br><br><br><br><br>
<font color="blue">
  <h4 align="right" style="margin-top: 10px;">This Web Application is developed & designed by,</br></br>Dept. of IT & C, Govt of A.P</h4>
</font>
</body>
</html>