      <!--begin::Header-->
      <?php include_once("./layouts/header.php"); ?>
      <!--end::Header-->
      <!--begin::sidebar-->
      <?php include_once("./layouts/sidebar.php"); ?>
      <!--end::sidebar-->
      <!--begin::content-->
      <div class="box1">
            <div class="file-upload">
                  <div id="my-dropzone" class="dropzone">

                  </div>
                  <img src="../admin/dist/assets/img/icons8-upload.gif" alt="A cool animated GIF" class="upload_gif">
            </div>
      </div>

      <!-- Hidden custom preview template -->


      <!--end::content-->
      <!--begin::footer-->
      <?php include_once("./layouts/footer.php"); ?>
      <script>
            Dropzone.autoDiscover = false;

            var myDropzone = new Dropzone(".dropzone", {
                              paramName: "files",
                              uploadMultiple: true,
                              url: "upload.php",
                              parallelUploads: 3,
                              uploadMultiple: true,
                              autoProcessQueue: true,
                              addRemoveLinks: true,
                              maxFiles: 3,
                              init: function() {
                                    this.on("maxfilesexceeded", function(file) {
                                          this.removeFile(file); // Optional: remove the excess file  
                                    });
                                    $.alert('Maximum 3 Files Can Upload');
                              }
                              });
                        // $('#uploadFile').click(function() {
                        //       myDropzone.processQueue();
                        // });
      </script>
      <!--end::footer-->