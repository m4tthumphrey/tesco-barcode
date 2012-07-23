<?php

require_once '../app/Tesco_Barcode.php';

$barcode = Tesco_Barcode::scan('5000221503354');

$barcode->setPrice(7);
echo $barcode->getBarcode(6); // 971500022150335460000708

$barcode = Tesco_Barcode::scan('0000010097403');

$barcode->setPrice(31);
echo $barcode->getBarcode(7); // 971000001009740370003102
