(function(){
	'use strict';
	angular
		.module('escuela')
		.directive('usuario',directive);
	function directive(animPage){
		var vm=this;

		// Funciones

		// Lanzamiento Automático
		animPage.show('usuario',function(){});
	}
})();