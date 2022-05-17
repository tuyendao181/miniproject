


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/jmessages.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    @yield('asset_header')
    <title></title>
</head>
<body>
    <div id="login">
        <form name='form-login'>
            <input type="text" id="email" placeholder="Email">
            <input type="password" id = "password" placeholder="Password">
            <!-- <input type="submit" value="Login" id="login"> -->
            <button type="submit" value="Login" id="sub_login">Login</button>
          </form>
      </div>
    
    <!-- jQuery library -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- jQuery jquery-tabledit -->
    <script src="js/jquery-tabledit-1.2.3/jquery.tabledit.min.js"></script>
    <!-- bootstrap JavaScript -->
    <script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- jQuery index -->
    <!-- <script src="js/main.js"></script> -->
    <script src="js/jmessages.js"></script>
    <script src="js/ansplugin.js"></script>
    <!-- <script src="js/list-message.js"></script> -->
    <script src="js/common.js"></script>
    <script src="js/auth.js"></script>
   
</body>

</html>