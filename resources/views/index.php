<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/ico" href="/favicon.ico">

        <title>Escuela</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="/js/node_modules/bootstrap/dist/css/bootstrap.min.css">
        
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
        
        
        <!-- Frontend -->
        <script src='/js/index.js'></script>
        <script src='/js/index.config.js'></script>
        <script src='/js/index.core.js'></script>
        <script src='/js/index.router.js'></script>
        <script src='/js/index.presentacion.js'></script>
        <script src='/js/app.services/oauth.value.js'></script>
        <script src='/js/app.services/auth.factory.js'></script>

        <!-- Modulos -->
        <script src='/js/layout/menu.directive.js'></script>
        <script src='/js/login/login.controller.js'></script>
        
    </head>
    <body ng-app="escuela">
        <div class="container-fluid">
            <div menu-dir></div>
            <div class="row">
                <div ui-view></div>
            </div>
        </div>
    </body>
</html>
