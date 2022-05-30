<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
     
    </style>
    <title>SPK Metode SAW</title>
  </head>
  <body>
      <?php 
        session_start();
        if(!isset($_SESSION['dataNormalisasi'])):
            $_SESSION['error'] = "Ulangi Upload File Kembali!";
            header('location: index.php');
            exit;
        else :
            $dataNormalisasi = $_SESSION['dataNormalisasi'];
            $header = $_SESSION['header'];
            $result = $_SESSION['result'];
        endif;
        if(isset($_SESSION['success'])): ?>
            <input type="hidden" name="success" id="success" value="<?= $_SESSION['success'] ?>">
        <?php 
            unset($_SESSION['success']);
        endif; ?>
        
<div class="col-md-2">
    <a class="btn btn-success" href="index.php"><i class="fa fa-home fa-5x" aria-hidden="true"></i></a>
  </div>
<div class="bg-shadow" ></div>
  <div class="bg-text">
    <h2 class="mb-5">Sistem Pendukung Keputusan Menentukan Prioritas Perbaikan Jalan di Kabupaten Sleman dengan Metode SAW</h2>
    <div class="row justify-content-center">
      <div class="col-md-10">
      <div class="panel panel-primary">
      <h3 class="panel-title">Data Kondisi Jalan tiap Kecamatan di Kab. Sleman</h3>    
        <div class="d-flex panel-heading  justify-content-between mb-2">
            <button type="button" class="btn btn-success" id="tombolnormalisasi">Tabel Normalisasi</button>   
            <button type="button" class="btn btn-secondary" id="tombolrank">Hasil Ranking</button>

        </div>
        <div id="normalisasi">
            <h4>Tabel normalisasi</h4>
            <table class="table text-light" id="dev-table">
                <thead>
                    <tr>
                        <?php foreach($header as $header): ?>
                            <th><?= $header ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($dataNormalisasi as $data): ?>
                    <tr>
                        <td><?= $data["id"] ?></td>
                        <td><?= $data["kecamatan"] ?></td>
                        <td><?= $data["baik"] ?></td>
                        <td><?= $data["sedang"] ?></td>
                        <td><?= $data["buruk"] ?></td>
                        <td><?= $data["sangat"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div id="result" style="display: none">
            <h4>Tabel Hasil Perankingan</h4>
            <table class="table text-light" id="dev-table">
                <thead>
                    <tr>
                        <th>Prioritas</th>
                        <th>Wilayah</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach($result as $data): ?>
                    <tr>
                        <td>Prioritas <?= $i++ ?></td>
                        <td><?= $data["wilayah"] ?></td>
                        <td><?= $data["nilai"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
      </div>
    </div>
  </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#tombolnormalisasi').click(function(){
                $('#normalisasi').show(500);
                $('#result').hide(500);
                $(this).addClass("btn-success");
                $(this).removeClass("btn-secondary");
                $('#tombolrank').removeClass("btn-success");
                $('#tombolrank').addClass("btn-secondary");
            })
            $('#tombolrank').click(function(){
                $('#normalisasi').hide(500);
                $('#result').show(500);
                $(this).addClass("btn-success");
                $(this).removeClass("btn-secondary");
                $('#tombolnormalisasi').removeClass("btn-success");
                $('#tombolnormalisasi').addClass("btn-secondary");
            })
        })
    </script>
    <script>
      form = document.getElementById('proses_saw');
      function alertSubmit(){
        Swal.fire({
        title: 'Proses Metode SAW',
        text: 'Apakah Data Sudah Benar?',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Sudah',
        cancelButtonText: 'Belum',
        showLoaderOnConfirm: true,
        }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      })
      };
    </script>
    <script>
      var error = document.getElementById('error');
      var success = document.getElementById('success');

      if(error != null){
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: error.value
      })
      }
      if(success != null){
        Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: success.value
      })
    }
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>