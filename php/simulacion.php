<?php   
    require_once("../lib/config.php");
    $objectConection=new Mysql;
    $objectConection->getThis();
    $obj=$objectConection->ShowError();
    
    $data = array('success' => false);

    if (isset($_POST["montoPrestamo"]))
        $montoPrestamo=$_POST["montoPrestamo"];
        //$montoPrestamo=12000;
        
    if (isset($_POST["tasaInteres"]))
        $tasaInteres=$_POST["tasaInteres"];
        //$tasaInteres=18;
            
    if (isset($_POST["plazoMeses"]))
        $plazoMeses=$_POST["plazoMeses"];
        //$plazoMeses=24;

    $montoCapital= $montoPrestamo / $plazoMeses;

    if ($obj=="")
    {
        for ($i=1; $i<=$plazoMeses; $i++){
            $numeroDeCouta = $i;
            $montoInteres = ($montoPrestamo * ($tasaInteres/100) /360) * 30;
            $montoPrestamo = $montoPrestamo-$montoCapital;
            $objectConection->query("INSERT INTO prestamos(numeroDeCouta, montoCapital, montoInteres, saldoInsolutoCredito) 
            VALUES('$numeroDeCouta', '$montoCapital', '$montoInteres', '$montoPrestamo')");
        }
        $data = array('success' => true, 'message' => '');
    }
    
    echo json_encode($data);
        
?>