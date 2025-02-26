<?php
include "componet/header.php";
?>
<style>
    /* Reset content margin and width */
    .content {
        margin-left: 0 !important;
        width: 100% !important;
        min-height: 100vh;
        background: var(--light);
        transition: none;
    }

    /* Hide sidebar completely */
    .sidebar {
        display: none !important;
    }

    /* Override media queries */
    @media (min-width: 992px) {
        .content {
            width: 100% !important;
            margin-left: 0 !important;
        }

        .content.open {
            width: 100% !important;
            margin-left: 0 !important;
        }
    }

    @media (max-width: 991.98px) {
        .content {
            width: 100% !important;
            margin-left: 0 !important;
        }
    }

    /* Active link styling */
    .nav-link.active {
        color: black !important; /* Example color for active tab */
        font-weight: bolder;
        text-decoration: underline 5px black;
        
        
    }
</style>

<div class="content">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-info navbar-dark sticky-top px-4 py-0">
        <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-light mb-0"><i class="fa fa-user-edit"></i></h2>
        </a>

        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars bg-dark text-white"></i>
        </a>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav align-items-center ms-auto">
        <li class="nav-item">
            <a class="nav-link text-white" href="#home">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#nlp">NLP</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#data-insight">Data Insight</a>
        </li>
        <!-- Direct Login Link without Dropdown -->
        <li class="nav-item">
            <a class="nav-link text-white" href="auth/sign_in.php" style="font-weight: bold;">
                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                     style="width: 40px; height: 40px;">
                Login
            </a>
        </li>
    </ul>
</div>

    </nav>
    <!-- Navbar End -->

    <!-- Home Section -->
    <div class="container mt-4 content_nav" id="home">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 mb-4">Welcome to Your Information Support System</h1>
                <p class="lead text-muted mb-5">Your trusted companion for accessing reliable cancer-related information and resources. We're here to help you find the information you need, when you need it.</p>
            </div>
        </div>

        <div class="row g-4 mb-5 bg-light rounded py-5 border border-info h-100 p-4">
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center">
                        <div class="support-icon">📚</div>
                        <h5 class="card-title">Easy Information Access</h5>
                        <p class="card-text">Find relevant information using simple everyday language. No need for complex medical terms.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center">
                        <div class="support-icon">🔍</div>
                        <h5 class="card-title">Smart Search</h5>
                        <p class="card-text">Our system understands your questions and helps you find exactly what you're looking for.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center">
                        <div class="support-icon">🤝</div>
                        <h5 class="card-title">Support Resources</h5>
                        <p class="card-text">Access to support groups, educational materials, and helpful resources for your journey.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NLP Section -->
    <div id="nlp" class="container content_nav">
        <?php include "nlp.php"; ?>
    </div>

    <!-- Data Insight Section -->
    <div class="container-fluid pt-4 px-4 content_nav" id="data-insight">
        <div class="container mt-4">
            <!-- Patient Records Table Section -->
            <div class="col-12">
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
    </div>

    <!-- JavaScript for Active Tab on Scroll -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all navigation links and sections
            const navLinks = document.querySelectorAll(".nav-link");
            const sections = document.querySelectorAll(".content_nav");

            // Function to set active link based on scroll position
            function setActiveLink() {
                let currentSection = "";
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop - 80; // Adjust for navbar height
                    const sectionHeight = section.offsetHeight;
                    if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                        currentSection = section.getAttribute("id");
                    }
                });

                // Remove active class from all links and add to current link
                navLinks.forEach((link) => {
                    link.classList.remove("active");
                    if (link.getAttribute("href").includes(currentSection)) {
                        link.classList.add("active");
                    }
                });
            }

            // Run function on scroll and page load
            window.addEventListener("scroll", setActiveLink);
            setActiveLink();
        });
    </script>

    <?php include "componet/footer.php"; ?>
