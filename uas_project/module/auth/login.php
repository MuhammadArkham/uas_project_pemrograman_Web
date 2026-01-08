<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $db = new Database();
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        echo "<script>alert('Selamat Datang di Arkham Store!'); window.location.href='index.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Username atau Password Salah!</div>";
    }
}
?>
<div class="row justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-4">
        <div class="card card-space p-4">
            <div class="text-center mb-4">
                <h3 style="font-family: 'Orbitron'; color: var(--neon-teal);">SYSTEM ACCESS</h3>
            </div>
            <form method="POST">
                <div class="mb-3">
                    <label class="text-muted">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="text-muted">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" name="login" class="btn btn-teal">LOGIN SYSTEM</button>
                </div>
            </form>
        </div>
    </div>
</div>