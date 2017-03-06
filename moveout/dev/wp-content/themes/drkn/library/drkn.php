<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 16:57
 */


class Drkn {

	public static $imageSizes = array(
		300, 500, 750, 1000, 1250, 1500, 1800
	);

	public static function getImageSizes() {
		$sizes = array();
		foreach ( self::$imageSizes as $size )
			$sizes[] = 'drkn_' . $size;
		return $sizes;
	}

	public static $images = array();

}

function responsive_img( $attachment_id, $class = null ) {

	if (!$attachment_id)
		return;

	?>
	<div data-id="<?php echo $attachment_id ?>" class="responsive-image image image-<?php echo $attachment_id ?><?php if ($class) echo ' ', $class; ?>">
		<img class="responsive-image-img" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="" />
	</div>
	<?php

	$sizes = array(

	);

	foreach ( Drkn::getImageSizes() as $size ) {
		$size = wp_get_attachment_image_src( $attachment_id, $size );
		if ( $size ) {
			list($url, $width, $height) = $size;
			$sizes[] = array(
				'url' => $url,
				'width' => $width,
				'height' => $height
			);
		}
	}

	$size = wp_get_attachment_image_src( $attachment_id, 'full' );
	list($url, $width, $height) = $size;

	Drkn::$images[$attachment_id] = array(
		'width' => $width,
		'height' => $height,
		'sizes' => $sizes
	);

}