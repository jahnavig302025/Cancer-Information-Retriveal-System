<?php
include "componet/header.php";
include "componet/sidebar.php";
?>


<div class="container-fluid pt-4 px-4">
    <div class="container mt-4">
        <!-- Patient Records Table Section -->
        <div class="col-12">
            <div class="bg-light rounded py-5 border border-info h-100 p-4">
                <h6 class="mb-4">Patient Records</h6>
                <div class="col text-end pb-2">
                    <!-- Button to Open Add Patient Modal -->
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addPatientModal">
                        <i class="fas fa-plus"></i> Add New Patient
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="y" class="table table-bordered">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">Patient ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Address</th>
                                <th scope="col">Cancer Type</th>
                                <th scope="col">Stage</th>
                                <th scope="col">Treatment Plan</th>
                            </tr>
                        </thead>
                        <tbody id="patientRecords">
                            <!-- Display data dynamically from JSON -->
                        </tbody>

                        </thead>
                        <tbody id="patientRecords">
                            <!-- display data dynamically from JSON -->
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Patient Modal -->
<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPatientModalLabel">Add New Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPatientForm" action="php/add_patient.php" method="post">
                    <!-- Existing Fields -->
                    <div class="mb-3">
                        <label for="patientName" class="form-label">Patient Name</label>
                        <input type="text" class="form-control" id="patientName" name="patientName" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>

                    <!-- New Fields -->
                    <div class="mb-3">
                        <label for="cancerType" class="form-label">Cancer Type</label>
                        <input type="text" class="form-control" id="cancerType" name="cancerType" required>
                    </div>
                    <div class="mb-3">
                        <label for="stage" class="form-label">Stage</label>
                        <input type="text" class="form-control" id="stage" name="stage" required>
                    </div>
                    <div class="mb-3">
                        <label for="treatmentPlan" class="form-label">Treatment Plan</label>
                        <textarea class="form-control" id="treatmentPlan" name="treatmentPlan" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-info">Add Patient</button>
                </form>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function() {
        // Load patient records first, then initialize DataTable
        function loadPatientRecords() {
    $.ajax({
        url: 'db/patients.json',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            const tbody = $('#patientRecords');
            tbody.empty();
            data.forEach(record => {
                const row = `
                    <tr>
                        <td>${record.patientID}</td>
                        <td>${record.patientName}</td>
                        <td>${record.age}</td>
                        <td>${record.gender}</td>
                        <td>${record.contact}</td>
                        <td>${record.address}</td>
                        <td>${record.cancerType}</td>
                        <td>${record.stage}</td>
                        <td>${record.treatmentPlan}</td>
                    </tr>
                `;
                tbody.append(row);
            });

            // Initialize DataTable after loading data
            $('#y').DataTable();
        },
        error: function(xhr, status, error) {
            console.error('Error loading patient records:', error);
        }
    });
}


        // Call loadPatientRecords on page load
        loadPatientRecords();

        // Form submission for adding patient
        $('#addPatientForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    $('#addPatientForm')[0].reset();
                    $('#addPatientModal').modal('hide'); // Hide the modal after submission

                    // Reload patient records and reinitialize DataTable
                    $('#y').DataTable().clear().destroy(); // Destroy current instance
                    loadPatientRecords();
                },
                error: function(xhr, status, error) {
                    alert('Error adding patient: ' + error);
                }
            });
        });
    });
</script>


<?php
include "componet/footer.php";
?>