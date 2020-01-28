
$url = 'http;//epower_route.info/services.svc?wsdl';

$appId = 3322; //Numeric value
$doctype = 3322; //Numeric value
$query = 3322; //Numeric value

$indicesEPower = [
    'indice1',
    'indice2'
]; // array

$cejilla = 'TEST'; //String value
$archivo = ''; //Base64 encoded file
$originalName = 'presupuestos';
$originalExtension = '.pdf';

$archivo = new InsertaArchivo(
    $url,
    $appId,
    $doctype,
    $query,
    $indicesEPower,
    $cejilla,
    $archivo,
    $originalName,
    $originalExtension
);

$response = $archivo->InsertaArchivo(); //Send or not