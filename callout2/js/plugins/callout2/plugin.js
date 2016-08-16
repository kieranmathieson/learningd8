/**
 * Created by kieran on 8/10/16.
 */
// Register our custom "callout2" widget plugin with CKEditor.
CKEDITOR.plugins.add('callout2', {
  icons: 'callout2',
  requires: 'widget',
  init: function(editor) {
    var path = this.path;
    // Register the widget.
    editor.widgets.add('callout2', {
      path: path,
      button: 'Testing',
      dialog: 'callout2',
      template:
          '<div class="callout2">'
        +   '<div class="callout2-extra">DOG</div>'
        +   '<div class="callout2-content">Content</div>'
        +   '<div class="callout2-extra">DOG</div>'
        + '</div>',
      allowedContent:
          'div(!callout2)[data-chunk-type,data-extra];'  //*** ATTRIB DOESN'T GET ADDED TO TAG FILTER ****
        + 'div(!callout2-content);'
        + 'div(!callout2-extra);',
      requiredContent: 'div(callout2);div(callout2-content);',
      editables: {
        content: {
          selector: 'div.callout2-content'
        }
      },
      /**
       * Initialize the widget.
       * Read data from DOM rep of the widget (refed in the element property),
       * and store the data in the widget.
       * When create new widget, use template?
       * this.element is The widget element — the element on which the widget was initialized.
       * It's a CKEDITOR.dom.element.
       */
      init: function() {
        //Get the widget's DOM element's data-extra attrib.
        var extra = this.element.getAttribute('data-extra');
        //Set widget data.
        this.setData('extra', extra ? extra : 'DOG');
      },
      /**
       * Called when initialing widget display in CK, and when
       * data is returned by the dialog.
       * this is the widget.
       * this.element is the widget's DOM element.
       */
      data: function() {
        //Copy data from widget to it's DOM element.
        if ( ! this.data.extra ) {
          this.data.extra = 'DOG';
        }
        this.element.setAttribute( 'data-extra', this.data.extra );
        //Find where the extras are rendered.
        var extras = this.element.find('div.callout2-extra');
        //Render the new extra data.
        for ( var i = 0; i < extras.count(); i++) {
          extras.getItem(i).setHtml(this.data.extra);
        };
      },
      /**
       * Convert element to display rep from storage rep.
       * @param CKEDITOR.dom.element element Element holding storage rep.
       * @returns Element with display rep.
       */
      upcast: function(element) {
        // return element.name == 'div' && element.hasClass('callout2');
        if ( ! element.attributes || element.attributes['data-chunk-type'] != 'callout2') {
          return;
        }
        var extra = element.attributes['data-extra'];
        if ( ! extra ) {
          extra = 'DOG';
        }
        var content = element.getHtml();
        // delete element.attributes["data-chunk-type"];
        element.addClass('callout2');
        element.setHtml(
           '<div class="callout2-extra">' + extra + '</div>'
         + '<div class="callout2-content">' + content + '</div>'
         + '<div class="callout2-extra">' + extra + '</div>'
        );
        return element;
      },
      //Convert to storage rep.
      downcast: function(element) {
        if ( ! element.hasClass('callout2') ) {
          return;
        }
        var content = 'CATS';
        element.forEach(function(el){
          if(el.name && el.name=='div' && el.attributes.class && el.attributes.class=="callout2-content") {
            content = el.getHtml();
          }
        });
        delete element.attributes.class;
        element.attributes["data-chunk-type"] = "callout2"
        //Copy extra attribute from widget (i.e., this).
        element.attributes['data-extra'] = this.element.getAttribute('data-extra');
        element.setHtml(content);
        return element;
      }
    });//End widget.add.
    // Register the toolbar buttons for the CKEditor editor instance.
    editor.ui.addButton( 'callout2', {
      label : 'Insert callout2 box',
      // icon : this.path + 'icons/callout2.png',
      command : 'callout2'
    });
    CKEDITOR.dialog.add( 'callout2', this.path + 'dialogs/callout2.js' );
  }
});
