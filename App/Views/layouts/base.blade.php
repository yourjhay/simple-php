<!doctype html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<style>
    body {
        color: #76787a;
    }
    .header{
        font-size: 60px;
        width:auto;
        text-align:center;
        margin-top:20%;
        font-weight: bold;
    }
    .text {
        text-align: center;
        font-size:30px;
    }
    footer{
        text-align:center;
    }
    a {
        text-decoration: none;
        color:#76787a;
    }
</style>
<body>
    <nav>
        | <a href="/">Home</a> |  
    </nav>
 @yield('content')
   <footer>
    <strong><a target="_blank" href="https://github.com/jhayann/simple-php">https://github.com/jhayann/simple-php</a></strong>
 </footer>
</body>
</html>