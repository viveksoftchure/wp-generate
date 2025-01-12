jQuery(document).ready(function() {

	/*

	* Wp generator nav tab

	*/

	jQuery('.fancyTab a').on('click', function(e) {

        e.preventDefault();

		var tabContent = jQuery(this).attr('href');



		jQuery('.fancyTab').removeClass('active');

		jQuery(this).closest('.fancyTab').addClass('active');



		jQuery('.tab-pane').removeClass('active');

		jQuery(tabContent).addClass('active');

	});



	/*

	* generator code on click

	*/

	jQuery('#update-snippet').on('click', function(e) {

		jQuery(this).text( 'loading...' );

		jQuery('.prettyprint').slideUp( 'fast', function() {

			jQuery.post(
                wpgenerate.ajaxurl, 
                jQuery('#generator_form').serialize(), 
                function( result ) {
                    jQuery('.prettyprint').html(prettyPrintOne(result)).slideDown( 'fast', function() {
                        jQuery('#update-snippet').text( 'reset' );
                    });
                    jQuery(this).parents('#generator_form').trigger( 'gwp:code:updated', result );
                }
            );

		});

		return false;

	});



	/*

	* Highlight code when clicked

	*/

	jQuery('.prettyprint').click( function(e) {

		wpgSelectText(jQuery(this));

	});



	function wpgSelectText($this) {

		var text = $this.get(0);



	    var doc = document, range, selection;    

	    if (doc.body.createTextRange) {

	        range = document.body.createTextRange();

	        range.moveToElementText(text);

	        range.select();

	    } else if (window.getSelection) {

	        selection = window.getSelection();        

	        range = document.createRange();

	        range.selectNodeContents(text);

	        selection.removeAllRanges();

	        selection.addRange(range);

	    }

	}



	/*

	* add prettyprint on pre

	*/

	jQuery(".prettyprint").html(PR.prettyPrintOne(jQuery(".prettyprint").html()));





	/*

	* on change select[name="has_archive"]

	*/

    jQuery('select[name="has_archive"]').on('change', function () {

        var $query_var = jQuery('select[name="has_archive"] option:selected').val();

        switch ($query_var) {

            case "false":

                jQuery('input[name="custom_archive_slug"]').attr("disabled", true);

                break;

            case "true":

                jQuery('input[name="custom_archive_slug"]').attr("disabled", true);

                break;

            case "custom":

                jQuery('input[name="custom_archive_slug"]').attr("disabled", false);

                break;

        }

    });



	/*

	* on change select[name="show_in_menu"]

	*/

    jQuery('select[name="show_in_menu"]').on('change', function () {

        var $query_var = jQuery('select[name="show_in_menu"] option:selected').val();

        switch ($query_var) {

            case "true":

                jQuery('select[name="menu_position"]').attr("disabled", false);

                break;

            case "false":

                jQuery('select[name="menu_position"]').attr("disabled", true);

                break;

        }

    });

    

	/*

	* on change select[name="query_var"]

	*/

    jQuery('select[name="query_var"]').on('change', function () {

        var $query_var = jQuery('select[name="query_var"] option:selected').val();

        switch ($query_var) {

            case "true":

                jQuery('input[name="query_var_slug"]').attr("disabled", false);

                break;

            case "false":

                jQuery('input[name="query_var_slug"]').attr("disabled", true);

                break;

        }

    });

    

	/*

	* on change select[name="rewrite"]

	*/

    jQuery('select[name="rewrite"]').on('change', function () {

        var $rewrite = jQuery('select[name="rewrite"] option:selected').val();

        switch ($rewrite) {

            case "true":

                jQuery('input[name="rewrite_slug"]').attr("disabled", true);

                jQuery('select[name="rewrite_with_front"]').attr("disabled", true);

                jQuery('select[name="rewrite_hierarchical"]').attr("disabled", true);

                jQuery('select[name="rewrite_pages"]').attr("disabled", true);

                jQuery('select[name="rewrite_feeds"]').attr("disabled", true);

                break;

            case "false":

                jQuery('input[name="rewrite_slug"]').attr("disabled", true);

                jQuery('select[name="rewrite_with_front"]').attr("disabled", true);

                jQuery('select[name="rewrite_hierarchical"]').attr("disabled", true);

                jQuery('select[name="rewrite_pages"]').attr("disabled", true);

                jQuery('select[name="rewrite_feeds"]').attr("disabled", true);

                break;

            case "custom":

                jQuery('input[name="rewrite_slug"]').attr("disabled", false);

                jQuery('select[name="rewrite_with_front"]').attr("disabled", false);

                jQuery('select[name="rewrite_hierarchical"]').attr("disabled", false);

                jQuery('select[name="rewrite_pages"]').attr("disabled", false);

                jQuery('select[name="rewrite_feeds"]').attr("disabled", false);

                break;

        }

    });

    

	/*

	* on change select[name="capabilities"]

	*/

    jQuery('select[name="capabilities"]').on('change', function () {

        var $capabilities = jQuery('select[name="capabilities"] option:selected').val();

        switch ($capabilities) {

            case "base":

                jQuery('input[name="capabilities_edit_post"]').attr("disabled", true);

                jQuery('input[name="capabilities_read_post"]').attr("disabled", true);

                jQuery('input[name="capabilities_delete_post"]').attr("disabled", true);

                jQuery('input[name="capabilities_edit_posts"]').attr("disabled", true);

                jQuery('input[name="capabilities_edit_others_posts"]').attr("disabled", true);

                jQuery('input[name="capabilities_publish_posts"]').attr("disabled", true);

                jQuery('input[name="capabilities_read_private_posts"]').attr("disabled", true);

                break;

            case "custom":

                jQuery('input[name="capabilities_edit_post"]').attr("disabled", false);

                jQuery('input[name="capabilities_read_post"]').attr("disabled", false);

                jQuery('input[name="capabilities_delete_post"]').attr("disabled", false);

                jQuery('input[name="capabilities_edit_posts"]').attr("disabled", false);

                jQuery('input[name="capabilities_edit_others_posts"]').attr("disabled", false);

                jQuery('input[name="capabilities_publish_posts"]').attr("disabled", false);

                jQuery('input[name="capabilities_read_private_posts"]').attr("disabled", false);

                break;

        }

    });

});

