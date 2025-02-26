<?php
include "componet/header.php";
include "componet/sidebar.php";
?>
<div class="container-fluid pt-4 px-4">
    <div class="container mt-4">
        <!-- Clinical Trials Table Section -->
        <div class="col-12">
            <div class="bg-light rounded py-5 border border-info h-100 p-4">
                <h6 class="mb-4">Clinical Trials</h6>
                <div class="col text-end pb-2">
                    <!-- Button to Open Add Clinical Trial Modal -->
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addTrialModal">
                        <i class="fas fa-plus"></i> Add New Trial
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="clinicalTrialsTable" class="table table-bordered">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">Trial ID</th>
                                <th scope="col">Study Name</th>
                                <th scope="col">Cancer Type</th>
                                <th scope="col">Phase</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody id="clinicalTrials">
                            <!-- Clinical trials data will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Clinical Trial Modal -->
<div class="modal fade" id="addTrialModal" tabindex="-1" aria-labelledby="addTrialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTrialModalLabel">Add New Clinical Trial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTrialForm" action="php/add_trial.php" method="post">
                    <div class="mb-3">
                        <label for="studyName" class="form-label">Study Name</label>
                        <input type="text" class="form-control" id="studyName" name="studyName" required>
                    </div>
                    <div class="mb-3">
                        <label for="cancerType" class="form-label">Cancer Type</label>
                        <input type="text" class="form-control" id="cancerType" name="cancerType" required>
                    </div>
                    <div class="mb-3">
                        <label for="phase" class="form-label">Phase</label>
                        <input type="text" class="form-control" id="phase" name="phase" required>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="" selected>Select Status</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                            <option value="Recruiting">Recruiting</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Add Trial</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Load clinical trials records and initialize DataTable
        function loadClinicalTrials() {
            $.ajax({
                url: 'db/clinical_trials.json', // JSON file for clinical trials data
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    const tbody = $('#clinicalTrials');
                    tbody.empty();
                    data.forEach(trial => {
                        const row = `
                            <tr>
                                <td>${trial.trialID}</td>
                                <td>${trial.studyName}</td>
                                <td>${trial.cancerType}</td>
                                <td>${trial.phase}</td>
                                <td>${trial.startDate}</td>
                                <td>${trial.endDate}</td>
                                <td>${trial.status}</td>
                            </tr>
                        `;
                        tbody.append(row);
                    });

                    // Initialize DataTable for clinical trials
                    $('#clinicalTrialsTable').DataTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error loading clinical trials:', error);
                }
            });
        }

        // Call loadClinicalTrials on page load
        loadClinicalTrials();

        // Form submission for adding clinical trial
        $('#addTrialForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    $('#addTrialForm')[0].reset();
                    $('#addTrialModal').modal('hide');

                    // Reload trials data
                    $('#clinicalTrialsTable').DataTable().clear().destroy();
                    loadClinicalTrials();
                },
                error: function(xhr, status, error) {
                    alert('Error adding trial: ' + error);
                }
            });
        });
    });
</script>


<?php
include "componet/footer.php";
?>