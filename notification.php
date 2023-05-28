<?php

function sendNotification($deviceTokens, $title, $message, $apiKey)
{
    // Set the FCM API URL
    $url = 'https://fcm.googleapis.com/fcm/send';

    // Create the notification payload
    $notification = array(
        'title' => $title,
        'body' => $message,
        'sound' => 'default',
        'click_action' => '.MainActivity',
        'priority' => 'high'
    );

    // Create the data payload (optional)
    $data = array(
        'key1' => 'value1',
        'key2' => 'value2'
    );

    // Create the request body
    $body = array(
        'notification' => $notification,
        'data' => $data,
        'registration_ids' => $deviceTokens
    );

    // Set the request headers
    $headers = array(
        'Authorization: key=' . $apiKey,
        'Content-Type: application/json'
    );

    // Create the cURL request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
       echo 'Error: ' . curl_error($ch);
    }

    // Close the cURL request
    curl_close($ch);

    // Handle the response
    //echo $response;
}

function notif($o_id)
{
    // Example usage
    $deviceTokens = array(
        'e9yW8Jg9R-e4FYDBls5RQC:APA91bERcBG1R1tMeSSMKxD0U6hUayB9IfxB4i-wmp_lILBjwyz5ZLd5yTt-JU3LeSHI2AHMO7ZaGKX02-mZ6oZzF9kf_tDvTC7apb9kupiTxoJZ0bOBnsvMp_B9pOFkRu2ALG1pvmQs',
        // Add more device tokens as needed
    );

    $title = 'New Urgent Order' . $o_id;
    $message = 'You have a new urgent order.';

    $apiKey = 'AAAATMhrXtc:APA91bGoU2q_BzzgDh56_BCiih2olhJh754RDj6plDL9dUsFYV58IgiTWIAcKUi-UNlH_RjhrxolWXgw5fPoi_C1C2obvKiupTD5Q8xayViQYqsSicU8OM8xqNuPsxuuBkK0Tsl77djm';

    sendNotification($deviceTokens, $title, $message, $apiKey);
}

function notif2()
{
    // Example usage
    $deviceTokens = array(
        'e9yW8Jg9R-e4FYDBls5RQC:APA91bERcBG1R1tMeSSMKxD0U6hUayB9IfxB4i-wmp_lILBjwyz5ZLd5yTt-JU3LeSHI2AHMO7ZaGKX02-mZ6oZzF9kf_tDvTC7apb9kupiTxoJZ0bOBnsvMp_B9pOFkRu2ALG1pvmQs',
        // Add more device tokens as needed
    );

    $title = 'New Urgent Order';
    $message = 'You have a new urgent order.';

    $apiKey = 'AAAATMhrXtc:APA91bGoU2q_BzzgDh56_BCiih2olhJh754RDj6plDL9dUsFYV58IgiTWIAcKUi-UNlH_RjhrxolWXgw5fPoi_C1C2obvKiupTD5Q8xayViQYqsSicU8OM8xqNuPsxuuBkK0Tsl77djm';

    sendNotification($deviceTokens, $title, $message, $apiKey);
}
