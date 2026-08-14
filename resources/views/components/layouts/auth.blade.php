<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'EcoEntrega' }}</title>
    <style>
        *{box-sizing:border-box}body{margin:0;font-family:Arial,sans-serif;background:#ecfdf5;color:#1c1917}.top{padding:24px 7%;font-weight:900;color:#065f46;font-size:20px}.wrap{min-height:calc(100vh - 76px);display:grid;place-items:center;padding:24px}.card{width:min(100%,480px);background:white;padding:36px;border-radius:22px;box-shadow:0 18px 55px #064e3b21}.eyebrow{color:#047857;font-size:13px;font-weight:bold;text-transform:uppercase;letter-spacing:.12em}.card h1{margin:8px 0 8px;font-size:30px}.card>p{color:#57534e;line-height:1.5}.field{margin-top:18px}.field label{display:block;margin-bottom:7px;font-size:14px;font-weight:bold}.field input{width:100%;padding:13px;border:1px solid #d6d3d1;border-radius:10px;font:inherit}.field input:focus{outline:2px solid #34d399;border-color:#047857}.btn{width:100%;border:0;border-radius:10px;background:#047857;color:white;margin-top:26px;padding:14px;font:inherit;font-weight:bold;cursor:pointer}.btn:hover{background:#065f46}.foot{text-align:center;color:#57534e;font-size:14px;margin:20px 0 0}.foot a{color:#047857;font-weight:bold;text-decoration:none}.error{margin-top:16px;border-radius:10px;background:#fef2f2;color:#b91c1c;padding:12px;font-size:14px}.check{display:flex;gap:9px;align-items:center;margin-top:17px;font-size:14px}.check input{width:auto}.hint{font-size:12px;color:#78716c;margin-top:6px}
    </style>
</head>
<body>
    <a class="top" href="{{ route('home') }}">♻ EcoEntrega</a>
    <main class="wrap">{{ $slot }}</main>
</body>
</html>
