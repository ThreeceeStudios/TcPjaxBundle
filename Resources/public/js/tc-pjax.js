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

      _this.containers.each( function () {
        if ( !$( this ).attr( 'data-pjax-disable' ) ) {
          $( document ).pjax( 'a', '#' + $( this ).attr( 'data-pjax-container' ) );
        }
      } );

    }
  }

  new TcPjaxBundle();

})();
