/* menu.directive.js */

/**
* @desc Presentación de menu de angular ui-router
* @example <div menu-dir></div>
*/
(function(){
	'use strict';
	angular
		.module('app')
		.directive('menuDir',directive);
	function directive(){
		var directive = {
        	link: link,
        	templateUrl: '/js/layout/menu.html',
        	restrict: 'EA',
        	controller: controller,
        	controllerAs:'vm'
    	};
    	return directive;

    	function link(scope, element, attrs) {
      	/* */
    	}
    	function controller($http,$localStorage,perfil,$interval){
    		var vm=this;

            // Variables
            vm.usuario={};

            // Functiones
            vm.existeStorage=existeStorage;
            vm.nombreUser=nombreUser;

            // Automaticas

            /////////////
            function existeStorage(){
                if(typeof($localStorage.currentUser)=='object'){
                    return true;
                }
                return false;
            }
            function nombreUser(){
                return perfil.getInfo().name;
            }
    	}
	}
})();