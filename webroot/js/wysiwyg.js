Croogo.Wysiwyg.Grapesjs = {

    instance: {},

    setup: function(el, config) {
        var $el = $(el + ':not(.no-wysiwyg)');
        var elementId = $el.attr('id');
        var editorId = elementId + 'Grapesjs';
        var onClickCallback = function(e) {
            var $temp = $('<div id="' + editorId + '"/>');
            if (
                typeof Croogo.Wysiwyg.Grapesjs.instance[elementId] == 'undefined' ||
                Croogo.Wysiwyg.Grapesjs.instance[elementId] == null
            ) {
                $el.hide();
                $temp.insertAfter($el);
                Croogo.Wysiwyg.Grapesjs.instance[elementId] = grapesjs.init({
                    container: '#' + editorId,
                    components: $el.val(),
                    storageManager: false,
                    plugins: [
                        'gjs-preset-webpage'
                    ]
                });
            } else {
                $el.show();
                $el.val(Croogo.Wysiwyg.Grapesjs.instance[elementId].getHtml());
                Croogo.Wysiwyg.Grapesjs.instance[elementId].destroy();
                Croogo.Wysiwyg.Grapesjs.instance[elementId] = null;
                $('#' + editorId).remove();
            }
        };

        Croogo.Wysiwyg.addButton($el, 'GrapesJS', onClickCallback)
    }
}
