<?php
require 'vendor/autoload.php';
require_once __DIR__ . '/load-secrets.php';

/**
 * Records a visit for $page_name_ and returns the page's total visitor count.
 * Returns null if the database is not configured or unreachable, so the page
 * still renders (footer.php shows a fallback number).
 */
function visitor($page_name_)
{
    // Set Indian Standard Timezone
    date_default_timezone_set('Asia/Kolkata');
    $user_ip = get_client_ip();

    $secrets = mtc_secrets();
    if (empty($secrets['db_host']) || empty($secrets['db_user']) || empty($secrets['db_name'])) {
        return null;
    }

    // Retrieve location data
    $city = "";
    $country = "";
    $latitude = "";
    $longitude = "";
    $zip = "";
    $regionName = "";

    // Make the API request (short timeout so a slow API doesn't stall the page)
    $url = 'http://ip-api.com/json/' . rawurlencode($user_ip);
    $context = stream_context_create(['http' => ['timeout' => 3]]);
    $response = @file_get_contents($url, false, $context);

    // If successful response
    if ($response !== false) {
        $data = json_decode($response, true);

        $country = isset($data['country']) ? $data['country'] : "";
        $city = isset($data['city']) ? $data['city'] : "";
        $latitude = isset($data['lat']) ? (string)$data['lat'] : "";
        $longitude = isset($data['lon']) ? (string)$data['lon'] : "";
        $zip = isset($data['zip']) ? $data['zip'] : "";
        $regionName = isset($data['regionName']) ? $data['regionName'] : "";
    }

    // Convert current time to string format
    $current_time = date('Y-m-d H:i:s');

    try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $db = new mysqli(
            $secrets['db_host'],
            $secrets['db_user'],
            $secrets['db_pass'] ?? '',
            $secrets['db_name'],
            (int)($secrets['db_port'] ?? 3306)
        );

        // Log individual visit
        $stmt = $db->prepare(
            "INSERT INTO visitors (page_name, ip_address, city, country, latitude, longitude, visit_time, zip, region)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('sssssssss', $page_name_, $user_ip, $city, $country, $latitude, $longitude, $current_time, $zip, $regionName);
        $stmt->execute();
        $stmt->close();

        // Insert or increment the per-page counter
        $stmt = $db->prepare(
            "INSERT INTO visitor_count (page_name, visitor_count, last_visit) VALUES (?, 1, ?)
             ON DUPLICATE KEY UPDATE visitor_count = visitor_count + 1, last_visit = ?"
        );
        $stmt->bind_param('sss', $page_name_, $current_time, $current_time);
        $stmt->execute();
        $stmt->close();

        // Read back the count for this page
        $stmt = $db->prepare("SELECT visitor_count FROM visitor_count WHERE page_name = ?");
        $stmt->bind_param('s', $page_name_);
        $stmt->execute();
        $stmt->bind_result($x);
        $stmt->fetch();
        $stmt->close();

        $db->close();

        return $x;
    } catch (Throwable $e) {
        error_log('webcounter: ' . $e->getMessage());
        return null;
    }
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

    // Forwarded headers can hold a comma-separated list; keep the first address
    $ipaddress = trim(explode(',', $ipaddress)[0]);
    return substr($ipaddress, 0, 45);
}
