<?php
include("db.php");


$query = "SELECT * FROM cars";
$query_car_info = mysqli_query($connect, $query);


if (!$query_car_info) {
    die("Query failed" . mysqli_error($connect));
}

$number = 1;
while ($row = mysqli_fetch_array($query_car_info)) {
    echo "<tr>";
    echo "<td>{$number}</td>";
    echo "<td><a rel='" . $row['id'] . "'class='title-link' href='javascript:void(0)'>{$row['title']}</a></td>";
    echo "</td>";
     ++$number;
}

?>


<script>
    $(document).ready(function() {
        // $("#action-container").hide();

        $(".title-link").on('click', function() {
            // alert('Click');

            $("#action-container").show();

            var id = $(this).attr("rel");
            // alert(id);
            $.post("process.php", {
                id: id
            }, function(data) {
                // alert(data)
                $("#action-container").html(data);

            });
        });
    });
</script>