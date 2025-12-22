<html>
    <head>
<style>
    body {
        background-color: #f2f6fc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
        max-width: 600px;
    }
    h1 {
        text-align: center;
        color: #0d6efd;
        margin-bottom: 30px;
        font-weight: 700;
    }
    .form-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    .form-label {
        color: #495057;
        font-weight: 600;
    }
    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }
    .error {
        font-size: 0.9em;
        color: #dc3545;
        margin-top: 5px;
    }
    .warning {
        font-size: 0.9em;
        color: #fd7e14;
        margin-top: 5px;
    }
    .btn-submit {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
        font-weight: 600;
        padding: 10px 30px;
        border-radius: 8px;
        transition: background-color 0.3s, transform 0.2s;
    }
    .btn-submit:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
    }
</style>
    </head>
    <body>
        @yield('content')

        
    </body>
</html>