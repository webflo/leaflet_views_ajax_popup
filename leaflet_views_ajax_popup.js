(function ($) {
  // Highlight articles when a pin is hovered.
  $(document).on('leaflet.feature', function (event, lFeature, feature) {
    lFeature.on('click', function (e) {
      if (this._popup._isOpen) {
        var data = {};
        for (var key in this._popup._contentNode.childNodes[0].attributes) {
          data[this._popup._contentNode.childNodes[0].attributes[key].name] = this._popup._contentNode.childNodes[0].attributes[key].value;
        }
        if (typeof data['class'] !== 'undefined' && data['class'] === 'leaflet-ajax-popup') {
          var url = 'leaflet-views-ajax-popup';
          url += '/' + data['data-type'];
          url += '/' + data['data-id'];
          url += '/' + data['data-mode'];
          $.get(url, function (response) {
            if (response) {
              $('.leaflet-ajax-popup').replaceWith(response);
            }
          });
        }
      }
    });
  });
})(jQuery);