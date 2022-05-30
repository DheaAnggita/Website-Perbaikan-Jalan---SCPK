<?php 
    session_start();

    if(isset($_FILES['file'])){
        $file = $_FILES['file'];
        $format = explode('.',$file['name']);
        $format = end($format);
        $validFormat = ["xls", "xlsx", "csv"];

        if(!in_array(strtolower($format),$validFormat)){
            $_SESSION['error'] = "Harap hanya mengupload file .csv atau .xlsx saja!"; 
            header('location: ../index.php');
        } else {
            $namafile = $file['name'];

            $tmp_name = $_FILES["file"]["tmp_name"];

            move_uploaded_file($tmp_name, "../public/dataset/" . $namafile);

            $array = [];
            $file = fopen("../public/dataset/". $namafile, 'r');
            while (($line = fgetcsv($file)) !== FALSE) {
            //$line is an array of the csv elements
            array_push($array, $line);
            }
            fclose($file);
            
            unlink("../public/dataset/" . $namafile);

            $kolom = max(array_map('count', $array));
            $baris = count(array_map('count', $array));        

            if($kolom != 6) {
                $_SESSION['errorWithImage'] = "Data tidak sesuai!";
                header('location: ../index.php');
                exit;
            } 

            // mengambil data untuk header table
            $header = [];
            for ($i=0; $i < $kolom; $i++) {
                array_push($header, $array[0][$i]);
            }
            
            // mengambil data untuk isi table
            $dataTable = [];
            for ($i=1; $i < $baris-1; $i++) {  
                $dataTable[$i-1]["id"] = $array[$i][0];
            }
            for ($i=1; $i < $baris-1; $i++) {  
                $dataTable[$i-1]["kecamatan"] = $array[$i][1];
            }
            for ($i=1; $i < $baris-1; $i++) {  
                $dataTable[$i-1]["baik"] = number_format($array[$i][2], 3);
            }
            for ($i=1; $i < $baris-1; $i++) {  
                $dataTable[$i-1]["sedang"] = number_format($array[$i][3], 3);
            }
            for ($i=1; $i < $baris-1; $i++) {  
                $dataTable[$i-1]["buruk"] = number_format($array[$i][4], 3);
            }
            for ($i=1; $i < $baris-1; $i++) {  
                $dataTable[$i-1]["sangat"] = number_format($array[$i][5], 3);
            }

            // mengambil data untuk hitung SAW
            $dataSAW = [];
            $index = 0;
            for ($i=1; $i < $baris-1; $i++) { 
                $indexj = 0;
                for ($j=2; $j < $kolom; $j++) { 
                    $dataSAW[$index][$indexj] = $array[$i][$j];
                    $indexj++;
                }
                $index++;
            }
            $_SESSION['array_file'] = $array;
            $_SESSION['header'] = $header;
            $_SESSION['dataTable'] = $dataTable;
            $_SESSION['dataSAW'] = $dataSAW;

            $_SESSION['success'] = "File Berhasil di Upload!"; 
            header('location: ../tabel.php');
        }
    } else {
        $_SESSION['error'] = "Upload File Terlebih Dahulu!"; 
        header('location: ../index.php');
    }