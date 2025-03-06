<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduGaon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
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

        .container {
            text-align: center;
            margin-top: 150px;
        }

        h1 {
            font-size: 50px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="show.php"><button>Show All</button></a>
        <a href="add-data.php"><button>Add New Data</button></a>
    </div>

    <div class="container">
        <h1>Welcome! EduGaon</h1>
    </div>

</body>

</html>