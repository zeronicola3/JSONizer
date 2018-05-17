<?php
/**
 *  Creates json formatted output
 *  @return json string
 **/
function generate_json_file() {
    return json_encode(array());
}

/**
 *  Updates JSON content cache file in current theme directory
 *  @return file ./timezone_location_get().json 
 **/
function update_json_file(){

    $fp = fopen(__DIR__ . '/timeline.json', 'w');
    $data = generate_json_file();
    fwrite($fp, $data);
    fclose($fp);
}

/**
 *  Gets array from JSON
 *  @return file ./timeline.json 
 **/
function parse_json_file(){
    // Read JSON file
    $json = file_get_contents(__DIR__ . '/timeline.json');
    //Decode JSON
    $json_data = json_decode($json,true);

    return $json_data;
}

?>
