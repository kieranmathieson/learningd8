/**
 * Created by kieran on 8/5/16.
 */


(function ($) {


  CKEDITOR.plugins.add('widgettest', {
    requires: 'widget',
    icons: 'widgettest',
    init: function (editor) {
      var path = this.path;
      editor.addContentsCss( this.path + 'css/base.css' );
      editor.widgets.add('widgettest', {
        path: path,
        button: 'Add an widgettest to the reader',
        dialog: 'widgettest',
        //Get the HTML template from the editor object.
        template: editor.config.widgettest_template,
        //Define the editable pieces of the template.
        editables: {
          content: {
            selector: '.stuff'
          }
        },
        //Add to content that ACF will allow.
        allowedContent:
            'div(!widgettest);span(stuff);',
        requiredContent: 'div(widgettest)',
        upcast: function( element ) {
          //Convert from storage format to editing format.
          if( element.name == 'div'
              && element.hasAttribute('data-chunk-type')
              && element.getAttribute('data-chunk-type') == 'widgettest') {
            var widgettestRepeater = element.getAttribute('data-repeater') || 'dog';
            var dbContent = element.getText()||'stuff here';
            element.addClass('widgettest');
            element.setHtml(
                widgettestRepeater + ' '
                + '<span class="stuff">' + dbContent + '</span>'
                + ' ' + widgettestRepeater
            )
            this.setData('repeater', widgettestRepeater);
            return element;
          }
        },
        downcast: function(element) {
          element.addAttribute('data-chunk-type');
          element.setAttribute('data-chunk-type', 'widgettest');
          element.addAttribute('data-repeater');
          element.setAttribute('data-repeater', this.getData('repeater'));
          var content = element.getText();
          var pieces = content.split(' ');
          element.setText(pieces[1]);
          return element;

        },
        init: function() {
          return;
          //Width
          if ( this.element.hasClass( 'widgettest-quarter' ) ) {
            this.setData('width', 'quarter');
          }
          if ( this.element.hasClass( 'widgettest-half' ) ) {
            this.setData('width', 'half');
          }
          if ( this.element.hasClass( 'widgettest-full' ) ) {
            this.setData('width', 'full');
          }
          //Alignment
          if ( this.element.hasClass( 'widgettest-left' ) ) {
            this.setData('align', 'left');
          }
          if ( this.element.hasClass( 'widgettest-right' ) ) {
            this.setData('align', 'right');
          }
          if ( this.element.hasClass( 'widgettest-center' ) ) {
            this.setData('align', 'center');
          }
          //widgettest style.
          if ( this.element.hasClass( 'widgettest-extra' ) ) {
            this.setData('style', 'extra');
          }
          if ( this.element.hasClass( 'widgettest-hint' ) ) {
            this.setData('style', 'hint');
          }
          if ( this.element.hasClass( 'widgettest-note' ) ) {
            this.setData('style', 'note');
          }
          if ( this.element.hasClass( 'widgettest-troubleshoot' ) ) {
            this.setData('style', 'troubleshoot');
          }
          if ( this.element.hasClass( 'widgettest-warning' ) ) {
            this.setData('style', 'warning');
          }

        }, //End init().
        /**
         * Called when initialing widget display in CK, and when
         * data is returned by the dialog.
         */
        data: function() {
          return;
          //Get the icon element.
          var icon = this.element.find('img').getItem(0);
          //Remove existing classes, styles, and attributes.
          //Width.
          this.element.removeClass( 'widgettest-quarter' );
          this.element.removeClass( 'widgettest-half' );
          this.element.removeClass( 'widgettest-full' );
          //Alignment.
          this.element.removeClass( 'widgettest-left' );
          this.element.removeClass( 'widgettest-right' );
          this.element.removeClass( 'widgettest-center' );
          //Type
          this.element.removeClass( 'widgettest-extra' );
          this.element.removeClass( 'widgettest-hint' );
          this.element.removeClass( 'widgettest-note' );
          this.element.removeClass( 'widgettest-troubleshoot' );
          this.element.removeClass( 'widgettest-warning' );
          //Icon image.
          if ( icon ) {
            icon.removeAttributes(['src', 'alt']);
          }
          //Add new stuff.
          if ( this.data.width ) {
            this.element.addClass('widgettest-' + this.data.width);
          }
          if ( this.data.align ) {
            this.element.addClass('widgettest-' + this.data.align);
          }
          if ( this.data.style ) {
            this.element.addClass('widgettest-' + this.data.style);
            //Add style-specific CSS.
            editor.addContentsCss( this.path + 'css/' + this.data.style + '.css' );
          }
          if ( icon && this.data.style ) {
            //Show the right icon.
            icon.setAttribute('src', this.path + 'icons/' + this.data.style + '.png')
                .setAttribute('title', capitalizeFirstLetter(this.data.style))
                .setAttribute('alt', capitalizeFirstLetter(this.data.style))
                .addClass('widgettest-icon');
          }
        }
      });
      editor.ui.addButton( 'widgettest', {
        label: 'widgettest',
        command: 'widgettest'
      } );
      CKEDITOR.dialog.add( 'widgettest', this.path + 'dialogs/widgettest.js' );
      function capitalizeFirstLetter(value) {
        return value.charAt(0).toUpperCase() + value.slice(1);
      }
    }
  });

})(jQuery);
