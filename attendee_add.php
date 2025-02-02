<?php include('include/header.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Attendee Add</h4>
    <h5 class="card-header d-flex justify-content-end align-items-center py-2">
              <a href="attendee_list.php" class="btn btn-primary"> + Attndee List</a>
                
            </h5>
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
              <select class="form-control" id="event_id" name="event_id">
                <option value="">Select Event</option>
                <?php
                $result = $mysqli->common_select('event');
                if ($result && !empty($result['data'])) {
                  foreach ($result['data'] as $d) {
                    // Get current attendee count
                    $count_result = $mysqli->common_select('attendee', 'COUNT(*) as total', "event_id = '{$d->id}'");
                    $current_count = $count_result['data'][0]->total ?? 0;
                    
                    // Disable option if event is full
                    $disabled = ($current_count >= $d->capacity) ? 'disabled' : '';
                    $status = ($current_count >= $d->capacity) ? ' (Full)' : ' (' . $current_count . '/' . $d->capacity . ')';
                ?>
                    <option value="<?= $d->id ?>" <?= $disabled ?>><?= $d->name . $status ?></option>
                <?php
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
           function checkCapacity() {
            var eventId = document.getElementById('event_id').value;
            var selectedOption = document.querySelector(`#event_id option[value='${eventId}']`);
            var capacity = selectedOption ? parseInt(selectedOption.getAttribute('data-capacity')) : 0;

    if (eventId) {       
        fetch(`check_attendees.php?event_id=${eventId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                var attendeesCount = parseInt(data.attendees_count);
                 
                if (attendeesCount >= capacity) {
                    document.getElementById('submit_button').disabled = true;
                    alert('Registration closed! Maximum capacity reached.');
                } else {
                    document.getElementById('submit_button').disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                 
                document.getElementById('submit_button').disabled = false;
            });
    } else {
        document.getElementById('submit_button').disabled = true;
    }
}

 
document.addEventListener('DOMContentLoaded', function() {
    var eventSelect = document.getElementById('event_id');
    if (eventSelect.value) {
        checkCapacity();
    }
});
        </script>
      

      <?php
if ($_POST) {
    $event_id = $_POST['event_id'];    
    if (empty($event_id) || empty($_POST['name']) || empty($_POST['email'])) {
        echo "<div class='alert alert-danger'>Please fill in all required fields.</div>";
        exit;
    }

    $capacity_result = $mysqli->common_select('event', 'capacity', "id = '$event_id'");
    $count_result = $mysqli->common_select('attendee', 'COUNT(*) as total', "event_id = '$event_id'");
    
    if ($capacity_result['data'] && $count_result['data']) {
        $capacity = $capacity_result['data'][0]->capacity;
        $current_count = $count_result['data'][0]->total;
        
        if ($current_count >= $capacity) {
            echo "<div class='alert alert-danger'>Sorry, this event is already full.</div>";
            exit;
        }
        $data = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'contact' => $_POST['contact'],
            'event_id' => $event_id,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 1
        );
        
        $result = $mysqli->common_create('attendee', $data);
        if ($result['data']) {
            echo "<script>window.location='{$baseurl}attendee_list.php';</script>";
        } else {
            echo "<div class='alert alert-danger'>Error creating attendee.</div>";
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
