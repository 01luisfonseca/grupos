(function(){
	'use strict';
	angular
		.module('escuela')
		.controller('profileCtrl',controller);
	function controller(animPage,perfil){
		var vm=this;

		// Variables
		vm.id=perfil.getId();
	
		// Funciones

		// Lanzamiento Automático
		animPage.show('profile',function(){});

		///////////////////////////
	}
})();