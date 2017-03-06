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
	public $hasArchive = false;
	public $postsPerPage = null;

	protected $orderBy = null;

	protected $settingsPage = false;

	private static $instances = array();

	public function setup() {
		//$this->register();

		add_action('init', array($this, 'register'));
		add_action('admin_menu', array($this, 'registerAdminMenu'));
		add_action('add_meta_boxes', array($this, 'createMetaBoxes'));
		add_action('save_post', array($this, 'saveForm'));
		add_action( 'admin_enqueue_scripts', array($this, 'enqueueScripts') );

		add_action( 'the_post', array($this, '_actionThePost'));
		add_action( 'pre_get_posts', array($this, '_actionPreGetPosts'));

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
			'query_var' => false,
			'capability_type' => 'post',
			'has_archive' => $this->hasArchive,
			'hierarchical' => false,
			'taxonomies' => array(),
			'menu_position' => null,
			'supports' => $supports,
			'rewrite' => array('slug'=>$this->slug)
		);

		register_post_type($this->name, $args);

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

	}

	public function registerAdminMenu() {

		if ( $this->settingsPage )
			add_submenu_page('edit.php?post_type=' . $this->name, '', 'Settings', 'edit_posts', basename(__FILE__), array($this, 'settingsPage'));

	}

	public function settingsPage() {
		echo 'Empty!';
	}

	public function createMetaBoxes() {

		foreach ( $this->boxes as $box ) {
			$box = (object) $box;
			add_meta_box(
				self::friendlyUrl($box->title),
				__( $box->title ),
				array($this, 'outputMetaBox'),
				$this->name, 'normal'
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

		wp_nonce_field( basename( __FILE__ ), $this->name . '-nonce' );

		$box = $this->getBox( $wp_box['title'], $object );

		?>

		<?php foreach ( $box->fields as $field ): ?>

			<?php if ( $field->type == 'title' ): ?>
			<p class="meta-title">
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
			<?php if ( isset($field->value->post_id) ) $field->value->id = 'post_' . $field->value->post_id; ?>
			<p class="meta-target">
        		<label for="<?php echo $field->name ?>_url">URL: </label>
		        <input class="widefat" type="text"
					   name="<?php echo $field->name ?>[url]" id="<?php echo $field->name ?>_url"
					   value="<?php echo $field->value ? $field->value->url : ''; ?>" size="30" />
			</p>
			<p class="meta-target">
				<?php $optgroups = $this->getTargetOptions() ?>
				<label for="<?php echo $field->name ?>_id">Post, page or category: </label>
				<select name="<?php echo $field->name ?>[id]" id="<?php echo $field->name ?>_id">

					<optgroup label="None">
						<option value="">None</option>
					</optgroup>

				<?php foreach ( $optgroups as $optgroup ): ?>
					<optgroup label="<?php echo $optgroup->title ?>">
					<?php foreach ( $optgroup->posts as $post ) : ?>
						<option value="<?php echo $post->target_id; ?>" <?php if ( $field->value && $post->target_id == $field->value->id ) echo 'selected="SELECTED"' ?>><?php echo $post->post_title; ?></option>
					<?php endforeach; ?>
					</optgroup>
				<?php endforeach; ?>

				</select>

			</p>
			<p class="howto">Selecting a post or page will override URL-input</p>
			<?php endif; ?>

			<?php if ( $field->type == 'product' ): ?>
			<?php if ( isset($field->value->post_id) ) $field->value->id = 'post_' . $field->value->post_id; ?>
			<p class="meta-product">
				<?php $optgroups = $this->getProductOptions() ?>
				<label for="<?php echo $field->name ?>_id">Product: </label>
				<select name="<?php echo $field->name ?>[id]" id="<?php echo $field->name ?>_id">

					<optgroup label="None">
						<option value="">None</option>
					</optgroup>

				<?php foreach ( $optgroups as $optgroup ): ?>
					<optgroup label="<?php echo $optgroup->title ?>">
					<?php foreach ( $optgroup->posts as $post ) : ?>
						<option value="<?php echo $post->product_id; ?>" <?php if ( $field->value && $post->product_id == $field->value->id ) echo 'selected="SELECTED"' ?>><?php echo $post->post_title; ?></option>
					<?php endforeach; ?>
					</optgroup>
				<?php endforeach; ?>

				</select>

			</p>
			<?php endif; ?>
			
			<?php if( $field->type == 'text' ): ?>
			<p>
				<label for="<?php echo $field->name ?>"><?php echo $field->title ?>: </label>
				<textarea class="widefat" name="<?php echo $field->name ?>" rows="6" cols="10"
						  id="<?php echo $field->name ?>"><?php echo $field->value; ?></textarea>
			</p>
			<?php endif; ?>
			
			<?php if( $field->type == 'options_radio' ): ?>
			<p class="meta-radio">
				<label for="<?php echo $field->name ?>"><?php echo $field->title ?>: </label>
			</p>
			<p class="meta-radio">
				<?php foreach( $field->options as $key => $val ) : ?>
				<input type="radio" name="<?php echo $field->name ?>" value="<?php echo $key ?>"
					   <?php echo ( $field->value == $key ) ? 'checked' : '' ?>><?php echo $val; ?>&nbsp;&nbsp;&nbsp;
				<?php endforeach; ?>
			</p>
			<?php endif; ?>
			
			<?php if( $field->type == 'editor' ): ?>
			<p>
				<label for="<?php echo $field->name ?>"><?php echo $field->title ?>: </label>
				<?php
				
				$settings = array(
					'media_buttons' => false,
					'textarea_name' => $field->name
				);
				
				wp_editor( $field->value, $field->name, $settings ); ?>
			</p>
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
			'post_type' => $this->name
		);

		if ( isset($args->meta_query) )
			$get_posts_args['meta_query'] = $args->meta_query;

		foreach ( $args as $key => $value )
			if ( isset($this->taxomonies[$key]) )
				$get_posts_args[$key] = $value;

		if ( isset($args->limit) )
			$get_posts_args['numberposts'] = $args->limit;

		$order_by = isset( $args->orderBy ) ?
			$args->orderBy : ( $this->orderBy ? $this->orderBy : null  );

		if ( $order_by ) {

			// ASC if field is "field" DESC if field is "!field"
			$ascending = preg_match('/\!/', $order_by) ? false : true;
			$field = str_replace('!', '', $order_by);

			$get_posts_args['order'] = $ascending ? 'ASC' : 'DESC';
			if ( isset($this->fields[$field] ) ) {
				$get_posts_args['orderby'] = 'meta_value_num';
				$get_posts_args['meta_key'] = $field;
			}
		}

		$posts = get_posts( $get_posts_args );

		foreach ( $posts as $post ) {
			$this->preparePost($post);
		}

		return $posts;
	}


	public function preparePost( $post ) {
		$meta = get_post_meta( $post->ID );

		foreach ( $this->fields as $field_name => $field ) {

			$field = (object) $field;

			if( !isset($field->type) ) {
				continue;
			}

			if( $field->type == 'title' || $field->type == 'responsive_image' || $field->type == 'text'
					|| $field->type == 'options_radio'|| $field->type == 'editor' ) {
				$post->$field_name = isset($meta[$field_name]) && isset($meta[$field_name][0]) ? $meta[$field_name][0] : null;
			} elseif ( $field->type == 'responsive_images' ) {
				$post->$field_name = isset($meta[$field_name]) && isset($meta[$field_name][0]) ? unserialize($meta[$field_name][0]) : array();
			} elseif ( $field->type == 'target' ) {
				$post->$field_name = $target = isset($meta[$field_name]) && isset($meta[$field_name][0]) ? unserialize($meta[$field_name][0]) : null;

				$field_name_link = $field_name . '_link';

				if ( isset($target->post_id) )
					$post->$field_name_link = $target ? ( $target->post_id ? get_permalink($target->post_id) : $target->url ) : null;
				elseif ( isset($target->id)) {
					$id = str_replace(array('post_', 'category_'), '', $target->id);
					if ( preg_match('/post/', $target->id) )
						$post->$field_name_link = $target ? ( $id ? get_permalink($id) : $target->url ) : null;
					else {
						$post->$field_name_link = $target ? ( $id ? get_term_link((int)$id, 'category') : $target->url ) : null;
						if ( !is_string($post->$field_name_link) )
							$post->$field_name_link = $target ? ( $id ? get_term_link((int)$id, 'silk_category') : $target->url ) : null;
						if ( !is_string($post->$field_name_link) )
							$post->$field_name_link = null;
					}

				}
			} elseif ( $field->type == 'product' ) {
				$post->$field_name = $product = isset($meta[$field_name]) && isset($meta[$field_name][0]) ? unserialize($meta[$field_name][0]) : null;

				$field_name_link = $field_name . '_link';

				if ( isset($product->post_id) )
					$post->$field_name_link = $product ? ( $product->post_id ? get_permalink($product->post_id) : $product->url ) : null;
				elseif ( isset($product->id)) {
					$id = str_replace(array('post_', 'category_'), '', $product->id);
					if ( preg_match('/post/', $product->id) )
						$post->$field_name_link = $product ? ( $id ? get_permalink($id) : $product->url ) : null;
					else {
						$post->$field_name_link = $product ? ( $id ? get_term_link((int)$id, 'category') : $product->url ) : null;
						if ( !is_string($post->$field_name_link) )
							$post->$field_name_link = $product ? ( $id ? get_term_link((int)$id, 'silk_category') : $product->url ) : null;
						if ( !is_string($post->$field_name_link) )
							$post->$field_name_link = null;
					}

				}
			}
		}
	}
	public function getTargetOptions() {

		$argsPages = array(
		);

		$pages = get_pages($argsPages);

		foreach ( $pages as $page )
			$page->target_id = 'post_' . $page->ID;

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

			foreach ( $posts as $post )
				$post->target_id = 'post_' . $post->ID;

			$optgroups[] = (object) array(
				'title' => $post_type_options->labels->name,
				'posts' => $posts
			);
		}

		$category_types = array(
			array('category', 'Post category'),
			array('silk_category', 'Product category')
		);

		foreach ( $category_types as $taxonomy_type_title ) {

			$argsCategories = array(
				'taxonomy' => $taxonomy_type_title[0]
			);

			$categories = get_categories($argsCategories);

			foreach ( $categories as $category ) {
				$category->target_id = 'category_' . $category->term_id;
				$category->post_title = $category->name;
			}

			$optgroups[] = (object) array(
				'title' => $taxonomy_type_title[1],
				'posts' => $categories
			);
		}

		return $optgroups;

	}

	public function getProductOptions() {

		$optgroups = array();

		$post_types = array('silk_products');

		foreach ( $post_types as $post_type ) {

			$argsPosts = array(
				'numberposts' => -1,
				'post_type' => $post_type
			);

			$post_type_options = get_post_type_object( $post_type );

			$posts = get_posts($argsPosts);

			foreach ( $posts as $post )
				$post->product_id = $post->ID;

			$optgroups[] = (object) array(
				'title' => $post_type_options->labels->name,
				'posts' => $posts
			);
		}

		return $optgroups;

	}

	public function saveForm( $post_id ) {

		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Verify that the nonce is valid.
		if ( !isset( $_POST[ $this->name . '-nonce' ] ) || !wp_verify_nonce( $_POST[ $this->name . '-nonce' ], basename( __FILE__ ) ) ) {
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
			
			if( !isset( $_POST[$field_name] ) ) {
				continue;
			}
			
			if ( $field->type == 'title' || $field->type == 'text' || $field->type == 'options_radio'
					|| $field->type == 'responsive_image' ) {
//				$value = sanitize_text_field( $_POST[$field_name] );
				update_post_meta( $post_id, $field_name, $_POST[$field_name] );
			} elseif( $field->type == 'editor' ) {
				update_post_meta( $post_id, $field_name, $_POST[$field_name] );
			} else if ( $field->type == 'responsive_images' ) {
				$value = array_map( 'sanitize_text_field', explode(',', $_POST[$field_name] ) );
				update_post_meta( $post_id, $field_name, $value );

			} else if ( $field->type == 'target' ) {
				$target = (object) $_POST[$field_name];
				if ( $target && isset($target->url) && isset($target->id) ) {
					$target->url = sanitize_text_field( $target->url );
					$target->id = sanitize_text_field( $target->id );
					update_post_meta( $post_id, $field_name, $target );
				}
			} else if ( $field->type == 'product' ) {
				$product = (object) $_POST[$field_name];
				if ( $product && isset($product->id) ) {
					$product->id = sanitize_text_field( $product->id );
					update_post_meta( $post_id, $field_name, $product );
				}
			}
		}
		
		return;
	}

	public function enqueueScripts() {
		wp_enqueue_media();
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script( 'customposttype-js', get_template_directory_uri() . '/library/customposttype.js' );
	}

	public function _actionThePost( $post ) {
		if ( $post->type == $this->name ) {
			$this->preparePost($post);
		}
	}

	public function _actionPreGetPosts( $query ) {

		if ( is_admin() )
			return;

		if( !isset($query->query_vars['post_type'])
			|| $this->name !== $query->query_vars['post_type'] )
			return;

		if ( $this->postsPerPage )
			$query->set('posts_per_page', $this->postsPerPage);

		if ( $this->orderBy ) {

			// ASC if field is "field" DESC if field is "!field"
			$ascending = preg_match('/\!/', $this->orderBy) ? false : true;
			$field = str_replace('!', '', $this->orderBy);

			$query->set('order', $ascending ? 'ASC' : 'DESC');
			if ( isset($this->fields[$field] ) ) {
				$query->set('orderby', 'meta_value');
				$query->set('meta_key', $field);
			}

		}

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