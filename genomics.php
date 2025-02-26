<?php
include "componet/header.php";
include "componet/sidebar.php";
?>

<div class="container-fluid pt-4 px-4">
    <div class="col-12 mb-4">
        <div class="bg-light rounded py-5 border border-info h-100 p-4">

            <h5>Genomics Data</h5>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Total Genetic Markers</div>
                        <div class="card-body">
                            <h5 class="card-title">150</h5>
                            <p class="card-text">Total number of genetic markers analyzed.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Patients with Mutations</div>
                        <div class="card-body">
                            <h5 class="card-title">45%</h5>
                            <p class="card-text">Percentage of patients with identified mutations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Common Cancer Types</div>
                        <div class="card-body">
                            <h5 class="card-title">3</h5>
                            <p class="card-text">Most common cancer types linked to genetic mutations.</p>
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
            <h5>Genomic Data Overview</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Genetic Marker</th>
                        <th scope="col">Associated Cancer Type</th>
                        <th scope="col">Mutation Type</th>
                        <th scope="col">Prevalence (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>BRCA1</td>
                        <td>Breast Cancer</td>
                        <td>Insertion</td>
                        <td>15%</td>
                    </tr>
                    <tr>
                        <td>TP53</td>
                        <td>Lung Cancer</td>
                        <td>Missense</td>
                        <td>25%</td>
                    </tr>
                    <tr>
                        <td>KRAS</td>
                        <td>Colorectal Cancer</td>
                        <td>Point Mutation</td>
                        <td>40%</td>
                    </tr>
                    <tr>
                        <td>EGFR</td>
                        <td>Non-Small Cell Lung Cancer</td>
                        <td>Deletion</td>
                        <td>30%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="container-fluid pt-4 px-4">
    <div class="col-12 mb-4">
        <div class="bg-light rounded py-5 border border-info h-100 p-4">
            <h5>Genetic Mutation Correlation</h5>
            <canvas id="mutationCorrelationChart" style="max-width: 600px; height: 400px;"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('mutationCorrelationChart').getContext('2d');
    const mutationCorrelationChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Breast Cancer', 'Lung Cancer', 'Colorectal Cancer'],
            datasets: [{
                label: 'Number of Patients with Mutations',
                data: [300, 450, 200],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Patients'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Cancer Type'
                    }
                }
            }
        }
    });
</script>


<div class="container mt-4">
    <h5>Genomic Data Overview</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Genetic Marker</th>
                <th scope="col">Associated Cancer Type</th>
                <th scope="col">Mutation Type</th>
                <th scope="col">Prevalence (%)</th>
            </tr>
        </thead>
        <tbody id="genomicDataTable">
            <!-- Rows will be dynamically generated here -->
        </tbody>
    </table>
</div>

<script>
    fetch('db/genomicsData.json')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById("genomicDataTable");
            data.genomicData.forEach(item => {
                const row = `<tr>
                    <td>${item.marker}</td>
                    <td>${item.cancerType}</td>
                    <td>${item.mutationType}</td>
                    <td>${item.prevalence}%</td>
                </tr>`;
                tableBody.insertAdjacentHTML("beforeend", row);
            });
        })
        .catch(error => console.error("Error loading genomic data:", error));
</script>


<?php
include "componet/footer.php";
?>