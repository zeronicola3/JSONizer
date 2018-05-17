<?php

include 'core_function.php';

add_action( 'save_post_project', 'timeline_update' );

update_json_file();

?>