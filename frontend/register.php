<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="register-container text-center">
        <form onsubmit="event.preventDefault(); register();">
            <h2 class="mb-4">Create a New Account</h2>
            
            <!-- Name Field -->
            <div class="mb-3 text-start">
                <label class="form-label">Name</label>
                <input type="text" id="name" class="form-control" placeholder="Enter your name" required>
            </div>
            
            <!-- Email Field -->
            <div class="mb-3 text-start">
                <label class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            
            <!-- Password Field -->
            <div class="mb-3 text-start">
                <label class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            
            <!-- Confirm Password Field -->
            <div class="mb-3 text-start">
                <label class="form-label">Confirm Password</label>
                <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm your password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p id="error" class="text-danger mt-2"></p>
            <p class="mt-3">Already have an account? <a href="login.html" class="text-primary">Login</a></p>
        </form>
    </div>

<script>
    const apiBase = "http://127.0.0.1:8000/api/";

    function register() {
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        if (password !== confirmPassword) {
            document.getElementById("error").textContent = "Passwords do not match.";
            return;
        }

        fetch(apiBase + "register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ name, email, password })
        })
        .then(res => res.json().then(data => ({ status: res.status, body: data })))
        .then(({ status, body }) => {
            if (status === 201) {
                alert("Registration successful!");
                window.location.href = "index.html";
            } else {
                document.getElementById("error").textContent = body.message || "Error during registration";
            }
        })
        .catch(() => {
            document.getElementById("error").textContent = "Error connecting to the server";
        });
    }
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
