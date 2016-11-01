(function(){
	'use strict';
	angular
		.module('escuela')
		.controller('usuariosCtrl',controller);
	function controller(animPage){
		var vm=this;

		// Variables
		vm.buscado="";
		vm.users={};

		// Funciones
		vm.buscarTexto=buscarTexto;
		vm.hayUsuarios=hayUsuarios;

		// Lanzamiento Automático
		animPage.show('usuarios',function(){});

		///////////////////////////
		function buscarTexto(){}

		function hayUsuarios(){
			if (typeof(vm.users.data)=='object' || typeof(vm.users.data)=='array') {
				return true;
			}else{
				return false;
			}
		}
	}
})();