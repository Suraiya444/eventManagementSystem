<?php include('include/header.php'); ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Card with Table -->
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center py-2">
                Attendee List
                <a href="attendee_add.php" class="btn btn-primary">Add Attendee</a>
            </h5>
            <div class="card-body p-4">
                <form method="get" action="" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label class="form-label" for="event_id">Select Event</label>
                            <select class="form-control form-control-sm" id="event_id" name="event_id">
                              <option value="">Select Event</option>
                              <?php 
                                $result = $mysqli->common_select('event');
                                if ($result && isset($result['data'])) {
                                    foreach ($result['data'] as $d) {
                              ?>
                              <option value="<?= $d->id ?>"<?= isset($_GET['event_id']) && $_GET['event_id'] == $d->id ? "selected" : "" ?>><?= $d->name ?></option>
                              <?php 
                                    }
                                }
                              ?>
                            </select>
                        </div>
                        
                        <div class="text-start">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <?php if (isset($_GET['event_id'])) { ?>
                                <a href="export_attendee.php?event_id=<?= $_GET['event_id'] ?>" class="btn btn-success">Show Report</a>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="card-body">
                <!-- Table Container -->
                <div class="table-responsive text-nowrap pt-4">
                    <table id="example" class="table table-bordered" style="margin: auto;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Event</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php 
                                if (isset($_GET['event_id'])) {
                                    $result = $mysqli->common_select_query("SELECT attendee.id, attendee.name AS attendee_name, event.name AS event_name, attendee.email, attendee.contact FROM event JOIN attendee ON attendee.event_id = event.id WHERE event.id = {$_GET['event_id']}");
                                    if ($result && isset($result['data'])) {
                                        $i = 1;
                                        foreach ($result['data'] as $data) {
                          ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $data->attendee_name ?></td>
                                <td><?= $data->event_name ?></td>
                                <td><?= $data->email ?></td>
                                <td><?= $data->contact ?></td>
                               <td>
                                    <button type="button" class="btn btn-warning" onclick="window.location.href='<?= $baseurl ?>attendee_edit.php?id=<?= $data->id ?>'">Edit</button>
                                    <button type="button" class="btn btn-danger" onclick="window.location.href='<?= $baseurl ?>attendee_delete.php?id=<?= $data->id ?>'">Delete</button>
                               </td>
                            </tr>
                          <?php 
                                        }
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">No attendees found</td></tr>';
                                    }
                                }
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
<!-- / Content Wrapper -->

<?php include('include/footer.php'); ?>

<!-- Add your DataTable scripts here -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<!-- DataTable Initialization Script -->
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "paging": true,        // Enable pagination
            "searching": true,     // Enable searching/filtering
            "ordering": true,      // Enable sorting
            "order": [[0, 'asc']], // Default sort by ID column (index 0)
            "pageLength": 10,      // Set default page length
            "lengthMenu": [10, 25, 50, 100],  // Allow user to change page length
        });
    });
</script>
