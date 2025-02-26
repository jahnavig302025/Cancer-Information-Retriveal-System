<?php
include "componet/header.php";
include "componet/sidebar.php";
?>

<div class="container-fluid pt-4 px-4">
    <div class="container mt-4">
        <!-- User Records Table Section -->
        <div class="col-12">
            <div class="bg-light rounded py-5 border border-info h-100 p-4">
                <h6 class="mb-4">User Records</h6>
                <div class="col text-end pb-2">
                    <!-- Button to Open Add User Modal -->
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-plus"></i> Add New User
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="usersTable" class="table table-bordered">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                            </tr>
                        </thead>
                        <tbody id="userRecords">
                            <!-- Display data dynamically from JSON -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" action="php/add_user.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role" required>
                    </div>
                    <button type="submit" class="btn btn-info">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Load user records first, then initialize DataTable
        function loadUserRecords() {
            $.ajax({
                url: 'db/users.json',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    const tbody = $('#userRecords');
                    tbody.empty();
                    data.forEach(user => {
                        const row = `
                            <tr>
                                <td>${user.email}</td>
                                <td>${user.username}</td>
                                <td>${user.role}</td>
                            </tr>
                        `;
                        tbody.append(row);
                    });

                    // Initialize DataTable after loading data
                    $('#usersTable').DataTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error loading user records:', error);
                }
            });
        }

        // Call loadUserRecords on page load
        loadUserRecords();

        // Form submission for adding user
        $('#addUserForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    $('#addUserForm')[0].reset();
                    $('#addUserModal').modal('hide'); // Hide the modal after submission

                    // Reload user records and reinitialize DataTable
                    $('#usersTable').DataTable().clear().destroy(); // Destroy current instance
                    loadUserRecords();
                },
                error: function(xhr, status, error) {
                    alert('Error adding user: ' + error);
                }
            });
        });
    });
</script>

<?php
include "componet/footer.php";
?>
