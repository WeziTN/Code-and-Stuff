<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Reports - Wina Bwangu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 90%;
            margin: auto;
            margin-top: 40px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Transaction Reports</h1>
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Mobile Booth</th>
                    <th>Location</th>
                    <th>Service</th>
                    <th>Revenue Per Kwacha</th>
                    <th>Transaction Amount</th>
                </tr>
            </thead>
            <tbody id="report-table-body">
                <?php
                // Database connection details
                $servername = "localhost";  // Replace with your server name
                $username = "root";     // Replace with your database username
                $password = "";        // Replace with your database password
                $dbname = "wina_bwangu_db";  // Replace with your database name

                // Establish a database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to retrieve transaction data
                $sql = "SELECT TransactionID, MobileBooth, Location, Service, RevenuePerKwacha, TransactionAmount FROM transactions";
                $result = $conn->query($sql);

                // Check if there are results
                if ($result->num_rows > 0) {
                    // Fetch data and display it in the table
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['TransactionID']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['MobileBooth']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Location']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Service']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['RevenuePerKwacha']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['TransactionAmount']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">No transactions found.</td></tr>';
                }

                // Close the connection
                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="button-container">
            <button onclick="window.location.href='portal-admin.html'">Back to Admin Portal</button>
            <button onclick="window.location.href='dashboard.html'">Go to Dashboard</button>
        </div>
    </div>

    <footer>
        &copy; 2024 Wina Bwangu. All rights reserved.
    </footer>
</body>
</html>
