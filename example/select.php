<?php

require_once('../vendor/autoload.php');

$classification = new \Wispiring\ChinaEconomyClassification\Classification();

echo $classification->getSelectWidget('cec');
echo $classification->getSelectWidget('cec', '3399');
