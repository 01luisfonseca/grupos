(function(){
	'use strict';
	angular.module('app')
		.service('animPage',service);

	function service(){
		var vm=this;

		// Funciones
		vm.show=show;
		vm.hide=hide;

		function show(id,done){
			var tl = new TimelineMax({onComplete: done});
  			tl.add(TweenMax.from(id, .6, {rotationX: -90}));
  			tl.add(TweenMax.from('#header', .4, {y: 100, opacity: 0}));
  			tl.add(TweenMax.from('#content', .4, {y: 100, opacity: 0}));
  			tl.add(TweenMax.from('#footer', .4, {y: 100, opacity: 0}));
  			tl.play();
		}

		function hide(id,done){
			var tl = new TimelineMax({onComplete: done});
  			tl.add(TweenMax.to('#footer', .4, {y: 100, opacity: 0}));
  			tl.add(TweenMax.to('#content', .4, {y: 100, opacity: 0}));
  			tl.add(TweenMax.to('#header', .4, {y: 100, opacity: 0}));
  			tl.add(TweenMax.to(id, .6, {rotationX: -90}));
  			tl.play();
		}
	}
})();