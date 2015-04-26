<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="/bower_components/uikit/css/uikit.gradient.min.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <style>
        .uk-modal-dialog>.uk-close:first-child {
            margin: -15px -9px 0 0;
            float: right;
            font-size: 40px;
        }
        </style>
    </head>
    <body>
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="/bower_components/yepnope/dist/yepnope-2.0.0.min.js"></script>
        <script src="/bower_components/uikit/js/uikit.min.js"></script> 
        <script src="/bower_components/juk/juk.js"></script>        

        
        <nav class="uk-navbar">

            <ul class="uk-navbar-nav">
                <li><a href="#left-panel" data-uk-offcanvas><i class="uk-icon-cog"></i> Компоненты</a></li>
            </ul>
            
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav">
                    <li><a href="#right-panel" class="uk-ico-bars" data-uk-offcanvas>Управление <i class="uk-icon-bars"></i></a></li>
                </ul>
            </div>
            
        </nav>

        <div id="left-panel" class="uk-offcanvas">
            <div class="uk-offcanvas-bar">

                <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>
                    <li class="uk-parent">
                        <a href="#"><i class="uk-icon-unlock-alt"></i> Безапастность</a>
                        <ul style="margin-left:15px" class="uk-nav-sub">
                            <li><a href="/lara/user"><i class="uk-icon-user"></i> Пользователи</a></li>
                            <li><a href=""><i class="uk-icon-users"></i> Роли</a></li>
                            <li><a href=""><i class="uk-icon-key"></i> Доступы</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="/lara/page"><i class="uk-icon-file-o"></i> Страници</a>
                    </li>
                    
                    <li>
                        <a href="/lara/menu"><i class="uk-icon-tree"></i> Дерево (меню)</a>
                    </li>
                    
                    <li>
                        <a href="/auth/logout"><i class="uk-icon-sign-out"></i> Выход</a>
                    </li>
                    
                    
                </ul>

            </div> 
        </div>    
        
        <div id="right-panel" class="uk-offcanvas">
            <div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
                <div class="uk-panel">
                    @section('right_panel')
                        [ПУСТО]
                    @show
                </div>
            </div>
        </div> 
        
        <style>
            .container{
                max-width: 960px;
                margin: auto;
            }
        </style>
        
        <div class="container">
            <div class="uk-grid">

                <div class="uk-width-medium-1-1">
                    @section('content')
                        
                    @show
                </div>
            </div>
	</div>
        @section('script')
        
        @show
    </body>
</html>