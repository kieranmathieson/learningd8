/**
 * @file
 * The widgettest dialog definition.
 *
 */
(function () {

  "use strict";
  /**
   * @todo: Localize titles and labels.
   *
   * @todo: Create styles from CSS file names.
   */
  CKEDITOR.dialog.add('widgettest', function (editor) {
    // var lang = editor.lang.widgettest;

    return {

      // Basic properties of the dialog window: title, minimum size.
      title: "widgettest", //lang.dialogTitle,
      minWidth: 200,
      maxWidth: 480,
      minHeight: 200,
      maxHeight: 400,

      // Dialog window contents definition.
      contents: [
        {
          // Definition of the dialog tab.
          //@todo Need to define when have one tab?
          //@todo Change the alert() error call to something fancier?
          id: 'tab-basic',
          label: 'Basic Settings',

          // The tab contents.
          elements: [
            {
              type: 'text',
              id: 'repeater',
              label: 'Repeater'
            }
          ], //End elements
        }
      ]

    };
  });

})();