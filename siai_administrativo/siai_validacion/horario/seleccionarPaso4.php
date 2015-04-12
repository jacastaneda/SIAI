<?php
session_start();
include_once('../clases/ClassConexion.php');
include_once('../clases/ClassSiaiControl.php');
include_once('../clases/ClassControl.php');


$siaiControl=unserialize($_SESSION['siai']['control']);
if($siaiControl->getPaso()==3)
{
	$siaiControl->setPaso(4);
	$siaiControl->updateSiaiControl();
	$_SESSION['siai']['control']=serialize($siaiControl);
}
?>