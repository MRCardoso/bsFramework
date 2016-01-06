(function($){
    $.dialogBox = function(params)
    {
        if( typeof bootbox == "undefined")
            throw "This plugin has dependency from bootbox.js";

        if(params.type == null)
        {
            bootbox.alert('Type request not found');
        }
        switch(params.type)
        {
            case 'basic':
            case 'alert':
                bootbox.dialog({
                    "message":params.message,
                    "title":params.title,
                    "buttons":
                    {
                        success:
                        {
                            label: "OK",
                            callback: params.callback
                        }
                    }
                });
                break;

            case 'confirm':
                bootbox.dialog({
                    "message":      params.message,
                    "title":        params.title,
                    "buttons":
                    {
                        fail:
                        {
                            label: "Cancel",
                            className: "btn-default",
                            callback:function()
                            {
                                params.callback(false);
                            }
                        },
                        success:
                        {
                            label: "Confirm",
                            className: "btn-primary",
                            callback: function()
                            {
                                params.callback(true);
                            }
                        }
                    }
                });
                break;

            case 'prompt':
                bootbox.prompt(params);
                break;

            case 'custom':
                bootbox.dialog({
                    "message":   params.message,
                    "title":    params.title,
                    "buttons":  params.buttons
                });
                break;
        }
    };
})(jQuery);