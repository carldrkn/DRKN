<?

	function create_prods() {

		//Prenumeration http://axellusdemo.silkvms.com/litomove/plugin-export/subscription/packages?secret=xxx&pricelist=SEK
		
		
		// Get gigs
		$url = "http://api.bandsintown.com/artists/avicii/events.json?api_version=2.0&app_id=" . md5(rand(20, 200));
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);	
		
		$uploadsDir = wp_upload_dir();
		
		$file = $uploadsDir['basedir'] . '/locations.txt';
		file_put_contents($file, $data);
		
		// Get countries available
		$countries = esc_rest('countries');
		$countries = $countries->get();
		
		$file2 = $uploadsDir['basedir'] . '/countries.txt';
		file_put_contents($file2, json_encode($countries));
		
		//Get all products check them off against incoming. Remove old products that are no longer linked.
		$prev_prods = get_option('esc_curr_prods');
		$prev_prods = $prev_prods ? $prev_prods : array();
		$curr_prods = array();
		$prod_packages = array();
		$plugin_options = get_option('esc_options');

		//Request JSON data from Silk
		$prodReq = esc_rest('products');
		$products = $prodReq->get();

		if($plugin_options['esc_demo_on'] == 1) {
			pr($prodReq->dump());
			pr($products);
			pr($packages);
		}
		
		// Create category		
		$catsReq = esc_rest('categories');
		$cats = $catsReq->get();
		$insCats = array();
		
		// Insert categories
		$newCats = array();
		foreach ($cats as $cat) {
			
			if ( ! isset($cat['categories'])) {
				if ( ! $id = get_term_by('name', $cat['name'], 'category')) {				
					$id = wp_insert_term($cat['name'], 'category');				
				} 	
				$newCats[$cat['category']] = $id->term_id;				
			}	

		}

		foreach ($products as $key => $prod) {
			$postCategories = array();
			
			// Create category array for post
			foreach ($prod['categories'] as $key => $postCat) {
				$postCategories[] = $newCats[$key];
			}
						
			
			$post_arr = array(
				'post_name' => $prod['uri'],
				'post_title' => $prod['name'],
				'post_content' => $prod['description'],
				'post_excerpt' => $prod['excerpt'],
				'post_status' => 'publish',
				'post_type' => 'silk_products'
			);

			//Check if product has any subscriptions
			if(isset($prod_packages[$prod['sku']])) {
				$prod['subscription'] = $prod_packages[$prod['sku']];
			} else {
				$prod['subscription'] = false;
			}

			$args = array('name' => $prod['uri'], 'post_type' => 'silk_products', 'post_status' => 'publish', 'posts_per_page' => 1 );
			$posts = get_posts($args);

			if($posts) {
				$post_id = $posts[0]->ID;
				$post_arr['ID'] = $post_id;
				wp_update_post($post_arr);				
				wp_set_post_terms( $post_id, $postCategories, 'category' );
				
				echo 'Updated product: '.$prod['name'].'<br />';
			} else {
				$post_id = wp_insert_post($post_arr);
				wp_set_post_terms( $post_id, $postCategories, 'category' );
				echo 'Inserted product: '.$prod['name'].'<br />';
			}

			$curr_prods[$prod['uri']] = $post_id;
			//Remove from array for deletion.
			if(isset( $prev_prods[$prod['uri']] )) unset($prev_prods[$prod['uri']]);

			$prev_meta_data = get_post_meta($post_id, 'json');
			if(empty($prev_meta_data)) {
				add_post_meta($post_id, 'json', json_encode($prod, JSON_UNESCAPED_UNICODE));
			} else {
				update_post_meta($post_id, 'json', json_encode($prod, JSON_UNESCAPED_UNICODE));
			}

		}

		//Remove products no longer needed everything in prev_prods array
		foreach ($prev_prods as $post_id) {
			wp_delete_post($post_id, true);
			delete_post_meta($post_id, 'json');
		}

		update_option('esc_curr_prods', $curr_prods);

		/*
		- Items not used at all ('post_author','ping_status','to_ping','pinged','post_password','guid','post_content_filtered','post_date','post_date_gmt','comment_status','tax_input','page_template','import_id')
		
		// Main Product
		$post = array(
			'ID'             		=> [ <post id> ] // Find an existing product.
			'post_content'   		=> [ <string> ] // Description from product.
			'post_name'      		=> [ <string> ] // Product uri from Silk
			'post_title'     		=> [ <string> ] // Product Title.
			'post_status'    		=> [ 'draft' | 'publish' | 'pending'| 'future' | 'private' | custom registered status ] // Set as Publish.
			'post_type'      		=> [ 'post' | 'page' | 'link' | 'nav_menu_item' | 'silk_products' ] // Set as silk_products - custom posts.
			'post_parent'    		=> [ <post ID> ] // Can be used for product items
			'menu_order'     		=> [ <order> ] // Might be able to use this to sort products based on category structure
			'post_excerpt'   		=> [ <string> ] // Product excerpt or short description
			'post_category'  		=> [ array(<category id>, ...) ] // Can be used to sort products into correct categories. Must work out category ID first. Not needed yet.
			'tags_input'     		=> [ '<tag>, <tag>, ...' | array ] // Not used, default. May be needed??..
		);

		// Item

		*/ 

	}
