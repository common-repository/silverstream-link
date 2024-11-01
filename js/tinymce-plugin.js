tinymce.PluginManager.add('silverstream', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('silverstream', {
        text: 'Silverstream Link',
        icon: false,
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Silverstream Reservation Link',
                body: [
                    {type: 'textbox', name: 'restaurant_id', label: 'Restaurant Id'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('[silverstream-link restaurant_id="' + e.data.restaurant_id + '"]');
                }
            });
        }
    });
});
