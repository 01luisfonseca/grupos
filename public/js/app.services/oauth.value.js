(function(){
	'use strict';
	angular.module('app')
	.constant('OAUTHINFO',{
		URLVERIFY:'/oauth/token',
		URLREFRESH:'/oauth/token',
		CLIENTID:3,
		CLIENTSECRET:'I8dVQ8umBnjfXrutVB6maAeHMbjr2nVUGRmNjGOn',
		GRANTTYPEREQUEST:'password',
		GRANTTYPEREFRESH:'refresh_token'
	});
})();