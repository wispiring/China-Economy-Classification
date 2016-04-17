<?php

require_once('../vendor/autoload.php');

$classification = new \Wispiring\ChinaEconomyClassification\Classification();
$data = $classification->getSelectArray();

$o = '<select onchange="show(this)">';
foreach ($data as $label => $d) {
    $o .= '<optgroup label="'.$label.'">';
    foreach ($d as $value => $name) {
        $o.= '<option value="'.$value.'">'.$name.'</option>';
    }
    $o .= '</optgroup>';
}
$o .= '</select>';
$o .= '<div id="output" style="border: solid 1px #999;margin: 20px;padding: 50px;">Please select</div>';

$o .= '<script>
function show(select){
    var option = select.options[select.selectedIndex];
    document.getElementById("output").innerHTML = "Selected: " + option.value + ": " + option.innerHTML;
}
</script>';
echo $o;
