<?php
// Include the AWS SDK for PHP library
require 'vendor/autoload.php'; 

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;

// AWS configuration
$credentials = new Aws\Credentials\Credentials('YOUR_AWS_ACCESS_KEY', 'YOUR_AWS_SECRET_ACCESS_KEY');
$region = 'us-east-1'; 
$tableName = 'GuestBook'; 

// User inputs
$username = $_POST['username']; // Replace with the user input for username
$email = $_POST['email']; // Replace with the user input for email
$newPassword = $_POST['newPassword']; // Replace with the user input for new password

// Hash the new password
$hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);

// Create a new DynamoDB client
$dynamodb = new DynamoDbClient([
    'version' => '2012-08-10',
    'region' => $region,
    'credentials' => $credentials
]);

// Update the user's password
try {
    $result = $dynamodb->updateItem([
        'TableName' => $tableName,
        'Key' => [
            'Username' => ['S' => $username],
            'Email' => ['S' => $email]
        ],
        'ExpressionAttributeValues' => [
            ':password' => ['S' => $hashedPassword]
        ],
        'UpdateExpression' => 'SET Password = :password'
    ]);

    echo "Password updated successfully!";
} catch (DynamoDbException $e) {
    echo "Error updating password: " . $e->getMessage();
}
?>