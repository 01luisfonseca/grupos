(function(){
	'use strict';
	angular
		.module('app')
		.controller('UserInfoCtrl',controller);
	function controller(animPage,$stateParams){
		var vm=this;

		// Variables
		vm.id=$stateParams.id;
	
		// Funciones

		// Lanzamiento Automático
		animPage.show('usuario',function(){});

		///////////////////////////
	}
})();