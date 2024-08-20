<?php

///GENERAR TRA
function generarTRA($service, $uniqueId, $generationTime, $expirationTime) {
    $xml = new SimpleXMLElement('<loginTicketRequest/>');
    $xml->addAttribute('version', '1.0');

    $header = $xml->addChild('header');
    $header->addChild('uniqueId', $uniqueId);
    $header->addChild('generationTime', $generationTime);
    $header->addChild('expirationTime', $expirationTime);

    $xml->addChild('service', $service);

    $traXml = $xml->asXML();
    file_put_contents('TRA.xml', $traXml);
    return $traXml;
}

// Llamada a la función para generar el archivo TRA.xml
$uniqueId = time();
$generationTime = gmdate('Y-m-d\TH:i:s', $uniqueId);
$expirationTime = gmdate('Y-m-d\TH:i:s', $uniqueId + 1200); // +20 minutos

generarTRA('wsfe', $uniqueId, $generationTime, $expirationTime);
?>