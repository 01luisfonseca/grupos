(function(){
	'use strict';
	angular
		.module('escuela')
		.controller('GenCtrl',controller);

	function controller(animPage,GeneralesFactory,$window,$interval){
		var vm=this;

		// Variables
		vm.opciones={};
		vm.newopcion={};
		vm.panel=0;
	
		// Funciones
		vm.getData=getData;
		vm.oculOptionElim=oculOptionElim;
		vm.delOption=delOption;
		vm.actOpcion=actOpcion;
		vm.newOpcion=newOpcion;
		vm.selecPanel=selecPanel;
		vm.esPanelSelec=esPanelSelec;
		vm.cerrarPanel=cerrarPanel;

		// Lanzamiento Automático
		animPage.show('generales',function(){});
		vm.getData();

		///////////////////////////
		function getData(){
			GeneralesFactory.gDts().then(function(res){
				vm.opciones=res;
			});
		}
		
		function oculOptionElim(index){
			if(index<4){
				return true;
			}
			return false;
		}
		
		function delOption(index){
			GeneralesFactory.dDt(vm.opciones.data[index].id).then(function(res){
				//console.log(res);
				vm.panel=0;
				vm.getData();
			});
		}
		
		function actOpcion(index){
			GeneralesFactory.mDt(vm.opciones.data[index].id,vm.opciones.data[index]).then(function(res){
				//console.log(res);
				vm.opciones.data[index].visible=false;
				vm.panel=0;
			});
		}

		function newOpcion(){
			GeneralesFactory.aDt(vm.newopcion).then(function(res){
				//console.log(res);
				vm.panel=0;
				vm.newopcion={};
				vm.getData();
			});
		}

		function selecPanel(index){
			vm.panel=index+1;
		}

		function esPanelSelec(index){
			return vm.panel==(index+1);
		}

		function cerrarPanel(){
			vm.panel=0;
			vm.getData();
		}
	}
})();