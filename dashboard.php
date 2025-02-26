<?php
include "componet/header.php";
include "componet/sidebar.php";
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Total Patient Records -->
        <div class="col-sm-6 col-xl-3">
            <div
                class="border border-info rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-info"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Patient</p>
                    <h6 class="mb-0" id="patient-count">Loading...</h6> 
                </div>
            </div>
        </div>

        <!-- Active Clinical Trials -->
        <div class="col-sm-6 col-xl-3">
            <div
                class="border border-info rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-flask fa-3x text-info"></i>
                <div class="ms-3">
                    <p class="mb-2">Active Clinical Trials</p>
                    <h6 class="mb-0">58</h6> <!-- Replace with dynamic count -->
                </div>
            </div>
        </div>

        <!-- Recent Queries -->
        <div class="col-sm-6 col-xl-3">
            <div
                class="border border-info rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-search fa-3x text-info"></i>
                <div class="ms-3">
                    <p class="mb-2">Recent Queries</p>
                    <h6 class="mb-0">145</h6> <!-- Replace with dynamic count -->
                </div>
            </div>
        </div>

        <!-- New Research Articles -->
        <div class="col-sm-6 col-xl-3">
            <div
                class="border border-info rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-book-open fa-3x text-info"></i>
                <div class="ms-3">
                    <p class="mb-2">New Research Articles</p>
                    <h6 class="mb-0">25</h6> <!-- Replace with dynamic count -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Quick Actions Section -->
        <div class="col-12">
            <div class="bg-light border border-info rounded p-4">
                <h6 class="mb-4">Quick Actions</h6>
                <div class="row text-center">

                    <!-- Add New Patient Record -->
                    <div class="col-md-4 mb-4">
                        <a href="patient_records.php"
                            class="btn btn-info w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fa fa-user-plus me-2"></i> Add Patient
                        </a>
                    </div>

                    <!-- Upload Clinical Trial Data -->
                    <div class="col-md-4 mb-4">
                        <a href="clinical_trials.php"
                            class="btn btn-info w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fa fa-upload me-2"></i> Upload Trial Data
                        </a>
                    </div>

                    <!-- Search Research Articles -->
                    <div class="col-md-4 mb-4">
                        <a href="research_articles.php"
                            class="btn btn-info w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fa fa-search me-2"></i> Search Articles
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Recent NLP Queries and User Searches -->
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light border border-info rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Recent NLP Queries</h6>
                    <a href="" class="text-info">Show All</a>
                </div>
                <div id="query-container">
                    <!-- JavaScript will populate recent queries here -->
                </div>
            </div>
        </div>

        <!-- Latest Uploaded/Updated Records -->
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light border border-info rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Latest Uploaded Records</h6>
                    <a href="" class="text-info">Show All</a>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <i class="fa fa-file-alt fa-2x text-info"></i>
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <span>New Clinical Trial: "Immunotherapy for Lung Cancer"</span>
                            <small>2 days ago</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <i class="fa fa-book fa-2x text-info"></i>
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <span>Updated Research: "Genetics in Cancer Treatment"</span>
                            <small>1 week ago</small>
                        </div>
                    </div>
                </div>
                <!-- Additional records can be listed here -->
            </div>
        </div>

        <!-- Recent User Logins and Activity -->
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light border border-info p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">User Activity</h6>
                    <a href="" class="text-info">Show All</a>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <i class="fa fa-user fa-2x text-info"></i>
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <span>User: Dr. Smith logged in</span>
                            <small>10 minutes ago</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <i class="fa fa-user fa-2x text-info"></i>
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <span>User: Nurse Jane updated patient records</span>
                            <small>30 minutes ago</small>
                        </div>
                    </div>
                </div>
                <!-- Additional user activities can be listed here -->
            </div>
        </div>
    </div>
</div>

<script>
      document.addEventListener("DOMContentLoaded", () => {
        fetch("db/query.json")
            .then(response => response.json())
            .then(data => {
                // Retrieve the last two entries
                const recentQueries = data.slice(-2);
                const queryContainer = document.getElementById("query-container");
                queryContainer.innerHTML = ""; // Clear existing content

                recentQueries.reverse().forEach(query => {
                    const queryElement = `
                        <div class="d-flex align-items-center border-bottom py-3">
                            <i class="fa fa-search fa-2x text-info"></i>
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <span>"${query.query}"</span>
                                    <small>${new Date(query.timestamp).toLocaleString()}</small>
                                </div>
                            </div>
                        </div>`;
                    queryContainer.innerHTML += queryElement;
                });
            })
            .catch(error => console.error("Error loading queries:", error));
    });

    document.addEventListener("DOMContentLoaded", () => {
        fetch("db/patients.json")
            .then(response => response.json())
            .then(data => {
                // Calculate the total number of patient records
                const totalPatients = data.length;
                
                // Update the count in the HTML
                document.getElementById("patient-count").textContent = totalPatients.toLocaleString();
            })
            .catch(error => {
                console.error("Error loading patient data:", error);
                document.getElementById("patient-count").textContent = "Error";
            });
    });
</script>


<?php
include "componet/footer.php";
?>