<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <!-- Include Bootstrap for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .container {
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow */
            border-radius: 8px; /* Rounded corners */
            padding: 30px;
            background-color: #fff; /* White container */
        }
        h2 {
            color: #343a40; /* Dark gray heading */
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: 500; /* Slightly bolder labels */
        }
        .btn-success {
            background-color: #28a745; /* Green button */
            border-color: #28a745;
        }
        .btn-secondary {
            background-color: #6c757d; /* Gray button */
            border-color: #6c757d;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Add New User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Add User</button>
            <a href="/admin/dashboard" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>