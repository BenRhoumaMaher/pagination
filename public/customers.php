<?php

include('../private/initialize.php');

  $per_page = 20;
  $current_page = (int) ($_GET['page'] ?? 1);
  $offset = $per_page * ($current_page - 1);

  global $connection;
  $sql = "SELECT * FROM customers ";
  $sql .= "ORDER BY last_name ASC, first_name ASC ";
  $sql .= " LIMIT $per_page OFFSET $offset";
  $result = $connection->prepare($sql);
  $result->execute();
  $customers = $result->fetchAll(PDO::FETCH_OBJ);

  $sqla = "SELECT * FROM customers";
  $results = $connection->prepare($sqla);
  $results->execute();
  $array = $results->rowCount();

  $total_count = $array;
  $total_pages = ceil($total_count / $per_page);
  if($current_page < 1 || $current_page > $total_pages) {
  $current_page = 1;
  }
?>

<!doctype html>

<html lang="en">

<head>
    <title>Customer List</title>
    <link rel="stylesheet" href="stylesheets/public.css">
</head>

<body>

    <h1>Customer List</h1>

    <p class="page-status">
        <?php echo "Page {$current_page} of {$total_pages}"; ?>
    </p>

    <table id="customer-list">
        <tr>
            <th>First name</th>
            <th>Last name</th>
        </tr>

        <?php
        foreach($customers as $customer) {
          echo "<tr>";
          echo "<td>" . h($customer->first_name) . "</td>";
          echo "<td>" . h($customer->last_name) . "</td>";
          echo "</tr>";
        }
      ?>
    </table>
    <p class="pagination">
        <?php
      if($current_page > 1){
        echo "<a href=\"customers.php?page=".($current_page - 1)."\">&larr; Previous</a>"; 
      }  
      ?>
        <?php 
          $win = 2;
          $gap = false;
          for($i=1; $i <= $total_pages; $i++) {
            if($i > 1 + $win && $i < $total_pages - $win && abs($i - $current_page) > $win){
              if(!$gap){
                echo "... ";
                $gap = true;
              }
              continue;
            }
            $gap = false;
            if($current_page == $i){
              echo "<strong>{$i}</strong> ";
            } else {
              echo "<a href=\"customers.php?page={$i}\">{$i}</a> ";
            }
          }
        ?>
        <?php
      if($current_page < $total_pages){
        echo "<a href=\"customers.php?page=".($current_page + 1)."\">Next &rarr;</a>"; 
      }  
      ?>
    </p>

</body>

</html>