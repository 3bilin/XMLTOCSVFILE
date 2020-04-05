<?php
ob_start();
$files        = glob("ENERO/*.[xX][mM][lL]");
echo "RFC".","."PROVEEDOR".","."SUB TOTAL".","."TOTAL".","."DESCUENTO".","."SERIE Y FOLIO".","."IVA"."\n";
    foreach($files as $filename) {
        $xml_file = file_get_contents($filename, FILE_TEXT);
        $xml_file=strtolower($xml_file);
        $xml = new SimpleXMLElement($xml_file);
        $namespaces = $xml->getDocNamespaces();
        foreach ($xml->xpath('//cfdi:comprobante//cfdi:emisor') as $Emisor){
                $emisor_rfc = $Emisor['rfc'];
                $emisor_rfc2 = $Emisor['Rfc'];
                $emisor_razon_social   = str_replace(",", "", $Emisor['nombre']);
                $emisor_razon_social2 = str_replace(",", "",$Emisor['Nombre']);
                echo strtoupper($emisor_rfc) . $emisor_rfc2 . "," . strtoupper($emisor_razon_social) . $emisor_razon_social2 . ",";
            }
        foreach ($xml->xpath('//cfdi:comprobante') as $Conceptos){
            $Conceptos_importe = $Conceptos['subtotal'];
            $Conceptos_importe2 = $Conceptos['SubTotal'];
            $Conceptos_total = $Conceptos['total'];
            $Conceptos_total2 = $Conceptos['Total'];
            $Conceptos_descuento = $Conceptos['descuento'];
            $Conceptos_descuento2 = $Conceptos['Descuento'];
            $Conceptos_serie = $Conceptos['serie'];
            $Conceptos_serie2 = $Conceptos['Serie'];
            $Conceptos_folio = $Conceptos['folio'];
            $Conceptos_folio2 = $Conceptos['Folio'];
            echo $Conceptos_importe . $Conceptos_importe2;
            echo ",";
            echo $Conceptos_total . $Conceptos_total2 . ",";
            echo $Conceptos_descuento . $Conceptos_descuento2 . ",";
            echo $Conceptos_serie . $Conceptos_serie2 . $Conceptos_folio . $Conceptos_folio2 . ",";
           // echo ",/n";
        }
        foreach ($xml->xpath('//cfdi:comprobante//cfdi:traslados//cfdi:traslado') as $Traslado){
            $Traslado_importe = $Traslado['importe'];
            $Traslado_importe2 = $Traslado['Importe'];
            $Traslado_tasa = $Traslado['tasa'];
            $Traslado_tasa2 = $Traslado['TasaOCuota'];
            if($Traslado_importe > 0){
                echo $Traslado_importe;
                break;
            }
                elseif ($Traslado_importe2 > 0){
                    echo $Traslado_importe2;
                    break;
                }
        }
            echo ",\n";
    }
    header('content-type: text/csv');
    header('Content-disposition: attachment; filename="demo.csv"');
    //$file2 = fopen('demosaved.csv', 'w');
    //fputcsv($file2, array($emisor_razon_social, $emisor_rfc));
    exit();
    ob_end_flush();
    
?>