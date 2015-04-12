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

<title>Documento sin título</title>
</head>

<body>

<!--Inicio de MENU este clase deja fijo el menu no importa el tamaño-->
    <div class="navbar navbar-inverse navbar-fixed-top">
    Baner
    
    <!-- COloca de colore nego el fonde donde reisidra el MENU-->
        <div class="navbar-inner">
        	<div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
             <span class="icon-bar"></span> <span class="icon-bar"></span>
             <span class="icon-bar"></span> 
            </a>
            <div class="brand">IVA</div>
            
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
    Contedido
    </div>

<div class="well">
</div>
<footer>
Denys Urquilla
</footer>
</div> <!-- container -->

<div class="container">
  <form class="form-horizontal">
    <div class="control-group">
      <label class="control-label" for ="PAss"> USEweweR</label>
      <div class="controls">
        <input type="text" name="ss" id="ss" placeholder="Usuario"/>
        <input type="text" name="ss" id="ss" placeholder="Usuario"/>
      </div>
    </div>
    <div class="control-group"> <!--COn este div hacemos grupos de ontroles -->
      <div class="controls">
        <button type="submit" class="btn">Ingreso</button>
        <button type="submit" class="btn">Cancelar</button>
      </div>
    </div>
    
    
    <div class="control-group">
      <div class="controls">
        <div class="input-prepend input-append"> <span class="add-on">$</span>
          <input class=" span2" type="text" />
          <span class="add-on">$</span> 
        </div>
      </div>
      
      
      <div class="control-group">
        <div class="controls">
          <div class="input-append">
            <input class=" span2" type="text" />
            <button class="btn ic" type="button" >Buscar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  
  <div class="control-group warning">
  <label class="control-label" for="inputWarning">Input with warning</label>
  <div class="controls">
    <input type="text" id="inputWarning">
    <span class="help-inline">Something may have gone wrong</span>
  </div>
</div>
<div class="control-group error">
  <label class="control-label" for="inputError">Input with error</label>
  <div class="controls">
    <input type="text" id="inputError">
    <span class="help-inline">Please correct the error</span>
  </div>
</div>
<div class="control-group success">
  <label class="control-label" for="inputSuccess">Input with success</label>
  <div class="controls">
    <input type="text" id="inputSuccess">
    <span class="help-inline">Woohoo!</span>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="inputIcon">Email address</label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="span2" id="inputIcon" type="text">
    </div>
  </div>
</div>

<ul class="nav nav-list">
  <li class="active"><a href="#"><i class="icon-home icon-white"></i> Home</a></li>
  <li><a href="#"><i class="icon-book"></i> Library</a></li>
  <li><a href="#"><i class="icon-pencil"></i> Applications</a></li>
  <li><a href="#"><i class="i"></i> Misc</a></li>
</ul>

<a class="btn btn-large" href="#"><i class="icon-star"></i> Star</a>
<a class="btn btn-small" href="#"><i class="icon-star"></i> Star</a>
<a class="btn btn-mini" href="#"><i class="icon-star"></i> Star</a>



</div>

<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> User</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
    <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
    <li class="divider"></li>
    <li><a href="#"><i class="i"></i> Make admin</a></li>
  </ul>
</div>
<p>dasdas </p>
<p>das</p>
<p>das</p>
<p>dasd</p>
<p>asd</p>
<p>as</p>
<p>d</p>
<p>as</p>
<p>d</p>
<p>as</p>
<p>d</p>
<p>w</p>
</body>
</html>
