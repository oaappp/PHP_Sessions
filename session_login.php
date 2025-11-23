<?php
session_start();

$action = $_GET['action'] ?? '';

if ($action === 'logout') {
    session_destroy();
    header('Location: session_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Simulated user check (in real app, use database and hashing)
    if ($username === 'user' && $password === 'pass') {
        $_SESSION['user'] = $username;
        session_regenerate_id(true); // Prevent fixation
        header('Location: session_login.php?action=dashboard');
        exit;
    } else {
        $error = 'Invalid credentials'; 
    }
}

if ($action === 'dashboard' && isset($_SESSION['user'])) {
    // Dashboard content
    echo '<!DOCTYPE html><html><head><title>Dashboard</title></head><body>';
    echo '<h1>Welcome, ' . htmlspecialchars($_SESSION['user']) . '!</h1>';
    echo '<a href="session_login.php?action=logout">Logout</a>';
    echo '</body></html>';
    exit;
}

// Default: Login form
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <form method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>
