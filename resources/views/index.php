<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/ico" href="/favicon.ico">

        <title>Aplicación generica</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="/js/node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/ng_animation.css">
        
        <!-- Scripts -->
        <script src='/js/node_modules/angular/angular.min.js'></script>
        <script src="/js/node_modules/angular-cookies/angular-cookies.min.js"></script>
        <script src="/js/node_modules/query-string/query-string.js"></script>
        <script src='/js/node_modules/angular-animate/angular-animate.min.js'></script>
        <script src='/js/node_modules/angular-middleware/dist/angular-middleware.min.js'></script>
        <script src='/js/node_modules/angular-sanitize/angular-sanitize.min.js'></script>
        <script src='/js/node_modules/angular-ui-router/release/angular-ui-router.min.js'></script>
        <script src='/js/node_modules/jquery/dist/jquery.min.js'></script>
        <script src='/js/node_modules/bootstrap/dist/js/bootstrap.min.js'></script>
        <script src='/js/node_modules/ngstorage/ngStorage.min.js'></script>
        <script src='/js/assets/tm/TweenMax.min.js'></script>
        
        
        <!-- Frontend -->
        <script src='/js/index.js'></script>
        <script src='/js/index.config.js'></script>
        <script src='/js/index.core.js'></script>
        <script src='/js/index.router.js'></script>
        <script src='/js/index.presentacion.js'></script>
        <script src='/js/app.services/restfn.factory.js'></script>
        <script src='/js/app.services/oauth.value.js'></script>
        <script src='/js/app.services/auth.factory.js'></script>
        <script src='/js/app.services/animPages.service.js'></script>
        <script src='/js/app.services/animMsj.service.js'></script>
        <script src='/js/app.services/perfil.service.js'></script>
        <script src='/js/app.services/users.factory.js'></script>
        <script src='/js/app.services/tusers.factory.js'></script>
        <script src='/js/app.services/options.factory.js'></script>
        <script src='/js/app.services/eventlog.factory.js'></script>

        <!-- Modulos -->
        <script src='/js/layout/menu.directive.js'></script>
        <script src='/js/login/login.controller.js'></script>
        <script src='/js/authhome/authhome.controller.js'></script>
        <script src='/js/users/users.controller.js'></script>
        <script src='/js/users/userInfo.controller.js'></script>
        <script src='/js/users/user.directive.js'></script>
        <script src='/js/users/profile.controller.js'></script>
        <script src='/js/options/options.controller.js'></script>
        
    </head>
    <body ng-app="app">
        <div class="container-fluid">
            <div ui-view='menu'></div>
            <div class="row">
                <div ui-view='body'></div>
            </div>
        </div>
    </body>
</html>
