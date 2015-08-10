(function () {
  'use strict';

  function TcPjaxBundle() {
    var _this = this;

    _this.containers = $( '[data-pjax-container]' );
    _this.config = {
      version: 1,
      timeout: 2000
    };

    if ( typeof $ === 'undefined' ) {
      if ( typeof console !== 'undefined' ) {
        console.error( 'TcPjaxBundle is dependant on jQuery' );
      }
    } else if ( typeof $.pjax === 'undefined' ) {
      if ( typeof console !== 'undefined' ) {
        console.error( 'TcPjaxBundle is dependant on PJAX' );
      }
    } else {

      if ( _this.containers.length > 0 ) {
        _this.config.version = $( _this.containers[ 0 ] ).attr( 'data-pjax-version' );
        _this.config.timeout = $( _this.containers[ 0 ] ).attr( 'data-pjax-timeout' );
      }

      if ( typeof $.pjax.defaults !== 'undefined' ) {
        $.pjax.defaults.timeout = _this.config.timeout;
        $.pjax.defaults.version = _this.config.version;
      }

	    if (typeof angular !== 'undefined') {
		    _this.angularRefresh = function(container) {
			    var scope = angular.element(container).scope();
			    var compile = angular.element(container).injector().get('$compile');
			    compile($(container).contents())(scope);
			    scope.$apply();
		    }
	    }

      _this.containers.each( function () {
        if ( !$( this ).attr( 'data-pjax-disable' ) ) {
	        var container = '#' + $( this ).attr( 'data-pjax-container' );
          $( document ).pjax( 'a:not([no-pjax])', container );
	        if (typeof _this.angularRefresh !== 'undefined') {
		        $( document ).on('pjax:success', function(e){
			        _this.angularRefresh(container);
		        });
	        }
        }
      } );

    }
  }

  new TcPjaxBundle();

})();
