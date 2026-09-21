<?php
session_start();

$error = '';

// Handle Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Handle Login Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Mock credentials for demonstration (Replace with database check later)
    $valid_email = 'admin@example.com';
    $valid_password = 'password123';

    if ($email === $valid_email && $password === $valid_password) {
        // Set session variables upon successful login
        $_SESSION['user_email'] = $email;
        $_SESSION['logged_in'] = true;
        header('Location: login.php');
        exit;
    } else {
        $error = 'Invalid email address or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333333;
            text-align: center;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555555;
            font-size: 14px;
            fontWeight: 600;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }
        .input-group input:focus {
            border-color: #667eea;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #667eea;
            border: none;
            border-radius: 6px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn:hover {
            background: #5a6fd6;
        }
        .error-msg {
            background: #ffe6e6;
            color: #d9534f;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }
        .dashboard {
            text-align: center;
        }
        .dashboard p {
            margin-bottom: 20px;
            color: #444;
        }
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #d9534f;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
        }
        .logout-btn:hover {
            background: #c9302c;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <!-- Dashboard View (Shown when logged in) -->
            <div class="dashboard">
                <h2>Welcome!</h2>
                <p>You are logged in as: <strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong></p>
                <a href="login.php?logout=true" class="logout-btn">Log Out</a>
            </div>
        <?php else: ?>
            <!-- Login Form View (Shown when logged out) -->
            <h2>Sign In</h2>
            
            <?php if (!empty($error)): ?>
                <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="admin@example.com" required>
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="password123" required>
                </div>

                <button type="submit" class="btn">Log In</button>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>