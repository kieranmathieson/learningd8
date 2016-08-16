/**
 * @file
 * The callout3 dialog definition.
 *
 * Created out of the CKEditor Plugin SDK:
 * http://docs.ckeditor.com/#!/guide/plugin_sdk_sample_1
 */

// Our dialog definition.
CKEDITOR.dialog.add('callout3', function (editor) {
  // var lang = editor.lang.callout3;

  return {

    // Basic properties of the dialog window: title, minimum size.
    title: "Add extra content", //lang.dialogTitle,
    minWidth: 400,
    minHeight: 200,

    // Dialog window contents definition.
    contents: [
      {
        // Definition of the Basic Settings dialog tab (page).
        id: 'tab-basic',
        label: 'Basic Settings',

        // The tab contents.
        elements: [
          {
            type: 'text',
            id: 'extra',
            label: 'Extra',
            default: 'Dog',
            validate: CKEDITOR.dialog.validate.functions(function(val){
              return val != "";
            }, "Please enter something."),
            setup: function (widget) {
              this.setValue(
                widget.data.extra ? widget.data.extra : this.default
              );
            },
            commit: function( widget ) {
              //Called when saving changes.
              widget.setData( 'extra', this.getValue() );
            }
          }
        ]
      }
    ],


  };
});
