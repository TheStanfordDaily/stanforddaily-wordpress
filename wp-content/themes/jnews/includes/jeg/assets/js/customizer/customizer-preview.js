(function (api) {
  api.bind('preview-ready', function () {
    /**
     * Listen if dynamic setting being added on customizer panel and assign on previewer
     */
    api.preview.bind('customize-add-setting', function (setting) {
      if (!api.has(setting.id)) {
        api.create(setting.id, setting.value, {
          id: setting.id
        });
      }
    });
  });
})(wp.customize);