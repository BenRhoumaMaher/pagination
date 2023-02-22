<?php

include('../private/initialize.php');
include('../private/customers_array.php');

// number of record for each page
$per_page = 20;
// get the number of all records 
$total_count = count($all_customers);
// set the total number of pages
$total_pages = ceil($total_count / $per_page);
// get the current page, and if there's no value set, then get the first page
$current_page = (int) ($_GET['page'] ?? 1);
//check if the page less than 1 or greater than the last page
if($current_page < 1 || $current_page > $total_pages) {
  $current_page = 1;
}
// set the record to start with for every page
$offset = $per_page * ($current_page - 1);
// the data to display
/* here we wanna slice from the all_customers array, starting from the offset, an per_page number
of record */
$customers = array_slice($all_customers, $offset, $per_page);


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
        $first_name = $customer[0];
        $last_name = $customer[1];
        echo "<tr>";
        echo "<td>" . h($first_name) . "</td>";
        echo "<td>" . h($last_name) . "</td>";
        echo "</tr>";
      }

      ?>

    </table>

</body>

</html>