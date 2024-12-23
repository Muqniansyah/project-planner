<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project Planner</title>
  <!-- icons font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    /* Reset CSS */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Global Styles */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('../images/background.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-attachment: fixed;
    }

    .container {
      text-align: center;
      max-width: 700px;
      padding: 2rem;
      background: rgba(255, 255, 255, 0.1); /* Putih transparan */
      backdrop-filter: blur(10px); /* Efek blur */
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .logo {
      margin-bottom: 1rem;
    }

    .logo img {
      width: 100px;
      height: auto;
    }

    .title {
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 1rem;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .subtitle {
      font-size: 1.2rem;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    .btn-group {
      margin-top: 2rem;
    }

    .btn {
      display: inline-block;
      padding: 0.75rem 2rem;
      margin: 0.5rem;
      border-radius: 50px;
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      font-size: 1rem;
      transition: transform 0.3s, background 0.3s;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .btn-login {
      background: #ff5722;
    }

    .btn-login:hover {
      background: #e64a19;
      transform: translateY(-3px);
    }

    .btn-register {
      background: #4caf50;
    }

    .btn-register:hover {
      background: #388e3c;
      transform: translateY(-3px);
    }

    /* Footer */
    .footer {
      margin-top: 2rem;
      font-size: 0.9rem;
      color: #fff;
    }

    .footer a {
      color: #ffeb3b;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .title {
        font-size: 2.5rem;
      }

      .subtitle {
        font-size: 1rem;
      }

      .btn {
        padding: 0.6rem 1.5rem;
        font-size: 0.9rem;
      }
    }

    @media (max-width: 480px) {
      .title {
        font-size: 2rem;
      }

      .subtitle {
        font-size: 0.9rem;
      }

      .btn {
        padding: 0.5rem 1.2rem;
        font-size: 0.8rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Logo -->
    <div class="logo">
      <i class="text-blue-500 fas fa-tasks fa-4x"></i>
    </div>


    <!-- Title -->
    <h1 class="title">Project Planner</h1>

    <!-- Subtitle -->
    <p class="subtitle">
      Atur, rencanakan, dan kelola proyek Anda dengan mudah dan efisien.
      Mulailah perjalanan Anda menuju produktivitas yang lebih tinggi dengan
      fitur-fitur canggih kami.
    </p>

    <!-- Buttons -->
    <div class="btn-group">
      <a href="{{ route('login') }}" class="btn btn-login">Log In</a>
      {{-- <a href="{{ route('register') }}" class="btn btn-register">Register</a> --}}

    </div>

    <!-- Footer -->
    <div class="footer">
      <p>&copy; 2024 Project Planner. <a href="#">Terms of Service</a> | <a href="#">Privacy Policy</a></p>
    </div>
  </div>
</body>
</html>
