<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script src="bootstrap/js/jquery-1.8.3.js"></script>
<script src="bootstrap/js/bootstrap-collapse.js"></script> 
<script src="bootstrap/js/bootstrap-dropdown.js"></script> 
<script src="bootstrap/js/bootstrap-modal.js"></script>
<script src="login/js/Usuario.js"></script> 
<style>
body {
	padding-top: 150px;
}
</style>

<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}
.form-signin {
	max-width: 300px;
	padding: 19px 29px 29px;
	margin: 0 auto 20px;
	background-color: #fff;
	border: 1px solid #e5e5e5;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	box-shadow: 0 1px 2px rgba(0,0,0,.05);
}
input[type="text"], input[type="password"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 15px;
	padding: 7px 9px;
}
</style>
<title>login</title>
</head>

<body>

<!--Inicio de MENU este clase deja fijo el menu no importa el tamaño-->
    <div class="navbar navbar-inverse navbar-fixed-top">
   <!--DIV -->
<div style="height:100px; background-color: #999; background-image:url(img/baner2.png)">
  
   </div>
    



<div class="container">
	
            <form action="" method="post" class="form-signin">
            <h1>Iniciar Sesión.</h1>
            <input type="text" name="user" id="user" placeholder="Usuario." class="input-block-level" />
						<input type="password" name="pass" id="pass" placeholder="Contraseña." class="input-block-level" />
						<button class="btn btn-large btn-primary" type="button" onclick="Login();">Ingresar.<span class="icon-off icon-white"></span></button>
            <br />
            <br />
            <div id="msn">  </div>
  </form>
<div id="msn">
</div>
<footer> 
  <p>&nbsp;</p>
  <p>Universidad Pollitécnica de El Salvador <?php echo date('Y');?> </p>
</footer>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<script sr<script src="bootstrap/js/bootstrap-alert.js"></script>