(function(){
	'use strict';
	angular
		.module('escuela')
		.controller('usuariosCtrl',controller);
	function controller(animPage, UsersFactory, $timeout){
		var vm=this;

		// Variables
		vm.buscado="";
		vm.yaBuscado=false;
		vm.buscando=false;
		vm.users={};
		vm.panel=1;

		// Funciones
		vm.buscarTexto=buscarTexto;
		vm.hayUsuarios=hayUsuarios;
		vm.actEstado=actEstado;
		vm.selecPanel=selecPanel;
		vm.panelEleg=panelEleg;

		// Lanzamiento Automático
		animPage.show('usuarios',function(){});

		///////////////////////////
		function buscarTexto(){
			if(vm.buscado.length>2){
				vm.buscando=true;
				if (!vm.yaBuscado) {
					vm.yaBuscado=true;
					$timeout(buscarUsuario,1000);
				}
			}
			return false;
		}
		function buscarUsuario(){
			vm.yaBuscado=false;
			return getSUsers().then(function(){
				//console.log(vm.users);
				vm.buscando=false;
			});
		}
		function getSUsers(){
			return UsersFactory.getSearchUsers(vm.buscado).then(function(res){
				vm.users=res;
				return vm.users;
			});
		}

		function hayUsuarios(){
			if (typeof(vm.users.data)=='object' || typeof(vm.users.data)=='array') {
				if (vm.users.data.length>0) {
					return true;
				}
			}else{
				return false;
			}
		}

		function actEstado(index){
			return UsersFactory.setEstado(vm.users.data[index].id,vm.users.data[index].estado).then(function(res){});
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