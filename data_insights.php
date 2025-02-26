<?php
include "componet/header.php";
include "componet/sidebar.php";
?>

<div class="container-fluid pt-4 px-4">
    <div class="col-12 mb-4">
        <div class="bg-light rounded py-5 border border-info h-100 p-4">
            <h5>Data Insights</h5>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white mb-3">
                        <div class="card-header bg-info">Total Patients</div>
                        <div class="card-body " style="background-color: black;">
                            <h5 class="card-title text-white">1,250</h5>
                            <p class="card-text">Total number of patients registered in the system.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white  mb-3">
                        <div class="card-header bg-info">Active Clinical Trials</div>
                        <div class="card-body" style="background-color: black;">
                            <h5 class="card-title text-white">45</h5>
                            <p class="card-text">Number of ongoing clinical trials available for patients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white  mb-3">
                        <div class="card-header bg-info">Average Survival Rate</div>
                        <div class="card-body" style="background-color: black;">
                            <h5 class="card-title text-white">78%</h5>
                            <p class="card-text">Average survival rate for patients in the past 5 years.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="col-12 mb-4">
        <div class="bg-light rounded py-5 border border-info h-100 p-4">
            <h5>Trends Over Time</h5>
            <canvas id="trendsChart" style="max-width: 600px; height: 400px;"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('trendsChart').getContext('2d');
    const trendsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Survival Rate (%)',
                data: [75, 78, 80, 82, 79, 85, 87],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Survival Rate (%)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                }
            }
        }
    });
</script>

<div class="container-fluid pt-4 px-4">
    <div class="col-12 mb-4">
        <div class="bg-light rounded py-5 border border-info h-100 p-4">
            <h5>Data Summary</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Cancer Type</th>
                        <th scope="col">Total Patients</th>
                        <th scope="col">Average Age</th>
                        <th scope="col">Average Treatment Success Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lung Cancer</td>
                        <td>350</td>
                        <td>65</td>
                        <td>70%</td>
                    </tr>
                    <tr>
                        <td>Breast Cancer</td>
                        <td>400</td>
                        <td>58</td>
                        <td>80%</td>
                    </tr>
                    <tr>
                        <td>Prostate Cancer</td>
                        <td>300</td>
                        <td>70</td>
                        <td>75%</td>
                    </tr>
                    <tr>
                        <td>Colorectal Cancer</td>
                        <td>200</td>
                        <td>62</td>
                        <td>65%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include "componet/footer.php";
?>