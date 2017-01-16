(function(){
	'use strict';
	angular.module('app')
	.factory('RestFactory',factory);

	function factory($http){
		var url= '';
		var fc={
			sU:sU,
			gDt: gDt,
			gDts: gDts,
            gSDt:gSDt,
            gRDts: gRDts,
            aDt: aDt,
			mDt: mDt,
            dDt: dDt,
            gUR: gUR
		};

		return fc;

		/////////////////
		function sU(u){
			url=u;
		}
        function gDt(id){
            return $http.get(url+'/'+id);
        }
        function cDts(){
            return $http.get(url+'/count/elems');
        }
        function gDts(){
            return $http.get(url);
        }
        function gSDt(texto){
            return $http.get(url+'/search/'+texto);
        }
        function gRDts(first){
            return $http.get(url+'/range/'+first);
        }
        function aDt(data){
            return $http.post(url,data);
        }
        function mDt(id,data){
            return $http.put(url+'/'+id,data);
        }
        function dDt(id){
            return $http.delete(url+'/'+id);
        }  
        function gUR(){
            return $http.get(url+'/registro/usuario');
        }      
	}
})();