/**
 * @file
 * The ckdogs3 dialog definition.
 *
 * Created out of the CKEditor Plugin SDK:
 * http://docs.ckeditor.com/#!/guide/plugin_sdk_sample_1
 */

// Our dialog definition.
CKEDITOR.dialog.add('ckdogs3Dialog', function (editor) {
  // var lang = editor.lang.ckdogs3;

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
    onShow: function() {
      var selection = editor.getSelection();
      var numDogs = selection.getStartElement().getAttribute('data-dogs');
      if ( numDogs ) {
        this.setValueOf('tab-basic', 'dogCount', numDogs);
      }
    },
    onOk: function(){
      var numDogs = this.getValueOf('tab-basic', 'dogCount');
      var result = "<span class='ckdogs3' data-dogs='" + numDogs + "'>";
      for (var i = 0; i < numDogs; i++ ) {
        result += "DOG ";
      }
      result += "</span>";
      editor.insertHtml(result);
    }

  };
});
