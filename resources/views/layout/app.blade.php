<html>
    <head>
<style>
    body {
        background-color: #f8f9fa; /* خلفية فاتحة */
    }
    .form-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        max-width: 600px;
        margin: 50px auto;
    }
    h1 {
        color: #343a40;
        text-align: center;
        margin-bottom: 30px;
    }
    .form-label {
        color: #495057;
    }
    .error {
        font-size: 0.9em;
        color: #dc3545; 
        margin-top: 5px;
    }
    .btn-submit {
        
        width: 30%;
        font-weight: bold;
        background-color: #0d6efd;
        border-color: #0d6efd;
       
    }
    .btn-submit:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
</style>
    </head>
    <body>
        @yield('content')

        
    </body>
</html>