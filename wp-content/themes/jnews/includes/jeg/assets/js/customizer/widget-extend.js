( function($, api) {
  "use strict";
  
  api.controlConstructor['widget_form'] = api.Widgets.WidgetControl.extend({
    alert: false,
    initialize: function( id, options ) {
      var control = this;
      api.Widgets.WidgetControl.prototype.initialize.call( control, id, options );
      control.bindOnExpand();
    },
    bindOnExpand: function(){
      var control = this;
      this.container.on( 'expand', function() {
        var base = control.params.widget_id_base;
        var start = base.startsWith('jnews');
        if(start && !control.alert) {
          var content = control.container.find('.widget-content');
          content.append(control.alertTemplate());
          control.alert = true;
        }
      });
    },
    alertTemplate: function(){
      return "<div class='customize-alert customize-alert-info'>" +
        "<label>" +
          "<strong class='customize-control-title'>Notice</strong>" +
          "<div class='description customize-control-description'>" +
            "<ul>" +
              "<li>To improve customizer load speed, we disable widget option on customizer for JNews element.</li>" +
              "<li>You can still modify widget content from Widget Panel on Admin Page</li>" +
            "</ul>" +
          "</div>" +
        "</label>" +
      "</div>";
    }
  });
  
})( jQuery, wp.customize );
