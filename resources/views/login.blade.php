<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3f4f6;
      font-family: 'Segoe UI', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
      padding: 40px 30px;
      width: 100%;
      max-width: 400px;
    }

    .login-title {
      font-weight: 600;
      font-size: 1.5rem;
      color: #1e3a8a; /* Warna biru gelap seperti di gambar */
      margin-bottom: 25px;
      text-align: center;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px;
    }

    .btn-login {
      background-color: #1e3a8a; /* Warna biru gelap */
      border: none;
      border-radius: 10px;
      font-weight: 600;
      padding: 12px;
      color: #ffffff;
    }

    .btn-login:hover {
      background-color: #1c357d;
      color: #ffffff;
    }

    .footer-text {
      text-align: center;
      font-size: 0.85rem;
      color: #9ca3af;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2 class="login-title">Login</h2>

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="" method="POST">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-login">Login</button>
      </div>
    </form>

    <div class="footer-text">
      &copy; {{ date('Y') }} Pemasangan Wifi
    </div>
  </div>
</body>
</html>
