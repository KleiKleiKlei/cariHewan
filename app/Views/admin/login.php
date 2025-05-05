<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #1a1a1a;
            font-family: 'Space Mono', monospace;
            color: #00ff00;
        }

        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #2a2a2a;
            border: 2px solid #00ff00;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        .login-title {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .form-control {
            background: #333;
            border: 1px solid #00ff00;
            color: #00ff00;
            font-family: 'Space Mono', monospace;
        }

        .form-control:focus {
            background: #333;
            border-color: #00ff99;
            color: #00ff00;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.2);
        }

        .btn-login {
            background: #00ff00;
            border: none;
            color: #1a1a1a;
            font-weight: 700;
            padding: 0.75rem;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #00ff99;
            transform: translateY(-2px);
        }

        .terminal-effect::before {
            content: '>';
            color: #00ff00;
            margin-right: 0.5rem;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        .cursor {
            display: inline-block;
            width: 10px;
            height: 20px;
            background: #00ff00;
            margin-left: 5px;
            animation: blink 1s infinite;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">ADMIN ACCESS<span class="cursor"></span></h2>
            
            <?php if(session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('supersecret/verify') ?>" method="post">
                <div class="form-group">
                    <div class="terminal-effect">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="terminal-effect">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-login">AUTHENTICATE</button>
            </form>
        </div>
    </div>
</body>
</html>