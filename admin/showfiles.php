      <!--begin::Header-->
      <?php include_once("./layouts/header.php"); ?>
      <!--end::Header-->
      <!--begin::sidebar-->
      <?php include_once("./layouts/sidebar.php"); ?>
      <!--end::sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
          <div class="btn_down_dang d-flex justify-content-end me-8">

              <button type="button" class="btn btn-outline-danger me-3" id="btn_selected_delete">Delete</button>
              <button type="button" class="btn btn-outline-primary me-3" id="btn_download">Download</button>

              <button type="button" class="btn btn-outline-secondary me-3" id="btn_all_select">Select All</button>
              <button type="button" class="btn btn-outline-secondary me-3" id="btn_all_unselect">Unselect</button>
          </div>
          <div class="image-gallery">

              <?php
                $dir    = './uploads';
                $files1 = scandir($dir);
                $a = '.';
                $b = '..';
                foreach ($files1 as $x => $y) {
                    if ($y != $b && $y != $a) {

                ?>



                      <div class="border rounded d-flex align-items-center p-2  mb-2">
                          <input type="checkbox" name="<?= $y ?>" value="<?= $y ?>" class="me-3">
                          <a href="uploads/<?= $y ?>" target="_blank" class="text-decoration-none me-auto"><?= $y ?></a>
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
                      document.body.removeChild(link);
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
                              }
                          },
                          cancelAction: function() {
                              $.alert('Time is Over');
                          }
                      }
                  });

              });









              $('#btn_selected_delete').click(function() {
                  let checkedValues = $('input[type="checkbox"]:checked').map(function() {
                      return this.value;
                  }).get();

                  $.confirm({
                      title: 'Delete file?',
                      autoClose: 'cancelAction|8000',
                      buttons: {
                          deleteUser: {

                              action: function() {

                                  $.ajax({
                                      url: './delete.php',
                                      method: 'POST',
                                      dataType: 'json',
                                      data: {
                                          'arr': checkedValues,
                                          'action': 'delete_selected_image'
                                      },
                                      success: function(response) {
                                          // console.log(response);
                                          $.alert('Image is Deleted');
                                          setTimeout(function() {
                                              location.reload()
                                          }, 2000);


                                      },
                                      error: function(xhr, status, err) {
                                          console.log(xhr);
                                      }
                                  });


                              }
                          },
                          cancelAction: function() {
                              $.alert('Time is Over');
                          }
                      }
                  });

              });
              $("#btn_all_select").on("click", function() {

                  $('input[type="checkbox"]').prop('checked', true);
              });
              $("#btn_all_unselect").on("click", function() {

                  $('input[type="checkbox"]').prop('checked', false);
              });
          });
      </script>

      <!--end::footer-->