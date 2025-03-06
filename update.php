<?php
$conn = new mysqli("localhost", "root", "", "phpapi");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM testapi WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Data not found!");
    }
} else {
    die("No ID provided!");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGaon - Student Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            background: rgb(76, 120, 175);
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .header button {
            background: white;
            color: rgb(76, 120, 175);
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 40px;
        }

        .header button:hover {
            background: #ddd;
        }

        .form-container {
            margin: 100px auto 0;
            padding: 20px;
            margin-top: 150px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            width: 350px;
            text-align: center;
        }

        .form-container input {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            background: rgb(76, 120, 175);
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #2d5a9c;
        }
    </style>
</head>

<body>

    <div class="header">
        <a href="show.php"><button>Show All</button></a>
        <button disabled>Add New Data</button>
    </div>

    <div class="form-container">
        <h3>Update Data</h3>
        <form id="updateForm" method="POST" action="update_action.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" placeholder="First Name" required>
            <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" placeholder="Last Name" required>
            <input type="tel" name="phone" value="<?php echo $row['phone']; ?>" placeholder="Phone" required>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" placeholder="Email" required>
            <button type="submit">UPDATE</button>
        </form>

        <p id="response"></p>
    </div>

    <script>
        $(document).ready(function() {
            $("#updateForm").on("submit", function(e) {
                e.preventDefault();

                var formData = {
                    id: $("input[name='id']").val(),
                    first_name: $("input[name='first_name']").val(),
                    last_name: $("input[name='last_name']").val(),
                    phone: $("input[name='phone']").val(),
                    email: $("input[name='email']").val()
                };

                console.log("Sending Data:", formData); // ✅ Debugging ke liye

                $.ajax({
                    url: "http://localhost/phpapi/website/edit.php",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify(formData),
                    success: function(response) {
                        console.log("Response:", response); // ✅ API ka response check karo
                        if (response.message) {
                            alert(response.message);
                            window.location.href = "show.php";
                        } else {
                            alert(response.error);
                        }
                    },
                    error: function(xhr) {
                        console.log("Error Response:", xhr.responseText); // ✅ Debugging ke liye
                        $("#response").html("<b style='color:red;'>Update Failed!</b>");
                    }
                });
            });
        });



        
    </script>


</body>

</html>