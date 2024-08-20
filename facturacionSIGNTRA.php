<?php

///FIRMAR TRA
function firmarTRA($traXmlPath, $certificadoPath, $privateKeyPath, $passphrase) {
    $tra = file_get_contents($traXmlPath);
    openssl_pkcs7_sign($traXmlPath, 'TRA.signed.xml', file_get_contents($certificadoPath), 
                        array(file_get_contents($privateKeyPath), $passphrase), 
                        array(), PKCS7_NOCHAIN | PKCS7_NOCERTS);
    // Eliminar las cabeceras MIME para obtener el contenido XML
    $contenidoFirmado = file_get_contents('TRA.signed.xml');
    $contenidoFirmado = explode("\n\n", $contenidoFirmado, 2)[1];
    $contenidoFirmado = explode("\n\n", $contenidoFirmado, 2)[0];
    file_put_contents('TRA.signed.xml', $contenidoFirmado);
}

firmarTRA('TRA.xml', 'PHPPOS_1b45ca07f9ff90ac.crt', 'MiClavePrivada.key', 'my_password');
?>