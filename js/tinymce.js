(function() {
    tinymce.PluginManager.add('cwr_plugin_mce_button', function(editor, url) {
        editor.addButton('cwr_plugin_mce_button', {
            icon: true,
            image: objectData.imageurl,
            text: " Coworks",
            onclick: function() {
                editor.windowManager.open({
                    title: "Insert Your Coworks ID" ,
                    body: [
                    {
                        type: 'textbox',
                        name: 'coworksid',
                        label: 'Subdomain',
                        value: ''
                    },
                    {type: 'listbox', 
                        name: 'formtype', 
                        label: 'Type', 
                        'values': [
                            {text: 'Membership Request Form', value: 'membership-request'},
                            {text: 'Tour Request Form', value: 'tour-request'}
                        ]
                    },
                    {
                        type: 'container',
                        name: 'container',
                        label: '',
                        html   : 'Not sure what you Coworks subdomain is? <a href="//coworks.zendesk.com/hc/en-us/articles/360019617152" target="_blank">Click here</a> to see how to get it.'
                    }
					          ],
                    onsubmit: function(e) {
                        editor.insertContent(
                            '[Coworks id="'+ e.data.coworksid +'" type="'+ e.data.formtype +'" ]'
                        );
                    }
                });
            }
        });
    });
})();
