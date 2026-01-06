<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            background: #fff;
            padding: 30px;
            width: 320px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,.2);
        }

        input,
        button {
            width: 100%;
            height: 44px;              /* ⬅️ kunci utama */
            padding: 0 12px;
            margin-top: 12px;
            font-size: 14px;
            border-radius: 6px;
            font-family: inherit;
        }

        input {
            border: 1px solid #ccc;
        }

        button {
            background: #2E6F4E;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #255c41;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
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
        <button type="submit">LOGIN</button>
    </form>
</div>

</body>
</html>
