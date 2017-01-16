(function(){
	'use strict';
	angular.module('app')
	.factory('TUFactory',factory);

	function factory(RestFactory){
		var url='/api/tuser';
        RestFactory.sU(url);
        return RestFactory;

        /////////////////   
	}
})();