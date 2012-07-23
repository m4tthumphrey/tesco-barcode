<?php

require_once '../app/Tesco_Barcode.php';

$barcode = Tesco_Barcode::scan('5000221503354');

$barcode->setPrice(7);
echo $barcode->getBarcode(6);

