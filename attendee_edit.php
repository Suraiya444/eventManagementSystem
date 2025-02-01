<?php include('include/header.php'); ?>

        <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <?php 
            $olddata=array();
            $con['id']=$_GET['id'];
            $result=$mysqli->common_select_single('event','*',$con);
            if($result){
                if($result['data']){
                    $olddata=$result['data'];
                }
            }
       ?>

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Event Add</h4>
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Add Event</h5>
                      <small class="text-muted float-end">Event</small>
                    </div>
                    <div class="card-body">
                      <form method="post"action="">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname"> Name</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe" name="name" value="<?= $olddata->name ?>"/>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Description</label>
                          <textarea class="form-control" id="basic-default-company" name="description" placeholder=""> <?= isset($olddata->description)?($olddata->description) : ''; ?></textarea>
                         </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-email">Event Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"id="basic-default-email" class="form-control" placeholder="john.doe"aria-label="john.doe" aria-describedby="basic-default-email2"name ="event_date" value="<?= $olddata->event_date?>"/>
                            <span class="input-group-text" id="basic-default-email2"></span>
                          </div>
                          <div class="form-text"> </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>

                      </form>
                      <?php 
                if($_POST){
                    $_POST['updated_at']=date('Y-m-d H:i:s');
                    $_POST['updated_by']=1;
                    $rs=$mysqli->common_update('event',$_POST,$con);
                    if($rs){
                        if($rs['data']){
                            echo "<script>window.location='{$baseurl}event_list.php'</script>";
                        }else{
                            echo $rs['error'];
                        }
                    }
                }
            ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
        <!-- Content wrapper -->
          </div>
          <!-- / Layout page -->
          </div>

          <!-- Overlay -->
          <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

    <?php include('include/footer.php') ?> 