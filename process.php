<?php
include("db.php");

// echo "ther";

// QUERY DATA

if (isset($_POST['id'])) {

    $id = mysqli_real_escape_string($connect, $_POST['id']);


    $query = "SELECT * FROM cars WHERE id = {$id}";
    $query_car_info = mysqli_query($connect, $query);


    if (!$query_car_info) {
        die("Query failed" . mysqli_error($connect));
    }

    while ($row = mysqli_fetch_array($query_car_info)) {



        echo "<input rel='" . $row['id'] . "' type='text' class='form-control title-input' value='" . $row['title'] . "'>";
        echo "<input type='button' class='btn btn-success update' value='Update'>";
        echo "<input type='button' class='btn btn-danger delete' value='Delete'>";
        echo "<input type='button' class='btn btn-close ml-5 close'>";
    }
}

// UPDATING DATA

if (isset($_POST['updatethis'])) {
    // echo "E dey Job";
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $title = mysqli_real_escape_string($connect, $_POST['title']);

    $query = "UPDATE cars SET title = '$title' WHERE id = $id ";
    $result_set = mysqli_query($connect, $query);

    if (!$result_set) {
        die("Query failed" . mysqli_error($connect));
    }
}

// DELETING DATA

if (isset($_POST['deletethis'])) {
    // echo "E dey Job";
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $id = $_POST['id'];

    $query = "DELETE FROM cars WHERE id = $id ";
    $result_set = mysqli_query($connect, $query);

    if (!$result_set) {
        die("Query failed" . mysqli_error($connect));
    }
}


?>

<script>
    $(document).ready(function() {

        var id;
        var title;
        var updatethis = "Updated";
        var deletethis = "Deleted";

        // EXTRACT ID & TITLE

        $(".title-input").on('input', function() {

            id = $(this).attr('rel');
            title = $(this).val();

            // alert(title);

        });


        // UPDATE BUTTON
        $(".update").on('click', function() {
            // alert("title");


            $.post("process.php", {
                id: id,
                title: title,
                updatethis: updatethis
            }, function(data) {
                // alert("Updated Succesfully");
                $("#feedback").text("Updated Succesfully");

            });

        });

        // DELETE BUTTON
        $(".delete").on('click', function() {

            if (confirm('Are You Sure?')) {
                id = $(".title-input").attr('rel');
                // alert("title");

                $.post("process.php", {
                    id: id,
                    deletethis: deletethis
                }, function(data) {
                    alert("Done");
                    // alert("Updated Succesfully");
                    // $("#feedback").text("Deleted Succesfully");

                    $("#action-container").hide();

                });
            }

        });

        // CLOSE BUTTON
        $(".close").on('click', function() {
            $("#action-container").hide();
        });


    });
</script>