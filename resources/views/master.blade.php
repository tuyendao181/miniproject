

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/jquery-ui-git.css">
    <link rel="stylesheet" href="css/jmessages.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    @yield('asset_header')
    <title></title>
</head>
<body>
     <div class="main_wap openNav">
         @include('menu')
         
             <div class="new-wrapper">
            <div id="main" class="">
                <div id="main-contents">
                    
                        @yield('content')
                </div>
            </div>
             </div>
     </div>
    
    <!-- jQuery  -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- jQuery jquery-ui -->
    <script src="js/jquery-ui.js"></script>
    <!-- jQuery jquery-ui -->
   
    <script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- jQuery index -->
    <script src="js/select2.min.js"></script>
    <script src="js/jmessages.js"></script>
    <script src="js/ansplugin.js"></script>
    <!-- <script src="js/list-message.js"></script> -->
    <script src="js/common.js"></script>
    @yield('asset_footer')
   
    
   
</body>

</html>