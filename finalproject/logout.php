<?php

// Set up the DynamoDB client with your AWS credentials and configuration
require 'vendor/autoload.php';

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\DynamoDbClient;
use Aws\Credentials\Credentials;

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

session_start();

// Set up the DynamoDB client with your AWS credentials and configuration
$credentials = new Credentials('YOUR_ACCESS_KEY', 'YOUR_SECRET_KEY');

$client = new DynamoDbClient([
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => $credentials,
]);

// Get the user's email from the session or wherever it is stored
$username = $_SESSION['username'];
$tableName = 'GuestBook';

$result = $client->scan([
    'TableName' => $tableName,
    'FilterExpression' => '#usr = :username',
    'ExpressionAttributeNames' => [
        '#usr' => 'Username',
    ],
    'ExpressionAttributeValues' => [
        ':username' => ['S' => $username],
    ],
]);

$items = $result->get('Items');

if (!empty($items)) {
    $user = $items[0];
    $email = $user['Email']['S'];

    // Update the attributes for logout
    $params = [
        'TableName' => $tableName,
        'Key' => [
            'Email' => ['S' => $email],
            'Username' => ['S' => $username],
        ],
        'UpdateExpression' => 'SET LoggedIn = :loggedIn',
        'ExpressionAttributeValues' => [
            ':loggedIn' => ['BOOL' => false],
        ],
    ];
 try {
        $client->updateItem($params);

        // Destroy the session
        session_destroy();

        $redirectUrl = "index.php";
        // Add a delay before redirecting to the next page
        echo "<meta http-equiv='refresh' content='2;url=$redirectUrl'>";
        exit;
    } catch (DynamoDbException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


