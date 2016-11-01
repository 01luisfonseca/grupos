(function(){
	'use strict';
	angular
		.module('escuela')
		.controller('authHomeCtrl',controller);
	function controller(animPage){
		var vm=this;

		// Funciones

		// Lanzamiento Automático
		animPage.show('authhome',function(){});
	}
})();