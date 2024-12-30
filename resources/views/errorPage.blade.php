<!-- resources/views/errorPage.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #f44336;
            font-size: 24px;
        }

        p {
            color: #333;
            font-size: 16px;
        }

        .btn {
            background-color: #f44336;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Access Denied</h1>
    <p>{{ session('error_message') }}</p>
    <a href="{{ url('/') }}" class="btn">Go Back to Home</a>
</div>

</body>
</html>
<!-- resources/views/errorPage.blade.php -->
<script>
    // Menampilkan pesan toast setelah halaman dimuat
    window.onload = function() {
        var message = "{{ session('error_message') }}";
        if (message) {
            var toast = document.createElement("div");
            toast.style.position = "fixed";
            toast.style.bottom = "30px";
            toast.style.left = "50%";
            toast.style.transform = "translateX(-50%)";
            toast.style.backgroundColor = "#f44336";
            toast.style.color = "#fff";
            toast.style.padding = "15px";
            toast.style.borderRadius = "5px";
            toast.style.boxShadow = "0 4px 6px rgba(0, 0, 0, 0.1)";
            toast.style.fontSize = "16px";
            toast.innerHTML = message;

            document.body.appendChild(toast);

            // Hapus toast setelah 5 detik
            setTimeout(function() {
                toast.remove();
            }, 5000);
        }
    };
</script>
