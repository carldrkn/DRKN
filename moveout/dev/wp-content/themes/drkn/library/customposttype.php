<?php

class CustomPostType {

	public $name;
	public $singularName;
	public $pluralName;
	public $slug;
	public $fields = array();
	public $taxomonies = array();

	public $isPublic = true;
	public $isQueryable = true;

	private static $instances = array();

	public function __construct() {
		//$this->register();

		add_action('init', array($this, 'register'));
		add_action('add_meta_boxes', array($this, 'createMetaBoxes'));
		add_action('save_post', array($this, 'saveForm'));
		add_action( 'admin_enqueue_scripts', array($this, 'enqueueScripts') );

		self::$instances[$this->name] = $this;
	}

	public function register() {

		$supports = array();

		if ( isset($this->fields['title']) )
			$supports[] = 'title';

		if ( isset($this->fields['body']) )
			$supports[] = 'editor';

		$args = array(
			'labels' => array(
				'singular_name' => __($this->singularName),
				'name' => __($this->pluralName),
			),
			'public' => $this->isPublic,
			'publicly_queryable' => $this->isQueryable,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'taxonomies' => array(),
			'menu_position' => null,
			'supports' => $supports
		);

		register_post_type($this->slug, $args);

		foreach ( $this->taxomonies as $name => $taxomony ) {
			$taxomony = (object) $taxomony;
			register_taxonomy(
				$name,
				$this->name,
				array(
					'label' => __( $taxomony->title ),
					'public' => true,
					'rewrite' => false,
					'hierarchical' => true
				)
			);
		}

		return;
		include_once('cpt.php');

		// create a book custom post type
		$cpt = new CPT( array(
			'post_type_name' => $this->name,
			'singular' => $this->singularName,
			'plural' => $this->pluralName,
			'slug' => $this->slug
		));

		// populate the price column
		//$books->populate_column('price', function($column, $post) {
		//	echo "£" . get_field('price'); // ACF get_field() function
		//});

		// populate the ratings column
		//$books->populate_column('rating', function($column, $post) {
		//	echo get_field('rating') . '/5'; // ACF get_field() function
		//});

		// make rating and price columns sortable
		//$books->sortable(array(
		//	'price' => array('price', true),
		//	'rating' => array('rating', true)
		//));

		// use "pages" icon for post type
		//$books->menu_icon("dashicons-book-alt");


	}

	public function createMetaBoxes() {

		foreach ( $this->boxes as $box ) {
			$box = (object) $box;
			add_meta_box(
				self::friendlyUrl($box->title),
				__( $box->title ),
				array($this, 'outputMetaBox'),
				$this->slug, 'normal'
			);
		}

	}

	public function getBox( $title, $object = null ) {
		foreach ( $this->boxes as $box ) {
			$box = (object) $box;
			if ( $box->title == $title ) {
				foreach ( $box->fields as $k => $field_name ) {
					$box->fields[$k] = $field = (object) $this->fields[$field_name];

					$field->name = $field_name;

					$field->value = ($object) ? get_post_meta($object->ID, $field_name, true) : '';

					if ( $field->type == 'responsive_image') {
						$src = ($field->value) ? wp_get_attachment_image_src($field->value) : '';
						$field->src = $src ? $src[0] : '';
					}
					else if ( $field->type == 'responsive_images') {
						$field->value = $field->value ? $field->value : array();
						$field->images = array();
						foreach ( $field->value as $id ) {
							$src = wp_get_attachment_image_src($id);
							$field->images[] = array(
								'id' => $id,
								'src' => $src ? $src[0] : ''
							);
						}
					}

				}
				return $box;
			}
		}
	}

