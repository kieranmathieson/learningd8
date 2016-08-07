/**
 * Created by kieran on 8/5/16.
 */


(function ($) {

    var evilGlobal = evilGlobal || {};

    evilGlobal.debug = true;
    evilGlobal.debugLabel = "ckdogs3 CK plugin";

    CKEDITOR.plugins.add( 'ckdogs3', {
        icons: 'ckdogs3',
        init: function( editor ) {
            if ( evilGlobal.debug ) {
                console.log(evilGlobal.debugLabel + ': CK.plugins.add.init called');
            }
            editor.addCommand(
                'ckdogs3', //Name of the command
                new CKEDITOR.dialogCommand('ckdogs3Dialog')
            );
            editor.ui.addButton( 'ckdogs3', {
                label: 'Insert a dog',
                command: 'ckdogs3',
                toolbar: 'insert'
            });
            CKEDITOR.dialog.add( 'ckdogs3Dialog', this.path + 'dialogs/ckdogs3.js' );
            editor.on( 'doubleclick', function( evt ) {
                var element = evt.data.element;
                var targetElement = null;
                if ( element.hasClass('ckdogs3') ) {
                    if (element.hasAttribute('data-dogs')) {
                        //Select the entire dogs element.
                        var selection = editor.getSelection();
                        selection.selectElement(element);
                        evt.data.dialog = 'ckdogs3Dialog';
                    }
                }
            } );
        }
    });

})(jQuery);
