<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ERROR | 404 Not Found </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin RTL Theme #1 for 404 page option 3" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{asset('control/assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('control/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('control/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('control/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('control/assets/global/css/components-rtl.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('control/assets/global/css/plugins-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{asset('control/assets/pages/css/error-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" page-404-3">
        <div class="page-inner">
            <img width="20%"  src="http://nick.mtvnimages.com/nick/nick-web/error/404-sb-web.png?width=250&quality=0.6" alt="404 Page not Found" class="img-responsive" ></div>
        <div class="container error-404">
            <h1>404</h1>
            <h2>Houston, we have a problem.</h2>
            <p> Actually, the page you are looking for does not exist. </p>
            <p>
                <a href="{{url('/')}}" class="btn red btn-outline"> Return home </a>
                <br> 
            </p>
        </div>
        
        <script src="{{asset('control/assets/global/plugins/respond.min.js')}}"></script>
        <script src="{{asset('control/assets/global/plugins/excanvas.min.js')}}"></script> 
        <script src="{{asset('control/assets/global/plugins/ie8.fix.min.js')}}"></script> 

                <!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('control/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('control/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('control/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('control/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('control/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('control/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('control/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> ERROR | 404 Not Found </title>
</head>
<style>
    :root{
        --backColor : #ff8c57de;
        --textColor : #ffffff;
        --backColorHover : #f8773ce3 ;
        --padding_10px : 10px;
    }
    body{
        padding: 0px;
        margin: 0px auto;
        box-sizing: border-box;
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        
    }
    .contaner{  
        padding: 5px;
        margin: 5px;

    }
    .contaner>.row:first-child{
        padding: var(--padding_10px);
        margin: 20px auto ; 
        text-align: center;
        background-color: var(--backColor); 
        border-radius: 150px 150px 0px 0px ;
        width: 40vw; 
    }
    .contaner>.row{
        padding: var(--padding_10px);
        margin: 20px auto ; 
        text-align: center;
        background-color: var(--backColor); 
        border-radius: 10px 30px; 
        border-radius:  0px 0px 150px 150px ;
        width: 40vw; 
    }
   
    .contaner>.row>h1{
        color: var(--textColor);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-shadow: 15px;
    }
    .contaner>img{
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        padding: 0 25%;
        margin-top: -60px;
        margin-bottom: -60px;
    }
    
    .contaner>.row>h1>a{
        padding: var(--padding_10px);
        border-radius: 20px ; 
        color: var(--textColor);
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-decoration: none;
    }
    .contaner>.row>h1>a:hover{
        outline: none;
        background-color: var(--backColorHover);
        padding: var(--padding_10px);
        transition: ease-in-out 0.75s ;
        text-decoration: none;
        
    }
    a:focus{
        outline: none;
        background-color: var(--backColorHover);
        padding: var(--padding_10px);
        transition: ease-in-out 0.75s ;
        text-decoration: none;
    }
    .mainError{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column ;
    }
  
    
</style>
<body>
    <div class="mainError">
        <div class="contaner">
            <div class="row">
                <h1><strong>404</strong></h1>
            </div>
        </div>
        <div class="contaner">
            <img  src="http://nick.mtvnimages.com/nick/nick-web/error/404-sb-web.png?width=250&quality=0.6" alt="404 Page not Found">
            <div class="row">
                <h1>This Page not found go <a href="{{url('/')}}">to Home </a></h1>
            </div>
        </div>
    </div>
</body>
</html> --}}