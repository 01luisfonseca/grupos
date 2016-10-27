/* menu.directive.js */

/**
* @desc Presentación de menu de angular ui-router
* @example <div menu-dir></div>
*/
(function(){
	'use strict';
	angular
		.module('escuela.presentacion')
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
    	function controller($http){
    		var vm=this;
    	}
	}
})();