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
<style>
body {
	padding-top: 150px;
}
</style>
<title>Documento sin título</title>
</head>

<body>

<!--Inicio de MENU este clase deja fijo el menu no importa el tamaño-->
    <div class="navbar navbar-inverse navbar-fixed-top">
   <!--DIV -->
<div style="height:100px; background-color: #999; background-image:url(img/baner2.png)">
  
   </div>
    
<!-- COloca de colore nego el fonde donde reisidra el MENU-->
        <div class="navbar-inner">
        	<div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
             <span class="icon-bar"></span> <span class="icon-bar"></span>
             <span class="icon-bar"></span> 
            </a>
            <div class="brand">SIAI</div>
            
            <div class="nav-collapse collapse">
            
           
            <ul class="nav">
            
                <li class="active"> <a href="../inicio.php"><i class="icon-home icon-white"></i> Inicio</a>
                
                
                <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-briefcase icon-white"></i> Catalogos <b class="caret"></b>
                    </a>
                    
                    <ul class="dropdown-menu">
                     <li><a href="../Usuarios/index.php"><i class="icon-user"></i> Usuarios</a></li>
                    </ul> <!--FIn de dropdown-menu -->
               
               
               </li> <!--fin del dropdown-->
               
            </ul> <!--fin del NAV -->
              
              
              <p class="navbar-text pull-right"> Conectado como: 
              <a href="#" class="navbar-link"><strong><?php echo $_SESSION['user']['id']; ?></strong> </a>
              <i class="icon-user icon-white"></i> 
              <a href="../logout.php" class="icon-off icon-white"></a> </p>
            </div> 
            <!--FIN de nav-collapse collapse -->
            
          
            
            </div> <!--container -->
        </div> <!-- FIN de navbar-inner-->
        
    
    </div> <!--fin de  navbar navbar-inverse navbar-fixed-top-->


<div class="container">
	<div class=" well well-small">
    Nombre de MOdulos</div>

<div class="well">Cuero de SIstema</div>
<footer> Universidad Politécnica de El Salvador <?php echo date('Y');?> 
</footer>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
