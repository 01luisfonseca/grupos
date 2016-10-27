(function(){
	'use strict';
	angular.module('escuela')
	.constant('OAUTHINFO',{
		URLVERIFY:'/oauth/token',
		URLREFRESH:'/oauth/token',
		CLIENTID:2,
		CLIENTSECRET:'c5xrJb6hZv1gco95BQAoavOXqO4V9QoYbpWCIB7w',
		GRANTTYPEREQUEST:'password',
		GRANTTYPEREFRESH:'refresh_token'
	});
})();