<?php

require_once('../vendor/autoload.php');

$classification = new \Wispiring\ChinaEconomyClassification\Classification();
$data = $classification->getByTopCategory('A');
print_r($data);
