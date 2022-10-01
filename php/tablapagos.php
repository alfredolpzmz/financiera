<?php
    require_once("../lib/config.php");
    $objectConection=new Mysql;
    $objectConection->getThis();
    $obj=$objectConection->ShowError();
    
    $data = array('success' => false);

	$data = array();
	
	if ($obj=="")
	{
		$row = $objectConection->query("SELECT `numeroDeCouta`, `montoCapital`, `montoInteres`, `saldoInsolutoCredito` FROM `prestamos`");
		while ($row=$objectConection->DataObjet()){
			array_push($data, $row);
		}
        echo json_encode($data);
		//echo $json->encode($data);
	}
	else{
		$data = array('success' => false, 'url' => 'error la conectarse a la base de datos');
		echo json_encode($data);
	}

?>