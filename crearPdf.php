<?php

require_once 'fpdf/fpdf.php';
require_once "logica/usuario.php";


session_start();

if( isset($_SESSION['usuario']) && isset($_POST['opcion']) && isset($_POST['idCompra']) && isset($_POST['idUsuario'] ) ){
    
    if( $_POST['opcion'] == 'carrito'){
        $idCompra = $_POST['idCompra'];
        $idUsuario = $_POST['idUsuario'];
        $usuario = new usuario();

        $carritosComprados = $usuario -> consultarCompraCarritos($idUsuario);

        $pdf = new FPDF("P","mm","LETTER");
        $pdf->AddPage();
        $pdf->SetFont("Times","B",16);
        
        $pdf->Cell(200,20,"Factura N. ". $idCompra,0,1,"C");
        $pdf->SetFont("Times","B",24);
        $pdf->Cell(180,0,"",1,1);
        $pdf->Cell(100,20,"Pronto Muebles",0,0,"L");
        $pdf->SetFont("Times","B",12);
        $pdf->Cell(120,0);
        $pdf->SetFont("Times","I",12);
        $pdf->Cell(60, 5, "Identificacion: : ".$carritosComprados[0][0],0,1,"L");
        $pdf->Cell(120,0);
        $pdf->Cell(60, 5, "Nombre: ".$carritosComprados[0][1]. " " .$carritosComprados[0][2],0,1,"L");
        $pdf->Cell(120,0);
        $pdf->Cell(60, 5, "Direccion: ".$carritosComprados[0][3],0,1,"L");
        $pdf->Cell(120,0);
        $pdf->Cell(60, 5, "Telefono: ".$carritosComprados[0][4],0,1,"L");
        $pdf->Cell(120,0);

        $pdf->SetFont("Times","B",12);
        $pdf->Cell(180,20,"",0,1);
        $pdf->Cell(20,8,"#",1,0,"C");
        $pdf->Cell(70,8,"caracteristicas",1,0,"C");
        $pdf->Cell(30,8,"N. Unidades",1,0,"C");
        $pdf->Cell(30,8,"V. Unidad",1,0,"C");
        $pdf->Cell(30,8,"V. Unidades",1,1,"C");
        
        $pdf->SetFont("Times","I",12);
        var_dump($carritosComprados);

        $valorTotal = 0;
        foreach( $carritosComprados as $carritosComprados_item ){
            if($carritosComprados_item[5] == $idCompra){

                $pdf->Cell(20,8,$carritosComprados_item[10],"LR",0,"C");
                $pdf->Cell(70,8,$carritosComprados_item[13],"LR",0,"L");
                $pdf->Cell(30,8,$carritosComprados_item[11],"LR",0,"C");
                $pdf->Cell(30,8,$carritosComprados_item[14],"LR",0,"C");
                $pdf->Cell(30,8,$carritosComprados_item[12],"LR",1,"C");
                $valorTotal += $carritosComprados_item[12];
            }
        }

        $pdf->Cell(120,8, "" , "T" ,0,"C");
        $pdf->Cell(30,8, "Total Cancelado" ,1,0,"C");
        $pdf->Cell(30,8,$valorTotal,1,1,"C");
        $pdf->Cell(180,8,"",0,1,"C");
        $pdf->Cell(180,8, "Pronto Muebles S.A.S. Colombia-Bogota 2021" ,0,1,"C");
        
        $pdf->Cell(180,0,"",1,1);
        

        $pdf->Output("ArchivosPdf/Factura N-". $idCompra.".pdf", "F");
        $pdf->Close();
    }else{
        if( $_POST['opcion'] == 'producto'){
            $idCompra = $_POST['idCompra'];
            $idUsuario = $_POST['idUsuario'];
            $usuario = new usuario();
    
            $productoComprados = $usuario -> consultarCompraProductos($idUsuario);
    
            $pdf = new FPDF("P","mm","LETTER");
            $pdf->AddPage();
            $pdf->SetFont("Times","B",16);
            
            $pdf->Cell(200,20,"Factura N. ". $idCompra,0,1,"C");
            $pdf->SetFont("Times","B",24);
            $pdf->Cell(180,0,"",1,1);
            $pdf->Cell(100,20,"Pronto Muebles",0,0,"L");
            $pdf->SetFont("Times","B",12);
            $pdf->Cell(120,0);
            $pdf->SetFont("Times","I",12);
            $pdf->Cell(60, 5, "Identificacion: : ".$productoComprados[0][0],0,1,"L");
            $pdf->Cell(120,0);
            $pdf->Cell(60, 5, "Nombre: ".$productoComprados[0][1]. " " .$productoComprados[0][2],0,1,"L");
            $pdf->Cell(120,0);
            $pdf->Cell(60, 5, "Direccion: ".$productoComprados[0][3],0,1,"L");
            $pdf->Cell(120,0);
            $pdf->Cell(60, 5, "Telefono: ".$productoComprados[0][4],0,1,"L");
            $pdf->Cell(120,0);
    
            $pdf->SetFont("Times","B",12);
            $pdf->Cell(180,20,"",0,1);
            $pdf->Cell(20,8,"#",1,0,"C");
            $pdf->Cell(70,8,"caracteristicas",1,0,"C");
            $pdf->Cell(30,8,"N. Unidades",1,0,"C");
            $pdf->Cell(30,8,"V. Unidad",1,0,"C");
            $pdf->Cell(30,8,"V. Unidades",1,1,"C");
            
            $pdf->SetFont("Times","I",12);
            var_dump($productoComprados);
            
            $valorTotal = 0;
            foreach( $productoComprados as $productoComprados_item ){
                if($productoComprados_item[5] == $idCompra){
    
                    $pdf->Cell(20,8,$productoComprados_item[10],"LR",0,"C");
                    $pdf->Cell(70,8,$productoComprados_item[12],"LR",0,"L");
                    $pdf->Cell(30,8,$productoComprados_item[11],"LR",0,"C");
                    $pdf->Cell(30,8,$productoComprados_item[13],"LR",0,"C");
                    $pdf->Cell(30,8,$productoComprados_item[9],"LR",1,"C");
                    $valorTotal = $productoComprados_item[9];
                }
            }
            $pdf->Cell(120,8, "" , "T" ,0,"C");
            $pdf->Cell(30,8, "Total Cancelado" ,1,0,"C");
            $pdf->Cell(30,8,$valorTotal,1,1,"C");
            $pdf->Cell(180,8,"",0,1,"C");
            $pdf->Cell(180,8, "Pronto Muebles S.A.S. Colombia-Bogota 2021" ,0,1,"C");
            
            $pdf->Cell(180,0,"",1,1);
            
    
            $pdf->Output("ArchivosPdf/Factura N-". $idCompra.".pdf", "F");
            $pdf->Close();
        }
    }
}
?>

