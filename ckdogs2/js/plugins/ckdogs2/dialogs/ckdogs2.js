/**
 * @file
 * The ckdogs2 dialog definition.
 *
 * Created out of the CKEditor Plugin SDK:
 * http://docs.ckeditor.com/#!/guide/plugin_sdk_sample_1
 */

// Our dialog definition.
CKEDITOR.dialog.add('ckdogs2Dialog', function (editor) {
  // var lang = editor.lang.ckdogs2;

  return {

    // Basic properties of the dialog window: title, minimum size.
    title: "Add dogs", //lang.dialogTitle,
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
            id: 'dogCount',
            label: 'How many dogs?',
            validate: CKEDITOR.dialog.validate.functions(function(val){
              return val != "" && ! isNaN(val) && val > 0;
            }, "Please enter a number more than zero.")
          }
        ]
      }
    ],
    onOk: function(){
      var numDogs = this.getValueOf('tab-basic', 'dogCount');
      var result = "";
      for (var i = 0; i < numDogs; i++ ) {
        result += "DOG ";
      }
      editor.insertHtml(result);
    }

  };
});
