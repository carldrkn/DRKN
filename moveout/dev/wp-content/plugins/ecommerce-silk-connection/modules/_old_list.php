<?
	//Receives a raw list of articles.
	//If list is larger than total articles show category

	function init_list($attrs) {
		
		if(isset($attrs['count']) && !empty($attrs['count'])) {
			$count = $attrs['count'];
		}else {
			$count = 10; 
		}
		
		$args = array( 'post_type' => 'silk_products', 'posts_per_page' => 100 );
		$loop = new WP_Query( $args );
		//Use tpl to decide which format to print out data.

		if ($loop->have_posts()) {

		
			
		$categories = get_terms('category', array('orderby' => 'name'));
?>
<div class="row full-width filter">
	<div class="large-12 columns">
		<ul id="category-menu">		
			<li class="active"><a href="/shop">All</a></li>			
			<?php foreach($categories as $cat): ?>
				<?php if($cat->term_id != '1'): ?>
					<li><a href="/shop" data-slug="<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
	
	  	</ul>		
	</div>
</div>
<div class="main">
	<div class="row full-width">
		<div class="large-8 large-centered columns">
			<div class="grid shop">
        		<div class="grid-sizer">&nbsp;</div>
<?
			while ($loop->have_posts()) {
				$loop->the_post();

				//Remove API call from posts.
				if($loop->post->post_name === 'retrieve-prods') continue;

				//Grab associated meta data.
				$jsonParams = json_decode(get_post_meta( $loop->post->ID, 'json', true ), true);
				$img = $jsonParams['media'][0]['sources']['standard'];
				
				if (empty($img)) $img['url'] = 'http://placehold.it/350x550';

				$availability = esc_get_availability($jsonParams);
				if(empty($availability)) continue;			
				
				// Categories
				$categories = array();				
				foreach (get_the_category() as $cat) {
					$categories[] = $cat->slug;
				}				
				$jsonCats = json_encode($categories);
?>
                <div class="grid-item w2" data-categories='<?php echo $jsonCats; ?>'>
                	<a href="/product/<?php echo $jsonParams['uri']; ?>">
	                	<div class="grid-item-content">		                     
	                     	<img src="<?php echo $img['url']; ?>">	                                   		
	                	</div>
                     	<div class="text">
		                       	<h2>
		                       		<?=the_title()?>                   		
		                       	</h2>
		                       	<p>
		                       		<?=($availability['price']?$availability['price']:'')?>         			
		                   		</p>	                     		
	                     	</div>	
                	</a> 
                </div>				
<?
			}
?>
			</div>
		</div>
	</div>			
</div>  
<?
		}

	}
