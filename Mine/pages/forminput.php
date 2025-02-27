<!--
=========================================================
* Argon Dashboard 3 - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php 
include 'auth.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/favicontelp.png">
  <link rel="icon" type="image/png" href="../assets/img/favicontelp.png">
  <title>
    YCR Services
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- Firebase SDK -->
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-database.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  

  <style>
    .custom-left {
      transform: translateX(-200px); /* Geser ke kiri */
      
    }
  </style>
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.php">
              MINE FORM @ {-..-}
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="" class="btn btn-sm mb-0 me-1 btn-primary">Free Download</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row justify-content-start align-items-center min-vh-100">
            <div class="col-xl-4 col-lg-5 col-md-7 col-10 custom-left">
              <div class="card card-plain">
              </div>      
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Form Input</h4>
                  <p class="mb-0">Enter your telphone and password to save</p>
                </div>
                <div class="mb-3">
                  <label for="voiceCount" class="form-label">Jumlah Voice</label>
                  <select class="form-select" id="voiceCount">
                    <option value="" selected disabled>Pilih jumlah voice</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  </select>
                </div>               
                <div class="card-body">
                  <form id="forminput1" method="post" action="./save_data.php">                  
                    <div class="mb-3">
                      <input type="text" name="sn" id="sn" class="form-control form-control-lg" placeholder="Serial Number" aria-label="Password" required>
                    </div>
                    <div id="voiceInputs"></div>
                    <div class="form-check form-switch">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Simpan</button>
                    </div>
                  </form>
                </div>
                <!-- Tempat Alert -->
                <div id="alert-container"></div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Sudah Jiko Hari Ini?
                    <a href="javascript:;" class="text-primary text-gradient font-weight-bold"></a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('../assets/img/patrickhome.jpg');
              background-size: cover; background-position:  center; background-repeat: no-repeat;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
     <!-- Firebase SDK -->
     <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js"></script>
     <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-database.js"></script>
     <!-- JavaScript -->     
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 $(document).ready(function() {
  // Event saat jumlah voice diubah
  $('#voiceCount').change(function() {
    const count = $(this).val();
    let inputHtml = '';

    // Generate input secara dinamis
    for (let i = 1; i <= count; i++) {
      inputHtml += `
        <div class="mb-3">
          <label for="telp${i}" class="form-label">No Telephone ${i}</label>
          <input type="text" name="telp[]" class="form-control telp-input" placeholder="No Telephone ${i}" required>
        </div>
        <div class="mb-3">
          <label for="passtelp${i}" class="form-label">Password telp ${i}</label>
          <input type="text" name="passtelp[]" class="form-control" placeholder="Password ${i}" required>
        </div>`;
    }
    
    $('#voiceInputs').html(inputHtml);

    // Tambahkan event listener untuk validasi duplikasi setelah input dibuat
    $(".telp-input").on("change", function() {
      const currentInput = $(this);
      const currentValue = currentInput.val().trim();

      // Cek apakah input ini duplikat dengan input lain di halaman
      let isDuplicate = false;
      $(".telp-input").each(function() {
        if ($(this).val().trim() === currentValue && $(this)[0] !== currentInput[0]) {
          isDuplicate = true;
          return false;
        }
      });

      if (isDuplicate) {
        alert("No Telephone tidak boleh duplikat di form ini!");
        currentInput.val('');
        return;
      }
      console.log($(this).serialize());

      // Lanjutkan validasi ke database
      if (currentValue !== "") {
        $.ajax({
          type: "POST",
          url: "check_voice.php", // Path ke file PHP untuk cek di database
          data: { telp: currentValue },
          success: function(response) {
            if (response.includes("exists")) {
              alert("No Telephone sudah terdaftar!");
              currentInput.val('');
            }
          }
        });
      }
    });
  });

  // Event submit form
  $("#forminput1").on("submit", function(e) {
    e.preventDefault(); // Cegah form agar tidak refresh page

    const sn = $("#sn").val().trim();
    let isEmpty = false;

    // Cek apakah ada input yang kosong
    $(".telp-input, input[name='passtelp[]']").each(function() {
      if ($(this).val().trim() === "") {
        isEmpty = true;
        return false;
      }
    });

    if (isEmpty || sn === "") {
      alert("Semua field harus diisi!");
      return;
    }
    console.log($(this).serialize());

    // Kirim data dengan AJAX
    $.ajax({
      type: "POST",
      url: "save_data.php",
      data: $(this).serialize(),
      success: function(response) {
        if (response.includes("success")) {
          $("#alert-container").html(`
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
              Data berhasil disimpan!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          `);
          // Bersihkan input form
          $("#forminput1")[0].reset();
        } else {
          $("#alert-container").html(`
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
              Terjadi kesalahan: ${response}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          `);
        }
      },
      error: function() {
        $("#alert-container").html(`
          <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            Terjadi kesalahan pada koneksi.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `);
      }
    });
  });
});

</script>

    
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>