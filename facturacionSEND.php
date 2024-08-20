<?php
//ENVIAR FACTURA

function enviarFactura($wsfeUrl, $taXmlPath, $facturaXmlPath) {
    $taXml = simplexml_load_file($taXmlPath);
    $token = $taXml->credentials->token;
    $sign = $taXml->credentials->sign;

    $client = new SoapClient($wsfeUrl, array(
        'soap_version' => SOAP_1_2,
        'trace' => 1,
        'exceptions' => 0,
        'encoding' => 'UTF-8'
    ));

    $params = array(
        'Auth' => array(
            'Token' => (string)$token,
            'Sign' => (string)$sign,
            'Cuit' => '30647500915'  // TU CUIT
        ),
        'FeCAEReq' => simplexml_load_file($facturaXmlPath)
    );

    $result = $client->FECAESolicitar($params);
    if (is_soap_fault($result)) {
        throw new Exception('Error: ' . $result->faultcode . ' - ' . $result->faultstring);
    }

    return $result;
}

$wsfeUrl = 'https://wswhomo.afip.gov.ar/wsfev1/service.asmx';
$taXmlPath = 'TA.xml';
$facturaXmlPath = 'fac_elec.xml';
$response = enviarFactura($wsfeUrl, $taXmlPath, $facturaXmlPath);

///MANEJO DE RESPONSE
if ($response->FECAESolicitarResult->FeCabResp->Resultado === 'A') {
    $cae = $response->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAE;
    $fechaVto = $response->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAEFchVto;
    echo "Factura Aprobada. CAE: $cae, Vencimiento: $fechaVto";
} else {
    echo "Error en la emisión de la factura.";
}


?>