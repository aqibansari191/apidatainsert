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

    /* Form Styling */
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
    <img src="" alt="">
    <a href="show.php"><button>Show All</button></a>
    <button disabled>Add New Data</button>
  </div>

  <div class="form-container">
    <h3>Add New Data</h3>
    <form id="studentForm">
      <input type="text" id="first_name" placeholder="First Name" required>
      <input type="text" id="last_name" placeholder="Last Name" required>
      <input type="tel" id="phone" placeholder="Phone" required>
      <input type="email" id="email" placeholder="Email" required>
      <button type="submit">Submit</button>
    </form>
    <p id="response"></p>
  </div>

  <script>
    $(document).ready(function() {
      $("#studentForm").submit(function(event) {
        event.preventDefault();

        var formData = {
          first_name: $("#first_name").val(),
          last_name: $("#last_name").val(),
          phone: $("#phone").val(),
          email: $("#email").val()
        };

        $.ajax({
          url: "http://localhost/phpapi/website/insert.php",
          type: "POST",
          contentType: "application/json",
          data: JSON.stringify(formData),
          success: function(response) {
            if (response.status) {
              window.location.href = "show.php";
            } else {
              $("#response").html("<span style='color:red;'>Failed: " + response.message + "</span>");
            }
          },
          error: function(xhr, status, error) {
            console.log("AJAX Error: " + error);
            $("#response").html("<span style='color:red;'>AJAX Error! Check Console</span>");
          }
        });
      });
    });
  </script>

</body>

</html>