<?php

?><?php

echo "1) ";
$i = 1;
while ($i <= 9) {
    echo $i . " ";
    $i++;
}
echo "<br>";

echo "2) ";
$i = 9;
while ($i >= 1) {
    echo $i . " ";
    $i--;
}
echo "<br>";

echo "3) ";
$i = 1;
while ($i <= 20) {
    if ($i % 2 == 0) {
        echo $i . " ";
    }
    $i++;
}
echo "<br>";

echo "4) ";
$i = 1;
while ($i <= 20) {
    if ($i % 2 != 0) {
        echo $i . " ";
    }
    $i++;
}
echo "<br>";

echo "5) ";
$sumaImpares = 0;
$i = 1;
while ($i <= 20) {
    if ($i % 2 != 0) {
        echo $i . " ";
        $sumaImpares += $i;
    }
    $i++;
}
echo "<br>";
echo "Suma de impares: " . $sumaImpares . "<br>";

echo "6) ";
$sumaPares = 0;
$i = 2;
while ($i <= 20) {
    echo $i . " ";
    $sumaPares += $i;
    $i += 2;
}
echo "<br>";
echo "Suma de pares: " . $sumaPares . "<br>";

?>