	public function outputMetaBox( $object, $wp_box ) {

		wp_nonce_field( basename( __FILE__ ), $this->slug . '-nonce' );

		$box = $this->getBox( $wp_box['title'], $object );

		?>

		<?php foreach ( $box->fields as $field ): ?>

			<?php if ( $field->type == 'title' ): ?>
			<p>
				<label for="<?php echo $field->name ?>"><?php echo $field->title ?>: </label>
				<input class="widefat" type="text"
					   name="<?php echo $field->name ?>" id="<?php echo $field->name ?>"
					   value="<?php echo $field->value; ?>" size="30" />
			</p>
			<?php endif; ?>

			<?php if ( $field->type == 'responsive_image' ): ?>
			<p class="meta-image">
				<label class="prfx-row-title" style="display: block;"><?php _e( $field->title) ?>:</label>
				<img src="<?php echo $field->src ?>" alt="" style="height: 150px; width: auto;<?php if ( !$field->src ) echo 'display: none;' ?>"/>
				<br/>
				<input type="hidden" class="meta-image-value" name="<?php echo $field->name ?>" value="<?php echo $field->value ?>" />
				<input type="button" class="meta-image-button button" value="<?php _e( 'Choose or Upload an Image' )?>" />
			</p>
			<?php endif; ?>

			<?php if ( $field->type == 'responsive_images' ): ?>
			<p class="meta-images" data-images='<?php echo json_encode( $field->images ? $field->images : array() ) ?>'>
				<label class="prfx-row-title" style="display: block;"><?php _e( $field->title) ?>:</label>
				<span class="meta-images-list"></span>
				<br/>
				<input type="hidden" class="meta-images-value" name="<?php echo $field->name ?>" value="<?php echo implode(',', $field->value ) ?>" />
				<input type="button" class="meta-images-button button" value="<?php _e( 'Choose or Upload an Image' )?>" />
			</p>
			<?php endif; ?>

			<?php if ( $field->type == 'target' ): ?>
			<p>
        		<label for="<?php echo $field->name ?>_url">URL: </label>
		        <input class="widefat" type="text"
					   name="<?php echo $field->name ?>[url]" id="<?php echo $field->name ?>_url"
					   value="<?php echo $field->value ? $field->value->url : ''; ?>" size="30" />
			</p>
			<p>
				<?php $optgroups = $this->getTargetOptions() ?>
				<label for="<?php echo $field->name ?>_post_id">Post or page: </label>
				<select name="<?php echo $field->name ?>[post_id]" id="<?php echo $field->name ?>_post_id">

					<optgroup label="None">
						<option value="">None</option>
					</optgroup>

				<?php foreach ( $optgroups as $optgroup ): ?>
					<optgroup label="<?php echo $optgroup->title ?>">
					<?php foreach ( $optgroup->posts as $post ) : ?>
						<option value="<?php echo $post->ID; ?>" <?php if ( $field->value && $post->ID == $field->value->post_id ) echo 'selected="SELECTED"' ?>><?php echo $post->post_title; ?></option>
					<?php endforeach; ?>
					</optgroup>
				<?php endforeach; ?>

				</select>

			</p>
			<p class="howto">Selecting a post or page will override URL-input</p>
			<?php endif; ?>

		<?php endforeach; ?>

		<style>

			.meta-images-image {
				display: inline-block;
				margin-right: 20px;
				margin-bottom: 10px;
				margin-top: 10px;
			}
			.meta-images-remove-image {
				display: block;
				cursor: pointer;
			}
		</style>

		<?php

	}

	public function getPost( $args = array()) {
		$args['limit'] = 1;
		$posts = $this->getPosts($args);
		if ( isset($posts[0]) )
			return $posts[0];
	}

	public function getPosts( $args = array('limit' => -1) ) {

		$args = (object) $args;

		$get_posts_args = array(
			'post_type' => $this->slug
		);

		if ( isset($args->meta_query) )
			$get_posts_args['meta_query'] = $args->meta_query;

		foreach ( $args as $key => $value )
			if ( isset($this->taxomonies[$key]) )
				$get_posts_args[$key] = $value;

		if ( isset($args->limit) )
			$get_posts_args['numberposts'] = $args->limit;

		$posts = get_posts( $get_posts_args );

		foreach ( $posts as $post ) {
			$meta = get_post_meta( $post->ID );

			foreach ( $this->fields as $field_name => $field ) {

				$field = (object) $field;

				if ( !isset($field->type) )
					continue;

				if ( $field->type == 'title' ) {
					$post->$field_name = isset($meta[$field_name]) && isset($meta[$field_name][0]) ? $meta[$field_name][0] : null;
				} elseif ( $field->type == 'responsive_image' ) {
					$post->$field_name = isset($meta[$field_name]) && isset($meta[$field_name][0]) ? $meta[$field_name][0] : null;
				} elseif ( $field->type == 'responsive_images' ) {
					$post->$field_name = isset($meta[$field_name]) && isset($meta[$field_name][0]) ? unserialize($meta[$field_name][0]) : array();
				} elseif ( $field->type == 'target' ) {
					$post->$field_name = $target = isset($meta[$field_name]) && isset($meta[$field_name][0]) ? unserialize($meta[$field_name][0]) : null;

					$field_name_link = $field_name . '_link';
					$post->$field_name_link = $target ? ( $target->post_id ? get_permalink($target->post_id) : $target->url ) : null;

				}

			}

		}

		return $posts;
	}

