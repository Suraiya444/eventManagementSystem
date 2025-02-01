<?php include('include/header.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Attendee Add</h4>
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add Attendee</h5>
            <small class="text-muted float-end">Attendee</small>
          </div>
          <div class="card-body">
            <form method="post" action="">
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Name</label>
                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Name" name="name" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Event</label>
                <select class="form-control" id="event_id" name="event_id" onchange="checkCapacity()">
                  <option value="">Select Event</option>
                  <?php
                  $result = $mysqli->common_select('event');
                  if ($result) {
                    if ($result['data']) {
                      foreach ($result['data'] as $d) {
                  ?>
                        <option value="<?= $d->id ?>" data-capacity="<?= $d->capacity ?>"><?= $d->name ?></option>
                  <?php
                      }
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-email">Email</label>
                <div class="input-group input-group-merge">
                  <input type="text" id="basic-default-email" class="form-control" placeholder="Email" name="email" />
                  <span class="input-group-text" id="basic-default-email2"></span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-email">Contact</label>
                <div class="input-group input-group-merge">
                  <input type="text" id="basic-default-email" class="form-control" placeholder="Contact" name="contact" />
                  <span class="input-group-text" id="basic-default-email2"></span>
                </div>
              </div>
              <button type="submit" id="submit_button" class="btn btn-primary" >Submit</button>
            </form>

            <script>
              // JavaScript function to check the capacity and enable/disable the submit button
              function checkCapacity() {
                var eventId = document.getElementById('event_id').value;
                var selectedOption = document.querySelector(`#event_id option[value='${eventId}']`);
                var capacity = selectedOption ? selectedOption.getAttribute('data-capacity') : 0;

                if (eventId) {
                  // Fetch the current number of attendees for the selected event
                  fetch(`check_attendees.php?event_id=${eventId}`)
                    .then(response => response.json())
                    .then(data => {
                      // Check if the number of attendees exceeds the capacity
                      if (data.attendees_count >= capacity) {
                        document.getElementById('submit_button').disabled = true;
                        alert('This event has reached its maximum capacity!');
                      } else {
                        document.getElementById('submit_button').disabled = false;
                      }
                    });
                } else {
                  document.getElementById('submit_button').disabled = true;
                }
              }
            </script>

            <?php
            if ($_POST) {
              $_POST['created_at'] = date('Y-m-d H:i:s');
              $_POST['created_by'] = 1;
              $result = $mysqli->common_create('attendee', $_POST);
              if ($result) {
                if ($result['data']) {
                  echo "<script>window.location='{$baseurl}attendee_list.php';</script>";
                } else {
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

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<?php include('include/footer.php'); ?>
