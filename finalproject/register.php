<?php

require 'vendor/autoload.php'; // Path to the autoload.php file generated by Composer

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;

$credentials = new Aws\Credentials\Credentials('AKIA6OLYM76FNAKEV5MV', 'B1mVOdwROBrhnpKS99xRAh9GCGeTtPyQBKt6inDV');
$config = [
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => $credentials
];

$dynamoDb = new DynamoDbClient($config);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $occupation = $_POST['occupation'];
    $nationality = $_POST['nationality'];
    $maritalStatus = $_POST['maritalstatus'];
  //  $loggedIn = $_POST['loggedIn'];

    // Check if any required field is empty
    if (empty($username) || empty($password) || empty($fullname) || empty($email) || empty($age)) {
        $message = 'Please fill all the required fields.';
        $redirectUrl = "signup.php?message=" . urlencode($message);
        header("Location: $redirectUrl");
        exit();
    }

    // Create the item data
    $itemData = [
        'Username' => ['S' => $username],
        'Password' => ['S' => $password],
        'Name' => ['S' => $fullname],
	'Email' => ['S' => $email],
	'Gender' => ['S' => $gender],
        'Age' => ['S' => $age],
        'Occupation' => ['S' => $occupation],
        'Nationality' => ['S' => $nationality],
	'Marital-status' => ['S' => $maritalStatus],
//	'LoggedIn' => ['bool' => $loggedIn],
        // Add more attributes as needed
    ];

    // Specify the table name
    $tableName = 'GuestBook';

    // Put the item in the DynamoDB table
    try {
        $result = $dynamoDb->putItem([
            'TableName' => $tableName,
            'Item' => $itemData
        ]);

        echo 'Item added successfully.';
        header("Location: successful.php");
        exit(); // Make sure to exit after redirecting
    } catch (DynamoDbException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// If the code reaches here, it means the form was not submitted correctly
$message = 'Please fill the form correctly.';
$redirectUrl = "signup.php?message=" . urlencode($message);
header("Location: $redirectUrl");
exit();
?>

