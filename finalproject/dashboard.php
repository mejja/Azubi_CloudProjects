<?php

ini_set('display_errors', 0);
error_reporting(E_ALL);
session_start();



// Check if the us er is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php'); // Redirect to the login page
    exit;
}
?>

<!DOCTYPE html> 

<html> 
<head>
  <meta charset="utf-8">
  <title>Azubi Africa: Dashboard</title>
  <link rel="stylesheet" type="text/css" href="style.css">
 <style>
 .card-wrapper {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-left:25px;
  }

  .card {
    background-color: #f3f3f3;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .card-title {
    font-weight: bold;
    color: #009879;
  }

  .card-content {
    color: #333;
  }
</style>
</head>

<body style="width:100%;overflow:hidden"> 


<div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
  <h1><a href="#" rel="dofollow">DashBoard</a></h1>
  <button style="position:absolute;right:3rem;padding:.3rem"><a href="logout.php" rel="dofollow" style="color:red">Log out</a></button>
</div>


<!-- how we display our content -->

<?php

//require 'loggedInUsers.php';

// Include the AWS SDK for PHP
require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;
$access_key = 'YOUR_ACCESS_KEY';
$secret_key = 'YOUR_SECRET_KEY';

// Configure AWS SDK
$client = new DynamoDbClient([
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
        'key' => $access_key,
        'secret' => $secret_key,
    ],
]);


// Function to retrieve unique nationalities and their occurrences
function getUniqueNationalities() {
    
    global $client;

    // DynamoDB table name
    $tableName = 'GuestBook';

    // Scan the table to retrieve all items
    $params = [
        'TableName' => $tableName,
        'ProjectionExpression' => 'Nationality',
    ];

    try {
        $result = $client->scan($params);

        // Count the occurrences of each nationality
        $nationalityCount = [];
        foreach ($result['Items'] as $item) {
            $nationality = $item['Nationality']['S'];
            if (isset($nationalityCount[$nationality])) {
                $nationalityCount[$nationality]++;
            } else {
                $nationalityCount[$nationality] = 1;
            }
        }

        return $nationalityCount;
    } catch (Exception $e) {
        // Handle the exception
        echo "Error: " . $e->getMessage();
    }
}

function loggedInSubscribers()
{

  global $client;

    // DynamoDB table name
    $tableName = 'GuestBook';

    // Perform a scan operation to retrieve all items
    $params = [
      'TableName' => 'GuestBook',
      'FilterExpression' => 'LoggedIn = :loggedIn',
      'ExpressionAttributeValues' => [
          ':loggedIn' => ['BOOL' => true],
      ],
      'Select' => 'COUNT',
  ];

  try {
    $result = $client->scan($params);
    $count = $result['Count'];
    return $count;
  } catch (Exception $e) {
      // Handle the exception
      echo "Error: " . $e->getMessage();
  }
}

// Function to count the number of users
function countUsers()
{
    global $client;

    // DynamoDB table name
    $tableName = 'GuestBook';

    // Perform a scan operation to retrieve all items
    $params = [
        'TableName' => $tableName,
        'Select' => 'COUNT',
    ];

    try {
        $result = $client->scan($params);
        $count = $result['Count'];
        return $count;
    } catch (Exception $e) {
        // Handle the exception
        echo "Error: " . $e->getMessage();
    }
}

function loggedInUsers()
{
    global $client;

    // Perform a scan operation to retrieve the logged-in users
    $params = [
        'TableName' => 'GuestBook',
        'FilterExpression' => 'LoggedIn = :loggedIn',
        'ExpressionAttributeValues' => [
            ':loggedIn' => ['BOOL' => true],
        ],
    ];

    $result = $client->scan($params);

    $items = $result['Items'];

    $loggedInUsers = [];

    foreach ($items as $item) {
        $email = $item['Email']['S'];
        $loginTime = $item['LoginTime']['S'];

        $loggedInUsers[] = ['email' => $email, 'loginTime' => $loginTime];
    }

    return $loggedInUsers;
}


// Count the number of users
$userCount = countUsers();

$logInSubscribers = loggedInSubscribers();

// Retrieve unique nationalities and their occurrences
$nationalityCount = getUniqueNationalities();

// Display the result

echo '<div class="card-wrapper">';
echo '<div class="card">';

// Display the result
echo "<div class='card-title'>Nationalities and Counts</div>";
echo "<div class='card-content'>";
foreach ($nationalityCount as $nationality => $count) {
    echo "Country: $nationality - users: $count" . "<br>";
}

echo "</div>";
echo "</div>";

$userLoggedIn = loggedInUsers();

// Convert the array to a string
$userString = implode("<br>", array_map(function($user) {
    return "Email: " . $user['email'] . " ".", Login Time: " . $user['loginTime'];
}, $userLoggedIn));

echo '<div class="card">';
// Display the result
echo "<div class='card-title'>Total Number of subscribers</div>";
echo "<div div class='card-content'> </div>" . $userCount. "<br>";
echo '</div>';

echo '<div class="card">';
echo "<div class='card-title'>Logged In Users:</div>";
echo "<div div class='card-content'> </div>" . $userString . "<br>";
echo '</div>';


echo '<div class="card">';
echo "<div class='card-title'>Number of Logged In Users</div>";
echo "<div div class='card-content'> </div>" . $logInSubscribers . "<br>";
echo "</div>";
echo "</div>";

?>


<!-- styles for our table .... dont tamper -->
<style>
  .styled-table {
    border-collapse: collapse;
    margin: 25px 20%;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  }
  .styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
  }
  .styled-table th,
  .styled-table td {
    padding: 12px 15px;
  }
  .styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
  }

  .styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
  }

  .styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
  }
</style>


<div class="padding-top--64">
  <div class="loginbackground-gridContainer">
    <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
      <div class="box-root" >
      </div>
    </div>
<div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
</body>
</html>