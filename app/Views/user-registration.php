<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body {
            height: 100%;
            margin: 0;
            background-image: url('/assets/bg.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #dataForm {
            max-width: 450px;
            width: 100%;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.15);
            border: none;
        }
        .form-label {
            font-weight: 600;
            color: #4a4a4a;
        }
        .form-control, .form-select {
            border-radius: 4px;
            border: 1px solid #8B4513; /* Thinner brown border */
            padding: 8px;
            width: 100%;
        }
        .btn-submit {
            display: block;
            width: 100%;
            border-radius: 4px;
            padding: 0.6rem;
            background-color: #8B4513;
            color: white;
            border: none;
            font-weight: 600;
            text-align: center;
            margin-top: 1rem;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #7a3e11;
        }
        h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #4a4a4a;
        }
        .back {
            display: grid;
            place-items: center;
            margin-top: 2%;
            text-decoration: none;
            font-weight: bold;
            color: black;
        }
        .back:hover{
            color:#7a3e11;
        }
    </style>
</head>
<body>
    <form id="dataForm" method="POST" action="<?= base_url('/user-registration') ?>">
        <h2>Registration</h2>
        <div class="mb-3">
            <label for="username" class="form-label">Name</label>
            <input type="text" class="form-control" id="username" name="employee_name" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" required>
        </div>
        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" required>
        </div>
        <div class="mb-3">
            <input type="hidden" class="form-control" name='role' value="User" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
                <option selected disabled>Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn-submit">Submit</button>
        <a href="<?= site_url('/grantAccess') ?>" class="back">Back to Login</a>
    </form>

    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
