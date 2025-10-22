<?php
include 'connect.php';
session_start();

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = '';
$nameErr = '';
$name = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if CSRF token is present and valid
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $error = "Invalid CSRF token";
    } else {
        // Validate username
        if (empty($_POST["username"])) {
            $nameErr = "Username is required";
        } else {
            $name = trim($_POST["username"]);
        }

        // Validate password
        if (empty($_POST["userpassword"])) {
            $error = "Password is required";
        } else {
            $password = $_POST["userpassword"];
        }

        // Proceed if no validation errors
        if (empty($nameErr) && empty($error)) {
            // Debug: Check what username we're searching for
            error_log("Searching for username: " . $name);
            
            $stmt = $conn->prepare("SELECT id, username, userpassword FROM onlinebidding WHERE username = ?");
            if ($stmt === false) {
                $error = "Database error: " . $conn->error;
            } else {
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $result = $stmt->get_result();

                // Debug: Check how many rows were found
                error_log("Number of rows found: " . $result->num_rows);
                
                if ($result->num_rows === 1) {
                    $user = $result->fetch_assoc();
                    
                    // Debug: Check what we found
                    error_log("User found - ID: " . $user['id'] . ", Username: " . $user['username']);
                    
                    if (password_verify($password, $user['userpassword'])) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username']; // Use the username from database
                        header("Location: profile.php");
                        exit();
                    } else {
                        $error = "Incorrect password";
                    }
                } else {
                    $error = "Incorrect username - User not found in database";
                }
                $stmt->close();
            }
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center mb-4">Login</h2>

        <?php if (!empty($error)): ?>
          <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text"
                   class="form-control <?php echo !empty($nameErr) ? 'is-invalid' : ''; ?>"
                   name="username"
                   id="username"
                   value="<?php echo htmlspecialchars($name); ?>">
            <?php if (!empty($nameErr)): ?>
              <div class="invalid-feedback"><?php echo $nameErr; ?></div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="userpassword" class="form-label">Password</label>
            <input type="password" name="userpassword" class="form-control" id="userpassword">
          </div>

          <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="d-flex justify-content-between mt-3">
          <a href="register.php">New register</a>
          <a href="forgot.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>