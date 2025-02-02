<?php include('include/header.php'); ?>

        <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Event Add</h4>
              <h5 class="card-header d-flex justify-content-end align-items-center py-2">
              <a href="event_list.php" class="btn btn-primary"> + Event List</a>
                
            </h5>
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
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Event Name" name="name" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Description</label>
                          <textarea class="form-control" id="basic-default-company" placeholder="Description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Maximum Capacity</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="" name="capacity" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-email">Event Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"id="basic-default-email" class="form-control" placeholder="john.doe"aria-label="john.doe" aria-describedby="basic-default-email2"name ="event_date"/>
                            <span class="input-group-text" id="basic-default-email2"></span>
                          </div>
                          <div class="form-text"> </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>

                      </form>
                      <?php 
                        if($_POST){
                          $_POST['created_at']=date('Y-m-d H:i:s');
                          $_POST['created_by']=1;
                          $result=$mysqli->common_create('event',$_POST);
                          if($result){
                            if($result['data']){
                              echo "<script>window.location='{$baseurl}event_list.php';</script>";

                            }else{
                              echo $result['error'];
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