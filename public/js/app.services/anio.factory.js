(function(){
	'use strict';
	angular.module('escuela')
	.factory('UsersFactory',factory);

	function factory($http){
		var fc={
			getAnio: getAnio,
			getAnios: getAnios,
            addAnio: addAnio,
			modAnio: modAnio,
            delAnio: delAnio,
		};

		return fc;

		/////////////////
        function getAnio(id){}
        function getAnios(first){}
        function addAnio(data){}
        function modAnio(id,data){}
        function delAnio(id){}
	}
})();