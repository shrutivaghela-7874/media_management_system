      <!--begin::Header-->
      <?php include_once("./layouts/header.php"); ?>
      <!--end::Header-->
      <!--begin::sidebar-->
      <?php include_once("./layouts/sidebar.php"); ?>
      <!--end::sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
          <button id="btn_download">download</button>
          <div class="image-gallery">

              <?php
                $dir    = './uploads';
                $files1 = scandir($dir);
                $a = '.';
                $b = '..';
                foreach ($files1 as $x => $y) {
                    if ($y != $b && $y != $a) {

                ?>
                      <input type="checkbox" name="<?= $y ?>" value="<?= $y ?>">Option 1

                      <div class="border rounded d-flex align-items-center p-2 mb-2">
                          <!-- <a href="uploads/<?= $y ?>">
                              <img src="uploads/<?= $y ?>" alt="Preview" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                          </a> -->
                          <a href="uploads/<?= $y ?>" class="text-decoration-none me-auto"><?= $y ?></a>
                          <a href="uploads/<?= $y ?>" download="">
                              <i class="bi bi-download"></i>
                          </a>
                          <button type="button" data-download_filename='<?= $y ?>' class="btn btn-link text-danger p-0 btn-download">

                          </button>
                          <button type="button" data-filename='<?= $y ?>' class="btn btn-link text-danger p-0 btn-delete">
                              <i class="bi bi-trash"></i>
                          </button>
                      </div>


              <?php
                    }
                }
                ?>
          </div>

      </main>
      <!--end::App Main-->
      <!--begin::footer-->
      <?php include_once("./layouts/footer.php"); ?>
      <script>
          $(document).ready(function() {
              $("#btn_download").on("click", function() {
                  var checkedValues = $('input[type="checkbox"]:checked').map(function() {
                      return this.value;
                  }).get();
                  let link;
                  checkedValues.forEach(function(fileName) {
                      link = document.createElement("a");
                      link.href = "uploads/" + fileName;
                      document.body.appendChild(link);
                      console.log(link);
                      $('a').attr("download", fileName);
                      link.click();
                      // document.body.removeChild(link);
                  });

              });

              $('.btn-delete').click(function() {
                  var buttonId = $(this).data('filename');
                  // console.log(buttonId);

                  $.confirm({
                      title: 'Delete file?',
                      autoClose: 'cancelAction|8000',
                      buttons: {
                          deleteUser: {

                              action: function() {
                                  $.alert('Image is Deleted');
                                  $.ajax({
                                      url: './delete.php',
                                      method: 'POST',
                                      dataType: 'json',
                                      data: {
                                          'image': buttonId,
                                          'action': 'delete_image'
                                      },
                                      success: function(response) {
                                          setTimeout(function() {
                                              location.reload()
                                          }, 2000);


                                      },
                                      error: function(xhr, status, err) {
                                          console.log(xhr);
                                      }
                                  });

                                  $.alert('Image Deleted!');
                              }
                          },
                          cancelAction: function() {
                              $.alert('Time is Over');
                          }
                      }
                  });

              });
          });
      </script>

      <!--end::footer-->