/**
 * Created by kieran on 8/5/16.
 */


(function ($) {

    var evilGlobal = evilGlobal || {};

    evilGlobal.debug = true;
    evilGlobal.debugLabel = "ckdogs1 CK plugin";

    CKEDITOR.plugins.add( 'ckdogs1', {
        icons: 'ckdogs1',
        init: function( editor ) {
            if ( evilGlobal.debug ) {
                console.log(evilGlobal.debugLabel + ': CK.plugins.add.init called');
            }
            editor.addCommand( 'ckdogs1', {
                exec: function( editor ) {
                    editor.insertHtml( 'DOG' );
                    if ( evilGlobal.debug ) {
                        console.log(evilGlobal.debugLabel + ': CK ckdogs1 comment called');
                    }
                }
            });
            editor.ui.addButton( 'ckdogs1', {
                label: 'Insert a dog',
                command: 'ckdogs1',
                toolbar: 'insert'
            });
        }
    });

})(jQuery);