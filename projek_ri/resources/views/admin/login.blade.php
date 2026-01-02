<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: #fff;
            padding: 30px;
            width: 320px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,.2);
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
        }
        button {
            background: #2E6F4E;
            color: white;
            border: none;
            cursor: pointer;
        }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>

<div class="box">
    <h2>Login Admin</h2>

    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <form method="POST" action="/admin/login">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button>LOGIN</button>
    </form>
</div>

</body>
</html>