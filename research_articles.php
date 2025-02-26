<?php
include "componet/header.php";
include "componet/sidebar.php";
?>

<div class="container-fluid pt-4 px-4">
    <div class="col-12 mb-4">
        <div class="bg-light rounded py-5 border border-info h-100 p-4">
    <h5>Search Research Articles</h5>
    <div class="row">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Keyword" aria-label="Search">
        </div>
        <div class="col-md-4">
            <select class="form-select">
                <option selected>Topic</option>
                <option value="1">Immunotherapy</option>
                <option value="2">Chemotherapy</option>
                <option value="3">Genetics</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="date" class="form-control" placeholder="Date Range">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <button class="btn btn-info w-100">Search</button>
        </div>
    </div>
</div>
</div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="col-12 mb-4">
        <div class="bg-light rounded py-5 border border-info h-100 p-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Advances in Immunotherapy for Lung Cancer</h5>
                    <p class="card-text">Author: Dr. Jane Smith</p>
                    <p class="card-text">Published: 2024-08-15</p>
                    <p class="card-text">Journal: Journal of Cancer Research</p>
                    <a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#articleDetailModal">Read Abstract</a>
                </div>
            </div>
        </div>
        <!-- Repeat for additional articles -->
    </div>
</div>

</div>
</div>

<div class="modal fade" id="articleDetailModal" tabindex="-1" aria-labelledby="articleDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="articleDetailModalLabel">Research Article Abstract</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Advances in Immunotherapy for Lung Cancer</h5>
                <p><strong>Author:</strong> Dr. Jane Smith</p>
                <p><strong>Published:</strong> 2024-08-15</p>
                <p><strong>Journal:</strong> Journal of Cancer Research</p>
                <p><strong>Abstract:</strong> This study explores recent advancements in immunotherapy and their effectiveness in lung cancer treatments. It provides an analysis of the mechanisms involved and compares the efficacy of current therapies...</p>
                <a href="https://pubmed.ncbi.nlm.nih.gov/" target="_blank" class="btn btn-primary">View Full Article on PubMed</a>
            </div>
        </div>
    </div>
</div>

<?php

include "componet/footer.php";
?>