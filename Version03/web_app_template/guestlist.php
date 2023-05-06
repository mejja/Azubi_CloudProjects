<!DOCTYPE html> 

<html> 
<head>
  <meta charset="utf-8">
  <title>Azubi Africa: List</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="width:100%;overflow:hidden"> 


<div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
  <h1><a href="#" rel="dofollow">Guest List</a></h1>
  <button style="position:absolute;right:3rem;padding:.3rem"><a href="index.php" rel="dofollow" style="color:red">Log out</a></button>
</div>

<!-- how we display our content -->
<table class="styled-table">
  <thead>
    <tr>
      <!-- tr is a row, th is the header, add or remove this to see changes on column header -->
      <th>Name</th>
      <th>Phone</th>
      <th>Country</th>
    </tr>
  </thead>
  <tbody>
    <?php
      // Set your credentials as environment variables
      $access_key = getenv('AWS_ACCESS_KEY');
      $secret_key = getenv('AWS_SECRET_KEY');
      
      // Use the AWS SDK for PHP
      require 'vendor/autoload.php';
      
      // Create an instance of the DynamoDB client with your credentials
      $client = new Aws\DynamoDb\DynamoDbClient([
          'version' => 'latest',
          'region' => 'us-east-1',
          'credentials' => [
              'key' => $access_key,
              'secret' => $secret_key,
          ],
      ]);
      
      // Perform operations on the DynamoDB table


      // Retrieve the guest list from DynamoDB
      $result = $client->scan([
        'TableName' => 'guests',
      ]);

      // Display the guests in a table
      foreach ($result['Items'] as $guest) {
        echo '<tr>';
        echo '<td>' . $guest['Name']['S'] . '</td>';
        echo '<td>' . $guest['Phone']['S'] . '</td>';
        echo '<td>' . $guest['Country']['S'] . '</td>';
        echo '</tr>';
      }
    ?>
  </tbody>
</table>

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
    <div class="box-root flex-flex" style="grid-area: 2 /
