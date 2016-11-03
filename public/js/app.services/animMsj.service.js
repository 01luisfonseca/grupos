(function(){
	'use strict';
	angular.module('escuela')
		.service('animMsj',service);

	function service(){
		var vm=this;

		// Funciones
		vm.show=show;
		vm.hide=hide;

		function show(clase,done){
			var tl = new TimelineMax({onComplete: done});
  			tl.add(TweenMax.from(clase, 1, {y: -20, opacity: 0}));
  			tl.play();
		}

		function hide(clase,done){
			var tl = new TimelineMax({onComplete: done});
  			tl.add(TweenMax.to(clase, 1, {y: -20, opacity: 0}));
  			tl.play();
		}
	}
})();