<?php
session_start();

$step = $_GET['step'] ?? '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step === '1') {
        $_SESSION['name'] = $_POST['name'] ?? '';
        header('Location: session_form.php?step=2');
        exit;
    } elseif ($step === '2') {
        $_SESSION['email'] = $_POST['email'] ?? '';
        header('Location: session_form.php?step=complete');
        exit;
    }
}

if ($step === 'complete') {
    // Process data (e.g., save to DB), then clear
    $name = $_SESSION['name'] ?? 'Unknown';
    $email = $_SESSION['email'] ?? 'Unknown';
    session_destroy();
    echo '<!DOCTYPE html><html><head><title>Complete</title></head><body>';
    echo '<h1>Submitted: Name = ' . htmlspecialchars($name) . ', Email = ' . htmlspecialchars($email) . '</h1>';
    echo '</body></html>';
    exit;
}

// Form steps
?>
<!DOCTYPE html>
<html>
<head><title>Form Step <?php echo $step; ?></title></head>
<body>
    <?php if ($step === '1'): ?>
        <form method="post">
            Name: <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['name'] ?? ''); ?>">
            <button type="submit">Next</button>
        </form>
    <?php elseif ($step === '2'): ?>
        <form method="post">
            Email: <input type="text" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>">
            <button type="submit">Complete</button>
        </form>
        <a href="session_form.php?step=1">Back</a>
    <?php endif; ?>
</body>
</html>
