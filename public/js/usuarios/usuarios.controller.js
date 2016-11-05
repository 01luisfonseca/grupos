(function(){
	'use strict';
	angular
		.module('escuela')
		.controller('usuariosCtrl',controller);
	function controller(animPage, UsersFactory, $timeout){
		var vm=this;

		// Variables
		vm.buscado="";
		vm.users={};
		vm.panel=1;

		// Funciones
		vm.buscarTexto=buscarTexto;
		vm.hayUsuarios=hayUsuarios;
		vm.selecPanel=selecPanel;
		vm.panelEleg=panelEleg;

		// Lanzamiento Automático
		animPage.show('usuarios',function(){});

		///////////////////////////
		function buscarTexto(){
			if(vm.buscado.length>2){
				$timeout(buscarUsuario,500);
			}
			return false;
		}
		function buscarUsuario(){
			return getSearchUsers.then(function(){
				console.log(vm.users);
			});
		}
		function getSearchUsers(){
			return UsersFactory.getSearchUsers(vm.buscado).then(function(res){
				vm.users=res;
				return vm.users;
			});
		}

		function hayUsuarios(){
			if (typeof(vm.users.data)=='object' || typeof(vm.users.data)=='array') {
				return true;
			}else{
				return false;
			}
		}

		function selecPanel(id){
			vm.panel=id;
			//console.log(id);
		}

		function panelEleg(id){
			if (vm.panel==id) {
				return true;
			}
			return false;
		}
	}
})();