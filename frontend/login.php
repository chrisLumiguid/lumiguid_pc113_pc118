<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="login-container text-center">
        <form onsubmit="event.preventDefault(); login();">
            <h2 class="mb-4">Sign in to your account</h2>
            <div class="mb-3 text-start">
                <label class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p id="error" class="text-danger mt-2"></p>
            <p class="mt-3">Don't have an account? <a href="register.php" class="text-primary">Register</a></p>
        </form>
    </div>


    <script>
        const apiBase = "http://127.0.0.1:8000/api/";

        function login() {
            fetch(apiBase + "login", {
                method: "POST",
                headers: { "Content-Type": "application/json", "Accept": "application/json" },
                body: JSON.stringify({ email: email.value, password: password.value })
            })
            .then(res => res.json().then(data => ({ status: res.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200) {
                    alert("Login successful!");
                    window.location.href = "index.php";
                } else {
                    error.textContent = body.message || "Invalid email or password";
                }
            })
            .catch(() => error.textContent = "Error connecting to the server");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
