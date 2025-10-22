<?php
include 'connect.php';

$error = '';
$success = '';

// Fetch existing data for display
if(isset($_GET['updateid']) && !empty($_GET['updateid'])) {
    $id = $_GET['updateid'];
    
    if(!is_numeric($id)) {
        $error = "Invalid ID format";
    } else {
        $sql = "SELECT * FROM onlinebidding WHERE id=$id";
        $result = mysqli_query($conn, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['username'];
            $email = $row['email'];
        } else {
            $error = "Record not found!";
        }
    }
} else {
    $error = "No ID specified for update!";
}

// Handle form submission for updating user data
if(isset($_POST['update'])) {
    $id = $_POST['id']; // Changed from $_GET to $_POST
    
    if(!is_numeric($id)) {
        $error = "Invalid ID format";
    } else {
        $name = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        // Only update password if a new one was provided
        if(!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE onlinebidding SET username='$name', email='$email', userpassword='$password' WHERE id=$id";
        } else {
            $sql = "UPDATE onlinebidding SET username='$name', email='$email' WHERE id=$id";
        }
        
        $result = mysqli_query($conn, $sql);
        
        if($result) {
            $success = "Record updated successfully!";
        } else {
            $error = "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Update User Information</h2>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <!-- Added hidden input for ID -->
                    <input type="hidden" name="id" value="<?php echo isset($_GET['updateid']) ? $_GET['updateid'] : ''; ?>">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password </label>
                        <input type="password" class="form-control" name="password" placeholder="Enter new password">
                    </div>
                    
                    <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
                </form>
                
                <div class="text-center mt-3">
                    <a href="login.php" class="btn btn-secondary">Back to Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>