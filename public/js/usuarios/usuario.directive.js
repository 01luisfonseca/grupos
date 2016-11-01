(function(){
	'use strict';
	angular
		.module('escuela')
		.directive('usuario',directive);
	function directive(){
		var directive = {
        	link: link,
        	templateUrl: '/js/usuarios/usuario.html',
        	restrict: 'EA',
        	scope:{
        		nuevo:'=',
        		existente:'='
        	},
        	controller: controller,
        	controllerAs: 'vm',
        	bindToController: true // because the scope is isolated
    	};
    	return directive;

		// Funciones
		function link(scope, element, attrs) {
      		/* */
    	}

    	function controller(UsersFactory){
    		var vm=this;

    		// Variables
    		vm.user={};

    		// Funciones
    		vm.autoIni=autoIni;

    		// Lanzamiento Automático
			//animPage.show('usuario',function(){});
			vm.autoIni();

			//////////////////////// 
			function autoIni(){
				if (typeof(vm.nuevo)=='undefined') {
					if (typeof(vm.existente)=='undefined') {
						console.log('No se hace ninguna acción en el inicio del controlador de Usuario');
						return false;
					}
				}
			}
    	}
	}
})();