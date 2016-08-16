/**
 * Created by kieran on 8/10/16.
 */
// Register our custom "callout" widget plugin with CKEditor.
CKEDITOR.plugins.add('callout', {
  icons: 'callout',
  requires: 'widget',
  init: function(editor) {
    var path = this.path;
    // Register the widget.
    editor.widgets.add('callout', {
      path: path,
      button: 'Testing',
      template:
          '<div class="callout">'
        +   'DOG <div class="callout-content">Content</div>DOG'
        + '</div>',
      allowedContent: 'div(!callout)[data-chunk-type];div(!callout-content);', //*** ATTRIB DOESN'T GET ADDED TO TAG FILTER ****
      requiredContent: 'div(callout);div(callout-content);',
      editables: {
        content: {
          selector: 'div.callout-content'
        }
      },
      //Convert to display rep.
      upcast: function(element) {
        // return element.name == 'div' && element.hasClass('callout');
        if ( ! element.attributes['data-chunk-type'] || element.attributes['data-chunk-type'] != 'callout') {
          return;
        }
        var content = element.getHtml();
        delete element.attributes["data-chunk-type"];
        element.attributes.class = 'callout';
        element.setHtml('DOG <div class="callout-content">' + content + '</div>DOG');
        // var newHTML =
        //       '<div class="callout">'
        //     +   'DOG <div class="callout-content">' + content + '</div>DOG'
        //     + '</div>';
        // element = jQuery('div');
        return element;
      },
      //Convert to storage rep.
      downcast: function(element) {
        if ( ! element.hasClass('callout') ) {
          return;
        }
        var content = 'CATS';
        element.forEach(function(el){
          if(el.name && el.name=='div' && el.attributes.class && el.attributes.class=="callout-content") {
            content = el.getHtml();
          }
        });
        delete element.attributes.class;
        element.attributes["data-chunk-type"] = "callout"
        element.setHtml(content);
        // var newHTML =
        //       '<div data-chunk-type="callout">'
        //     +   content
        //     + '</div>';
        return element;
      }
    },
    // Register the toolbar buttons for the CKEditor editor instance.
    editor.ui.addButton( 'callout', {
      label : 'Insert callout box',
      icon : this.path + 'icons/callout.png',
      command : 'callout'
    })

    );
  }
});
