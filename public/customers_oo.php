<?php

include('../private/initialize.php');

$page = $_GET['page'] ?? 1;
$sqla = "SELECT * FROM customers";
$results = $connection->prepare($sqla);
$results->execute();
$array = $results->rowCount();

$total_count = $array;
$pagination = new Pagination($total_count,$page,20);
$offset = $pagination->offset();

global $connection;
$sql = "SELECT * FROM customers ";
  $sql .= "ORDER BY last_name ASC, first_name ASC ";
  $sql .= " LIMIT $pagination->per_page OFFSET $offset";
  $result = $connection->prepare($sql);
  $result->execute();
  $customers = $result->fetchAll(PDO::FETCH_OBJ);

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
        Page <?php echo $pagination->current_page; ?> of
        <?php echo $pagination->total_pages(); ?>
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
        <?php echo $pagination->previous_link('customers_oo.php'); ?>
        <?php echo $pagination->number_links('customers_oo.php'); ?>
        <?php echo $pagination->next_link('customers_oo.php'); ?>
    </p>

</body>

</html>