<?php include('include/header.php'); ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Title -->
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Attendee List</span></h4>

        <!-- Card with Table -->
        <div class="card">
            <h5 class="card-header">Attendee List</h5>
            <form method="get"action="">
                        <div class="mb-3 ">
                          <label class="form-label" for="basic-default-company">Event</label>
                          
                           <select class="form-control" id="event_id" name="event_id">
                              <option value="">Select Event</option>
                            <?php 
                                $result=$mysqli->common_select('event');
                                if($result){
                                    if($result['data']){
                                        foreach($result['data'] as $d){
                            ?>
                            <option value="<?= $d->id ?>"<?= isset($_GET['event_id']) && $_GET['event_id']==$d->id?"selected":"" ?>> <?= $d->name ?></option>
                            <?php } } } ?>
                            </select>

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                      </form>
            <div class="card-body">
                <!-- Table Container -->
                <div class="table-responsive text-nowrap">
                    <table id="example" class="table table-bordered">
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
                                if(isset($_GET['event_id'])){
                           $result=$mysqli->common_select_query("select attendee.name attendee_name,event.name event_name, attendee.email, attendee.contact from event join attendee on attendee.event_id=event.id where 
                                                                    event.id={$_GET['event_id']} ");
                           if($result){
                               if($result['data']){
                                   $i=1;
                                   foreach($result['data'] as $data){
                          ?>
                            <tr>
                                <td><?= $i++?></td>
                                <td><?= $data-> attendee_name?></td>
                                <td><?= $data-> event_name?></td>
                                <td><?= $data-> email?></td>
                                <td><?= $data-> contact?></td>
                               <td> <button type="button" class="btn btn-warning" onclick="window.location.href='<?= $baseurl ?>attendee_edit.php?id=<?= $data ->id ?>'">Edit</button>

                                <button type="button" class="btn btn-danger" onclick="window.location.href='<?= $baseurl?>attendee_delete.php?id=<?= $data ->id ?>'">Delete</button> </td>
                            </tr>
                            <?php } } } }?>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Footer -->
    <!-- <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                ©
                <script>document.write(new Date().getFullYear());</script>,
                made with ❤ by
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
            </div>
            <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
            </div>
        </div>
    </footer> -->
    <!-- / Footer -->

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
            "order": [[5, 'desc']], // Default sort by Salary column (index 5)
            "pageLength": 10,      // Set default page length
            "lengthMenu": [10, 25, 50, 100],  // Allow user to change page length
        });
    });
</script>