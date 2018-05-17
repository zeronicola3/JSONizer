<?php



function get_images($post_id) {

	$img_id = get_post_thumbnail_id($post_id);
	$img_secondary_id = get_post_meta($post_id, 'webkolm_featured_img_input', true);

	if($img_id != "") {
		return array(
			'medium' => wp_get_attachment_image_src( $img_id, 'medium' )[0],
			'large' => wp_get_attachment_image_src( $img_id, 'large' )[0],
			'full' => wp_get_attachment_image_src( $img_id, 'full' )[0],
		);
	} else if($img_secondary_id != "") {

		return array(
			'medium' => wp_get_attachment_image_src( $img_secondary_id, 'medium' )[0],
			'large' => wp_get_attachment_image_src( $img_secondary_id, 'large' )[0],
			'full' => wp_get_attachment_image_src( $img_secondary_id, 'full' )[0],
		);

	} else {

		$gallery = get_post_meta($post_id, 'webkolm_gallery_test', true);

		if($gallery != "") {

	        preg_match('/\[gallery.*ids=.(.*).\]/', $gallery, $ids);
	        $array_id = explode(",", $ids[1]);

	        return array(
				'medium' => wp_get_attachment_image_src( $array_id[0], 'medium' )[0],
				'large' => wp_get_attachment_image_src( $array_id[0], 'large' )[0],
				'full' => wp_get_attachment_image_src( $array_id[0], 'full' )[0],
			);
	    }
	}
	
	return null;
}




function get_posts_array($custom_post_type = 'post'){

    global $post;

	$args = array(
		'post_type' => $custom_post_type,
		'posts_per_page' => -1,
    );
    
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
	    // Start the Loop.
	    while ( $query->have_posts() ) : $query->the_post();

            array_push($posts_array, array(
	    		'ID' => $post->ID,
	    		'slug' => $post->post_name,
	    		'title' => $post->post_title,
                'description' => $post->post_excerpt,
                'author' => get_the_author($post->ID),
	    		'url' => get_the_permalink($post->ID),
                'img_urls' => get_images($post->ID),
                'categories' => wp_get_post_categories( $post->ID ),
	    	));

	    endwhile;
	endif;

	return $posts_array;
}

?>