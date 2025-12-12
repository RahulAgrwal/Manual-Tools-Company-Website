<?php
require 'vendor/autoload.php';

function visitor($page_name_)
{
    // Set Indian Standard Timezone
    date_default_timezone_set('Asia/Kolkata');
    $user_ip = get_client_ip();

    // Retrieve location data
    $city = "";
    $country = "";
    $latitude = "";
    $longitude = "";
    $zip = "";
    $regionName = "";

    $db_host = "193.203.184.94:3306";
    $db_username = "u427644097_manualtoolsco";
    $db_password = "Manual@06";
    $db_name = "u427644097_manualtoolsco";


    $db_table = "visitor_count";
    $page_name = "page_name";
    $visitor_count = "visitor_count";
    $timestamp_column = "last_visit"; // Add the name of your timestamp columnl̥

    // Make the API request and get the response
    $url = 'http://ip-api.com/json/' . $user_ip;
    // $url = 'http://ip-api.com/json/2401:4900:30c5:e88d:0:64:97d7:f301';
    // print_r("URL : ".$url);
    $response = file_get_contents($url);
    // print_r($response);

    // If successful response
    if ($response !== false) {
        // Decode JSON response
        $data = json_decode($response, true);

        // Print the response data
        $country = isset($data['country']) ? $data['country'] : "";
        $city = isset($data['city']) ? $data['city'] : "";
        $latitude = isset($data['lat']) ? $data['lat'] : "";
        $longitude = isset($data['lon']) ? $data['lon'] : "";
        $zip = isset($data['zip']) ? $data['zip'] : "";
        $regionName = isset($data['regionName']) ? $data['regionName'] : "";
        // print_r($country);
    } else {
        // Handle error
        // echo "Failed to fetch API response.";
    }




    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die("Host or database not accessible");

    // Convert current time to string format
    $current_time = date('Y-m-d H:i:s');

    $sql = "INSERT INTO visitors (page_name,ip_address, city, country, latitude, longitude, visit_time, zip, region)  VALUES ('$page_name_','$user_ip', '$city', '$country', '$latitude', '$longitude', '$current_time', '$zip', '$regionName') ";
    mysqli_query($db, $sql) or die("Error while entering");
    // Construct SQL query to insert or update visitor count with timestamp
    $sql_call = "INSERT INTO " . $db_table . " (" . $page_name . ", " . $visitor_count . ", " . $timestamp_column . ") VALUES ('" . $page_name_ . "', 1, '" . $current_time . "') ON DUPLICATE KEY UPDATE " . $visitor_count . " = " . $visitor_count . " + 1, " . $timestamp_column . " = '" . $current_time . "'";

    // Execute the SQL query
    mysqli_query($db, $sql_call) or die("Error while entering");

    // Construct SQL query to select visitor count for the page
    $sql_call = "SELECT " . $visitor_count . " FROM " . $db_table . " WHERE " . $page_name . " = '" . $page_name_ . "'";

    // Execute the SQL query
    $sql_result = mysqli_query($db, $sql_call) or die("SQL request failed ");

    // Fetch the result
    $row = mysqli_fetch_assoc($sql_result);
    $x = $row[$visitor_count];

    // Close the database connection
    mysqli_close($db);

    return $x;
}

function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
