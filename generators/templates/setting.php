&lt;?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Settings Page: Theme Options
class {{class_name}} {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
	}

	public function wph_create_settings() {
		$page_title = '{{page_title}}';
		$menu_title = '{{menu_title}}';
		$capability = '{{capability}}';
		$slug = '{{menu_slug}}';
		$callback = array($this, '{{callback}}');
		$icon = '{{menu_icon}}';
		$position = {{menu_position}};
		{{add_menu}}
	}

	public function {{callback}}() { ?>
		&lt;div class="wrap">
			&lt;h1>{{page_title}}&lt;/h1>
			&lt;?php settings_errors(); ?>
			&lt;form method="POST" action="options.php">
				&lt;?php
				settings_fields( 'themeoptions' );
				do_settings_sections( 'themeoptions' );
				submit_button();
				?>
			&lt;/form>
		&lt;/div> &lt;?php
	}

	public function wph_setup_sections() {
		add_settings_section( 'themeoptions_section', '', array(), 'themeoptions' );
	}

	public function wph_setup_fields() {
		$fields = array(
			{{fields}}
		);

		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'themeoptions', $field['section'], $field );
			register_setting( 'themeoptions', $field['id'] );
		}
	}

	public function wph_field_callback( $field ) {
		$value = get_option( $field['id'] );
		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}
		switch ( $field['type'] ) {
			case 'media':
				$field_url = '';
				if ($value) {
					if ($field['returnvalue'] == 'url') {
						$field_url = $value;
					} else {
						$field_url = wp_get_attachment_url($value);
					}
				}
				printf(
					'&lt;input style="display:none;" id="%s" name="%s" type="text" value="%s"  data-return="%s">&lt;div id="preview%s" style="margin-right:10px;border:1px solid #e2e4e7;background-color:#fafafa;display:inline-block;width: 100px;height:100px;background-image:url(%s);background-size:cover;background-repeat:no-repeat;background-position:center;">&lt;/div>&lt;input style="width: 19%%;margin-right:5px;" class="button themeoptions-media" id="%s_button" name="%s_button" type="button" value="Select" />&lt;input style="width: 19%%;" class="button remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button" value="Clear" />',
					$field['id'],
					$field['id'],
					$value,
					$field['returnvalue'],
					$field['id'],
					$field_url,
					$field['id'],
					$field['id'],
					$field['id'],
					$field['id']
				);
				break;
			case 'radio':
				if( ! empty ( $field['options'] ) && is_array( $field['options'] ) ) {
					$options_markup = '';
					$iterator = 0;
					foreach( $field['options'] as $key => $label ) {
						$iterator++;
						$options_markup.= sprintf('&lt;label for="%1$s_%6$s">&lt;input id="%1$s_%6$s" name="%1$s" type="%2$s" value="%3$s" %4$s /> %5$s&lt;/label>&lt;br/>',
							$field['id'],
							$field['type'],
							$key,
							checked($value, $key, false),
							$label,
							$iterator
						);
					}
					printf( '&lt;fieldset>%s&lt;/fieldset>',
						$options_markup
					);
				}
				break;
			case 'checkbox':
				printf('&lt;input %s id="%s" name="%s" type="checkbox" value="1">',
					$value === '1' ? 'checked' : '',
					$field['id'],
					$field['id']
				);
				break;
			case 'select':
			case 'multiselect':
				if( ! empty ( $field['options'] ) && is_array( $field['options'] ) ) {
					$attr = '';
					$options = '';
					foreach( $field['options'] as $key => $label ) {
						$options.= sprintf('&lt;option value="%s" %s>%s&lt;/option>',
							$key,
							selected($value, $key, false),
							$label
						);
					}
					if( $field['type'] === 'multiselect' ){
						$attr = ' multiple="multiple" ';
					}
					printf( '&lt;select name="%1$s" id="%1$s" %2$s>%3$s&lt;/select>',
						$field['id'],
						$attr,
						$options
					);
				}
				break;
			case 'textarea':
				printf( '&lt;textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s&lt;/textarea>',
					$field['id'],
					$placeholder,
					$value
				);
				break;
			case 'wysiwyg':
				wp_editor($value, $field['id']);
				break;
			default:
				printf( '&lt;input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$placeholder,
					$value
				);
		}
		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '&lt;p class="description">%s &lt;/p>', $desc );
			}
		}
	}
	public function media_fields() {
		?>
		&lt;script>
		jQuery(document).ready(function($){
			if ( typeof wp.media !== 'undefined' ) {
				var _custom_media = true,
				_orig_send_attachment = wp.media.editor.send.attachment;
				$('.themeoptions-media').click(function(e) {
					var send_attachment_bkp = wp.media.editor.send.attachment;
					var button = $(this);
					var id = button.attr('id').replace('_button', '');
					_custom_media = true;
						wp.media.editor.send.attachment = function(props, attachment){
						if ( _custom_media ) {
							if ($('input#' + id).data('return') == 'url') {
								$('input#' + id).val(attachment.url);
							} else {
								$('input#' + id).val(attachment.id);
							}
							$('div#preview'+id).css('background-image', 'url('+attachment.url+')');
						} else {
							return _orig_send_attachment.apply( this, [props, attachment] );
						};
					}
					wp.media.editor.open(button);
					return false;
				});
				$('.add_media').on('click', function(){
					_custom_media = false;
				});
				$('.remove-media').on('click', function(){
					var parent = $(this).parents('td');
					parent.find('input[type="text"]').val('');
					parent.find('div').css('background-image', 'url()');
				});
			}
		});
		&lt;/script>
		&lt;?php
	}

}
new {{class_name}}();