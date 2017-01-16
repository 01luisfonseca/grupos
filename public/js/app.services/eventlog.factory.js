(function(){
	'use strict';
	angular.module('app')
	.factory('EventlogFactory',factory);

	function factory(RestFactory){
        var url='/api/eventlog';
        RestFactory.sU(url);
		return RestFactory;

		/////////////////        
	}
})();