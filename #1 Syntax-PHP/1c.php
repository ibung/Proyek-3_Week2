<?php
    // while
    echo "Contoh WHILE:\n";
    $i = 10;
    while ($i <= 50) {
        echo $i . "\n";
        $i = $i + 5;      
    }

    // for
    echo "\nContoh FOR:\n";
    for ($j = 1; $j <= 5; $j++) {
        echo "Perulangan ke-$j\n";
    }

    // foreach
    echo "\nContoh FOREACH:\n";
    $buah = ["Apel", "Jeruk", "Mangga", "Pisang"];
    foreach ($buah as $b) {
        echo $b . "\n";
    }
?>
