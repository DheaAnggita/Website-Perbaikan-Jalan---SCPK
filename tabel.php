<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>SPK Metode SAW</title>
  </head>
  <body>
      <?php 
        session_start();
        if(!isset($_SESSION['dataTable'])):
            $_SESSION['error'] = "Ulangi Upload File Kembali!";
            header('location: index.php');
            exit;
        else :
            $dataTable = $_SESSION['dataTable'];
            $header = $_SESSION['header'];
            $dataSAW = $_SESSION['dataSAW'];
            if(isset($_SESSION['success'])): ?>
              <input type="hidden" name="success" id="success" value="<?= $_SESSION['success'] ?>">
            <?php 
            unset($_SESSION['success']);
            endif; ?>
  <div class="bg-shadow"></div>
  <div class="col-md-2">
    <a class="btn btn-success" href="index.php"><i class="fa fa-home fa-5x" aria-hidden="true"></i></a>
  </div>
  <div class="bg-text">
    <h2 class="mb-5">Sistem Pendukung Keputusan Menentukan Prioritas Perbaikan Jalan di Kabupaten Sleman dengan Metode SAW</h2>
    <div class="row justify-content-center">
      <div class="col-md-10">
      <div class="panel panel-primary">
        <div class="row panel-heading  align-items-center mb-4">
            <div class="col-md-10">
            <h3 class="panel-title">Data Kondisi Jalan tiap Kecamatan di Kab. Sleman</h3>
            </div>
            <div class="col-md-2">
                <form action="controllers/saw.php" method="post" id="proses_saw">
                    <button type="button" class="btn btn-primary" name="proses_saw" onclick="alertSubmit()">Proses SAW</button>
                </form>
            </div>
    </div>
        <table class="table table-hover text-light" id="dev-table">
            <thead>
                <tr>
                    <?php foreach($header as $header): ?>
                        <th><?= $header ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
            <?php foreach($dataTable as $data): ?>
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
      </div>
    </div>
  </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
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
      <?php endif ?>
    </script>
    <script>
      var error = document.getElementById('error');
      var error = document.getElementById('success');
      
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