<?php
///ENVIAR TRA
function obtenerTA($wsaaUrl, $signedTraPath) {
    $traFirmado = file_get_contents($signedTraPath);

    $client = new SoapClient($wsaaUrl, array(
        'soap_version' => SOAP_1_2,
        'location' => $wsaaUrl,
        'trace' => 1,
        'exceptions' => 0,
        'encoding' => 'UTF-8'
    ));

    $result = $client->loginCms(array('in0' => $traFirmado));
    if (is_soap_fault($result)) {
        throw new Exception('Error: ' . $result->faultcode . ' - ' . $result->faultstring);
    }

    file_put_contents('TA.xml', $result->loginCmsReturn);
    return $result->loginCmsReturn;
}

$wsaaUrl = 'https://wsaahomo.afip.gov.ar/ws/services/LoginCms';
obtenerTA($wsaaUrl, 'TRA.signed.xml');
?>