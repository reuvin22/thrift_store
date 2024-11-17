<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-image: url('/assets/bg.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .modal-content {
            border: 2px solid #774601;
        }
        .modal-header {
            background-color: #774601;
            color: white;
        }
        .button.is-primary {
            background-color: #774601;
            border-color: #774601;
        }
        .button.is-primary:hover {
            background-color: #5c3f01;
            border-color: #5c3f01;
        }
        .table th {
            background-color: #774601;
            color: white !important;
        }
        .input {
            border: 2px solid #774601;
        }
        .input:focus {
            border-color: #5c3f01;
            box-shadow: 0 0 5px rgba(119, 70, 1, 0.5);
        }
        .close-button {
            background: none;
            border: none;
            color: black; 
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            right: 1rem;
            top: 1rem;
            z-index: 10;
            line-height: 1;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .back-button-container {
            text-align: right;
            margin-top: 20px;
        }

        .review-header {
            font-size: 40px; 
            font-weight: bold;
            color: #774601;
            margin-bottom: 20px;
            text-align: center; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
            padding: 10px;
        }

        .review-header i {
            margin-right: 10px; 
        }


    </style>
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="btn-container">
                
            </div>
            <div class="modal" id="employeeModal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Admin</p>
                        <button class="close-button" aria-label="close" id="close-modal">X</button>
                    </header>
                    
                    <section class="modal-card-body">
                        <form id="dataForm" method="POST" action="<?= base_url('/employees/create') ?>">
                            <input type="hidden" id="employee_id" name="employee_id">
                            <div class="field">
                                <label class="label" for="employee_name">Admin Name</label>
                                <div class="control">
                                    <input type="text" class="input" id="employee_name" name="employee_name" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="email">Email</label>
                                <div class="control">
                                    <input type="email" class="input" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="password">Password</label>
                                <div class="control">
                                    <input type="password" class="input" id="password" name="password">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="department">Department</label>
                                <div class="control">
                                    <div class="select">
                                        <select class="input" id="department" name="department" required>
                                            <option value="" disabled selected>Select a department</option>
                                            <option value="IT">IT</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Registrar">Registrar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="age">Age</label>
                                <div class="control">
                                    <input type="number" class="input" id="age" name="age" required min="18">
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="contact_number">Contact Number</label>
                                <div class="control">
                                    <input type="text" class="input" id="contact_number" name="contact_number" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="gender">Gender</label>
                                <div class="control">
                                    <div class="select">
                                        <select class="input" id="gender" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="address">Address</label>
                                <div class="control">
                                    <input type="text" class="input" id="address" name="address" required>
                                </div>
                            </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button type="submit" class="button is-primary">Submit</button>
                    </footer>
                        </form>
                </div>
                
                
            </div>
            
            <div class="review-header">
                <i class="fas fa-shopping-bag"></i> REVIEW ORDER
            </div>
            <table class="table is-striped is-fullwidth mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Buyer Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $index => $row): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= esc($row['items_name']); ?></td>
                                <td><?= esc($row['price']); ?></td>
                                <td><?= esc($row['qty']); ?></td>
                                <td><?= esc($row['name']); ?></td>
                                <td><?= esc($row['status']); ?></td>
                                <td>
                                <button onclick="updateStatus(this)" class="button is-success" 
                                        data-id="<?= esc($row['id']); ?>">
                                    Delivered
                                </button>
                                <button onclick="deleteStatus(this)" class="button is-danger" data-id="<?= esc($row['id']); ?>">
                                    Delete
                                </button>
                                </td>
                            </tr>
                            
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="has-text-centered">No orders found</td>
                        </tr>
                    <?php endif; ?>
                   
                </tbody>
            </table>
            <div class="back-button-container">
                <a href="<?= base_url('/') ?>"><button class="button is-primary">
                    Back
                </button></a>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('add-employee-button').onclick = function () {
            document.getElementById('employeeModal').classList.add('is-active');
        };

        document.getElementById('close-modal').onclick = function () {
            document.getElementById('employeeModal').classList.remove('is-active');
            document.getElementById('dataForm').reset();
        };

        function updateStatus(button) {
            const id = button.getAttribute('data-id');

            fetch(`<?= base_url('/orders/update'); ?>/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: 'Delivered' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.closest('tr').querySelector('td:nth-child(6)').textContent = 'Delivered';
                    alert('Order status updated to Delivered.');
                } else {
                    alert('Failed to update status.');
                }
            })
            .catch(error => {
                console.error('Error updating status:', error);
            });
        }
        function deleteStatus(button) {
            if (!confirm('Are you sure you want to delete this order?')) {
                return;
            }

            const id = button.getAttribute('data-id');

            fetch(`<?= base_url('/orders/delete'); ?>/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.closest('tr').remove();
                    alert('Order deleted successfully.');
                } else {
                    alert('Failed to delete order.');
                }
            })
            .catch(error => {
                console.error('Error deleting order:', error);
            });
        }
    </script>
</body>
</html>
