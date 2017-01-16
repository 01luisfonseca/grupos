(function(){
	'use strict';
	angular.module('app')
	.factory('OptionsFactory',factory);

	function factory(RestFactory){
        var url='/api/options';
        RestFactory.sU(url);
		return RestFactory;

		/////////////////        
	}
})();