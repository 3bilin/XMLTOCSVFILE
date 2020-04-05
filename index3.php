<?php
$files = glob("ENERO/*.[xX][mM][lL]");
foreach($files as $file){
    unlink($file);
}
?>