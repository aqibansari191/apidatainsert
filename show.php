<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e3f2fd;
            margin: 0;
            padding: 0;
        }

        .header {
            background: rgb(76, 120, 175);
            color: white;
            padding: 15px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header button {
            background: white;
            color: #1976D2;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            margin: 0 10px;
        }

        .header button:hover {
            background: #ddd;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: rgb(76, 120, 175);
            color: white;
        }

        .delete-btn {
            background: red;
            color: white;
            padding: 7px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background: darkred;
        }

        .update-btn {
            background-color: rgb(76, 120, 175);
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .update-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: rgb(187, 50, 64);
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .delete-btn:hover {
            background-color: #a71d2a;
        }
    </style>
</head>

<body>

    <div class="header">
        <a href="index.php"><button>Back</button></a>
        <h2>All Data</h2>
        <a href="add-data.php"><button>Add New Data</button></a>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="data-table">
            </tbody>
        </table>
    </div>

    <script>
        async function fetchData() {
            try {
                const response = await fetch("http://localhost/phpapi/website/view.php");
                const data = await response.json();

                const tableBody = document.getElementById("data-table");
                tableBody.innerHTML = "";

                data.forEach(student => {
                    const row = `<tr>
        <td>${student.id}</td>
        <td>${student.first_name}</td>
        <td>${student.last_name}</td>
        <td>${student.phone}</td>
        <td>${student.email}</td>
        <td>
            <a href="update.php?id=${student.id}">
                <button class="update-btn">Update</button>
            </a>  
        </td>
        <td> <button class="delete-btn" data-id="${student.id}">Delete</button></td>
    </tr>`;
                    tableBody.innerHTML += row;
                });


            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }
        window.onload = fetchData;

        document.addEventListener("click", async function(event) {
            if (event.target.classList.contains("delete-btn")) {
                let id = event.target.getAttribute("data-id");

                if (confirm("Are you sure you want to delete this record?")) {
                    try {
                        let response = await fetch("http://localhost/phpapi/website/delete.php", {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        });
                        let result = await response.json();
                        // alert(result.message);
                        location.reload();
                    } catch (error) {
                        console.error("Delete failed!", error);
                    }
                }
            }
        });
    </script>

</body>

</html>