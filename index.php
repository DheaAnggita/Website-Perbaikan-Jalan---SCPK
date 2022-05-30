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
      .bg-text{
        transform: translate(-50%, -50%);
      }
    </style>
    <title>SPK Metode SAW</title>
  </head>
  <body>
    
    <?php 
      session_start();
      if(isset($_SESSION['error'])): ?>
        <input type="hidden" name="error" id="error" value="<?= $_SESSION['error'] ?>">
       <?php 
      unset($_SESSION['error']);
      
      endif; 
      if(isset($_SESSION['errorWithImage'])): ?>
        <input type="hidden" name="errorWithImage" id="errorWithImage" value="<?= $_SESSION['errorWithImage'] ?>">
       <?php 
      unset($_SESSION['errorWithImage']);
      
      endif; 
      session_destroy();
      ?>
      <div class="bg-shadow"></div>
      <div class="bg_load">
        
      <div class="d-flex justify-content-center mb-4">
      <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      </div>
        <h2>Sistem Pendukung Keputusan Menentukan Prioritas Perbaikan Jalan di Kabupaten Sleman dengan Metode SAW</h2>
        <h3>Dhea Anggita &nbsp;| 123190046</h3>
        <h3>Rico Aminanda | 123190079</h3>
      </div>
  <div class="bg-text">
    <h2 class="mb-5">Sistem Pendukung Keputusan Menentukan Prioritas Perbaikan Jalan di Kabupaten Sleman dengan Metode SAW</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form method="post" action="controllers/proses.php" enctype="multipart/form-data" id="formExcel">
              <div class="form-group files">
                <label>Upload File Dataset </label>
                <input type="file" class="form-control" name="file">
              </div>
              <button type="button" class="btn btn-primary" onclick="alertSubmit()">Submit</button>
          </form>
      </div>
    </div>
  </div>
    <div class="wrapper">
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <script>
        $(".bg_load").delay(2000).fadeOut();
        $(".wrapper").delay(2000).fadeOut();
    </script>
    <script>
      form = document.getElementById('formExcel');
      function alertSubmit(){
        Swal.fire({
        title: 'Upload File CSV / XLSX',
        text: 'Apakah File Sudah Benar?',
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
      var errorWithImage = document.getElementById('errorWithImage');

      if(error != null){
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: error.value
      })
    }
      if(errorWithImage != null){
        Swal.fire({
        title: 'Data Tidak Sesuai',
        text: 'Pastikan data memiliki kolom _id, Kecamatan, Baik, Sedang, Rusak, Rusak Berat',
        imageUrl: 'public/images/info.png',
        imageWidth: 400,
        imageAlt: 'Custom image',
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