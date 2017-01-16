(function(){
	'use strict';
	angular
		.module('app')
		.controller('authHomeCtrl',controller);
	function controller(animPage,EventlogFactory){
		var vm=this;

		// Variables
		vm.registros={};
		vm.mostrar={
			log:false
		};

		// Funciones
		vm.getRegistros=getRegistros;
		vm.toogleLog=toogleLog;

		// Lanzamiento Automático
		animPage.show('authhome',function(){});
		vm.getRegistros();

		/////////////////////////////////////////
		function getRegistros(){
			return EventlogFactory.gUR().then(function(res){
				vm.registros=res;
			});
		}
		function toogleLog(){
			vm.mostrar.log= !vm.mostrar.log;
		}

	}
})();