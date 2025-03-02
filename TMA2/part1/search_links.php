<?php
   include('connection.php');
   session_start();

   if (!isset($_SESSION['username'])) {
       header("Location: login.php");
       exit();
   }

   $username = $_SESSION['username']; 

    $query = isset($_GET['query']) ? $database->real_escape_string($_GET['query']) : '';

    $sql = "SELECT link_name, link_adr, link_id FROM links 
            WHERE user_name='$username'";

    if (!empty($query)) {
        $sql .= " AND (link_name LIKE '%$query%' OR link_adr LIKE '%$query%')";
    }

    $sql .= " ORDER BY link_name ASC";

    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<li class="link-display">
                    <a href="' . $row['link_adr'] . '" target="_blank" class="abi saved-link" data-link-id="' . $row['link_id'] . '">' . $row['link_name'] . '</a> 
                    <div">
                        <button type="button" class="cta" onclick="editLink(' . $row['link_id'] . ')">EDIT</button>
                        <button type="button" class="cta" onclick="deleteLink(' . $row['link_id'] . ')">DELETE</button>
                    </div>
                </li>';
        }
    } else {
        echo "<li>No results found</li>";
    }

    $database->close();
?>
