<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: guestlist.php'); // Redirect to the protected page
    exit;
}

require 'vendor/autoload.php';

use Aws\Credentials\Credentials;
use Aws\DynamoDb\DynamoDbClient;

$credentials = new Credentials('AKIA6OLYM76FNAKEV5MV', 'B1mVOdwROBrhnpKS99xRAh9GCGeTtPyQBKt6inDV');
$dynamodb = new DynamoDbClient([
    'region' => 'us-east-1',
    'version' => '2012-08-10',
    'credentials' => $credentials,
]);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $tableName = 'GuestBook';

    $result = $dynamodb->scan([
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
        if (isset($user['Password']['S']) && $user['Password']['S'] === $password) {
            // Authentication successful
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Update the session_start column in DynamoDB to true
            $dynamodb->updateItem([
                'TableName' => $tableName,
                'Key' => [
                    'Username' => ['S' => $usermane],
                ],
                'UpdateExpression' => 'SET session_start = :sessionStart',
                'ExpressionAttributeValues' => [
                    ':sessionStart' => ['BOOL' => true],
                ],
            ]);

            $message = "Login successful!";
            $redirectUrl = "guestlist.php";
            // Add a delay before redirecting to the next page
            echo "<meta http-equiv='refresh' content='2;url=$redirectUrl'>";
            exit;
        }
    }

    // The login failed
    $message = "Invalid username or password";
    $redirectUrl = "index.php?message=" . urlencode($message);
    header("Location: $redirectUrl");
    exit;
}

// Redirect back to the index page if the form was not submitted correctly
header("Location: index.php");
exit;
?>