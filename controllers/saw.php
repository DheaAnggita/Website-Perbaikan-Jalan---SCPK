<?php 
    session_start();

    $x = $_SESSION['dataSAW'];
    $array = $_SESSION['array_file'];

    $k = [0, 1, 1, 1];

    $w = [0.10, 0.25,0.30, 0.35];

    $kolom = max(array_map('count', $x));
    $baris = count(array_map('count', $x));

    $max = [$x[0][0],$x[0][1],$x[0][2],$x[0][3]];
    $min = [$x[0][0],$x[0][1],$x[0][2],$x[0][3]];

    for ($i=0; $i < $baris; $i++) {  
        for ($j=0; $j < $kolom; $j++) { 
            if($max[$j] < $x[$i][$j]) $max[$j] = $x[$i][$j];
            if($min[$j] > $x[$i][$j]) $min[$j] = $x[$i][$j];
        }
    }

    for ($i=0; $i < $baris; $i++) { 
        for ($j=0; $j < $kolom; $j++) { 
            if($k[$j] == 1){
                $R[$i][$j] = $x[$i][$j]/$max[$j];
            } else {
                $R[$i][$j] = $min[$j]/$x[$i][$j];
            }
        }
    }

    echo "<h3>Hasil Normalisasi : </h3>";
    for ($i=3; $i < $baris; $i++) { 
        for ($j=0; $j < $kolom; $j++) { 
            echo number_format($R[$i][$j],4) . " | ";
        }
        echo "<br>";
    }
    
    $V = [];
    for ($i=0; $i < $baris; $i++) { 
        array_push($V, 0);
    }

    echo "<br>";

    for ($i=0; $i < $baris; $i++) { 
        for ($j=0; $j < $kolom; $j++) { 
            $V[$i] += $R[$i][$j] * $w[$j];
        }
    }
    echo "<h3>Hasil Akhir</h3>";
    foreach ($V as $hasil) {
        echo number_format($hasil,4) . " | ";
    } 

    $result = $V;
    rsort($result);
    $wilayah = [];

    for ($i=0; $i < $baris; $i++) { 
        for ($j=0; $j < $baris; $j++) { 
            if($result[$i] == $V[$j]){
                array_push($wilayah, $array[$j+1][1]);
            }
        }
    }
    $dataNormalisasi = $_SESSION['dataTable'];
    for ($i=0; $i < $baris; $i++) { 
        $dataNormalisasi[$i]["baik"] = number_format($R[$i][0],3);
    }
    for ($i=0; $i < $baris; $i++) { 
        $dataNormalisasi[$i]["sedang"] = number_format($R[$i][1],3);
    }
    for ($i=0; $i < $baris; $i++) { 
        $dataNormalisasi[$i]["buruk"] = number_format($R[$i][2],3);
    }
    for ($i=0; $i < $baris; $i++) { 
        $dataNormalisasi[$i]["sangat"] = number_format($R[$i][3],3);
    }

    $hasil = [];
    for ($i=0; $i < $baris; $i++) { 
        array_push($hasil, ["wilayah" => $wilayah[$i], "nilai" => number_format($result[$i],3)]);
    }
    $_SESSION['dataNormalisasi'] = $dataNormalisasi;
    $_SESSION['result'] = $hasil;

    unset($_SESSION['dataTable']);
    $_SESSION['success'] = "Berhasil Memproses Data!";
    header('location: ../hasil.php');
    