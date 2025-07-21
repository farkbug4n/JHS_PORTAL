
<?php
include 'db_connect.php';
session_start();

// Redirect if already logged in
if (isset($_SESSION['username'])) {
    $role = $_SESSION['role'];
    header("Location: {$role}.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insecure: direct SQL, no hashing, no prepared statements
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] == 'admin') {
            header("Location: admin.php");
        } elseif ($user['role'] == 'teacher') {
            header("Location: teacher.php");
        } elseif ($user['role'] == 'student') {
            header("Location: student.php");
        } else {
            $error = "Unknown user role.";
        }
        if (empty($error)) {
            exit();
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JHS Portal - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4" style="background-image: url('https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2074&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="max-w-md w-full relative z-10">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <img src="logo.jpg" alt="JHS Portal Logo" class="custom-logo mx-auto mb-4">
                <p class="text-gray-600 font-bold">Welcome back! Please sign in to your account.</p>
            </div>
            <?php if (!empty($error)) echo "<p class='text-red-500 text-center mb-4'>$error</p>"; ?>
            <form method="POST" class="space-y-6" autocomplete="on">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Username
                    </label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        required
                        autocomplete="username"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Enter your username"
                    >
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Enter your password"
                        >
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                            Show
                        </button>
                    </div>
                </div>
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 px-4 rounded-lg font-medium hover:from-blue-600 hover:to-indigo-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 focus:outline-none"
                >
                    Sign In
                </button>
                <div class="text-center mt-4">
                    <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                </div>
            </form>
        </div>
        <div class="text-center mt-6 relative z-10">
            <p class="text-xs text-white">
                © 2025 JHS Portal. All rights reserved.
            </p>
        </div>
    </div>
    <script>
    function togglePassword() {
        var pwd = document.getElementById("password");
        if (pwd.type === "password") {
            pwd.type = "text";
        } else {
            pwd.type = "password";
        }
    }
    </script>
</body>
</html>
