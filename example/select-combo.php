<?php

require_once('../vendor/autoload.php');

$classification = new \Wispiring\ChinaEconomyClassification\Classification();

echo '<script>'.file_get_contents('../assets/cec.js').'</script>';

echo $classification->getSelectWidget4('cec', '1810');
echo $classification->getSelectWidget4('test', '7724');
echo $classification->getSelectWidget4('test2');
