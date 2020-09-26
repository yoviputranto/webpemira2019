<?
// OBFUSCATE EMAIL
function sensorEmail($email) {
    $em   = explode("@",$email);
    $name = implode(array_slice($em, 0, count($em)-1), '@');
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}
//echo sensorEmail("muhammad_naufal@apps.ipb.ac.id");
?>