	public function getTargetOptions() {

		$argsPages = array(
		);

		$pages = get_pages($argsPages);

		$optgroups = array(
			(object) array(
				'title' => 'Pages',
				'posts' => $pages
			)
		);

		$post_types = array('post', 'silk_products');

		foreach ( $post_types as $post_type ) {

			$argsPosts = array(
				'numberposts' => -1,
				'post_type' => $post_type
			);

			$post_type_options = get_post_type_object( $post_type );

			$posts = get_posts($argsPosts);

			$optgroups[] = (object) array(
				'title' => $post_type_options->labels->name,
				'posts' => $posts
			);
		}
/*
		$category_types = array(array('category', 'post', 'Post category'));

		foreach ( $category_types as $taxonomy_type_title ) {

			$argsCategories = array(
				'taxonomy' => $taxonomy_type_title[0],
				'type' => $taxonomy_type_title[1]
			);

			$categories = get_posts($argsCategories);

			$optgroups[] = (object) array(
				'title' => $taxonomy_type_title[2],
				'posts' => $categories
			);
		}*/

		return $optgroups;

	}

	public function saveForm( $post_id ) {

		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Verify that the nonce is valid.
		if ( !isset( $_POST[ $this->slug . '-nonce' ] ) || !wp_verify_nonce( $_POST[ $this->slug . '-nonce' ], basename( __FILE__ ) ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( !current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/* OK, it's safe for us to save the data now. */
		foreach ( $this->fields as $field_name => $field ) {

			$field = (object) $field;

			if ( isset($_POST[$field_name]) ) {

				if ( $field->type == 'title' ) {
					$value = sanitize_text_field( $_POST[$field_name] );
					update_post_meta( $post_id, $field_name, $value );
				}
				else if ( $field->type == 'responsive_image' ) {
					$value = sanitize_text_field( $_POST[$field_name] );
					update_post_meta( $post_id, $field_name, $value );
				}
				else if ( $field->type == 'responsive_images' ) {
					$value = array_map( 'sanitize_text_field', explode(',', $_POST[$field_name] ) );
					update_post_meta( $post_id, $field_name, $value );

				}
				else if ( $field->type == 'target' ) {
					$target = (object) $_POST[$field_name];
					if ( $target && isset($target->url) && isset($target->post_id) ) {
						$target->url = sanitize_text_field( $target->url );
						$target->post_id = sanitize_text_field( $target->post_id );
						update_post_meta( $post_id, $field_name, $target );
					}
				}
			}

		}
		return;

		// Make sure that it is set.
		if ( isset( $_POST['order'] ) ) {
			// Sanitize user input.
			$value = sanitize_text_field( $_POST['order'] );

			// Update the meta field in the database.
			update_post_meta( $post_id, 'order', $value );
		}


		if ( isset($_POST['target_url']) && isset($_POST['page_id']) ) {

			$value = array(
				'url' => sanitize_text_field( $_POST['target_url'] ),
				'id' => sanitize_text_field( $_POST['page_id'] )
			);
			update_post_meta( $post_id, 'target', $value );

		}

	}

	public function enqueueScripts() {
		wp_enqueue_media();
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script( 'customposttype-js', get_template_directory_uri() . '/library/customposttype.js' );
	}

	private static function friendlyUrl($url, $to_lower = true) {
		// no spaces begin or end
		$url = trim($url);

		//replace accent characters, depends your language is needed
		$url = self::replaceAccents($url);

		// decode html maybe needed if there's html I normally don't use this
		//$url = html_entity_decode($url,ENT_QUOTES,'UTF8');
		$url = str_replace ("\n", '-', $url);

		// adding - for spaces and union characters
		$find = array(' ', '&', '\r\n', '\n', '+',',');
		$url = str_replace ($find, '-', $url);

		//delete and replace rest of special chars
		$find = array('/[^a-zA-Z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$url = preg_replace ($find, $repl, $url);

		// everything to lower and
		if ($to_lower)
			$url = strtolower($url);

		//return the friendly url
		return $url;
	}

	private static function replaceAccents($var){ //replace for accents catalan spanish and more
		$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
		$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
		$var = str_replace($a, $b,$var);
		return $var;
	}


	/**
	 * @return CustomPostType $post_type
	 */
	public static function getInstance( $name ) {
		return self::$instances[$name];
	}

}