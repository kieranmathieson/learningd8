/**
 * Created by kieran on 8/5/16.
 */


(function ($) {
    "use strict";

    var evilGlobal = evilGlobal || {};

    evilGlobal.debug = true;
    evilGlobal.debugLabel = "ckdogs2 CK plugin";

    CKEDITOR.plugins.add( 'ckdogs2', {
        icons: 'ckdogs2',
        init: function( editor ) {
            if ( evilGlobal.debug ) {
                console.log(evilGlobal.debugLabel + ': CK.plugins.add.init called');
            }
            editor.addCommand(
                'ckdogs2', //Name of the command
                new CKEDITOR.dialogCommand('ckdogs2Dialog')
            );
            editor.ui.addButton( 'ckdogs2', {
                label: 'Insert a dog',
                command: 'ckdogs2',
                toolbar: 'insert'
            });
            CKEDITOR.dialog.add( 'ckdogs2Dialog', this.path + 'dialogs/ckdogs2.js' );
        }
    });

})(jQuery);
