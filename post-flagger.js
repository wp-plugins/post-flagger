jQuery(document).ready(function () {
    //Bind click event to flag-this buttons
    jQuery(".flag-this").bind("click", function () {
        //Save this button object
        var thisButton = jQuery(this);

        //Get the post id by its attribute
        var the_post_id = jQuery(this).attr('post-id');
        //Get the flag slug by its attribute
        var the_slug = jQuery(this).attr('flag');

        //Post to ajaxurl with the data obtained
        // * action:    to execute the function in the php
        // * post_id:   send the post id to flag
        // * flag_slug: send the flag to put in this post (favorites, views)
        jQuery.post(the_ajax_script.ajaxurl, {action: 'flag', post_id: the_post_id, flag_slug: the_slug}, function (data) {
                //If everything is 'OK'
                    //Remove button click binder
                    thisButton.removeClass('flag-this');
                    //Add class to style flagged buttons
                    thisButton.addClass('flagged');

                thisButton.html(data);
            }
        );
    });

});
