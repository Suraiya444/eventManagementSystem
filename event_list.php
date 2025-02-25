<?php include('include/header.php'); ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Title -->
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Event List</span></h4>

        <!-- Card with Table -->
        <div class="card">
            <h5 class="card-header">Event List</h5>
            <h5 class="card-header d-flex justify-content-end align-items-center py-2">
              <a href="event_add.php" class="btn btn-primary"> + Add Event</a>
                
            </h5>
            <div class="card-body">
                <!-- Table Container -->
                <div class="table-responsive text-nowrap">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Capacity</th>
                                <th>Event date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php 
                           $result=$mysqli->common_select('event');
                           if($result){
                               if($result['data']){
                                   $i=1;
                                   foreach($result['data'] as $data){
                          ?>
                            <tr>
                                <td><?= $i++?></td>
                                <td><?= $data-> name?></td>
                                <td><?= $data-> description?></td>
                                <td><?= $data-> capacity?></td>
                                <td><?= $data-> event_date?></td>
                               <td> <button type="button" class="btn btn-warning" onclick="window.location.href='<?= $baseurl ?>event_edit.php?id=<?= $data ->id ?>'">Edit</button>

                                <button type="button" class="btn btn-danger" onclick="window.location.href='<?= $baseurl?>event_delete.php?id=<?= $data ->id ?>'">Delete</button> </td>
                            </tr>
                            <?php } } } ?>
                            <!-- Add more rows as needed -->
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
            "order": [[5, 'desc']], // Default sort by Salary column (index 5)
            "pageLength": 10,      // Set default page length
            "lengthMenu": [10, 25, 50, 100],  // Allow user to change page length
        });
    });
</script>