<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Transaction View</title>
    <style>
        /* Style the form to be vertical */
        form {
            display: flex;
            flex-direction: column;
            max-width: 300px;
            margin: auto;
        }
        label {
            margin-top: 10px;
        }
        input[readonly] {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 5px;
        }
    </style>
    <script>
        const boothData = {
            "Wina1": {
                location: "Lusaka CPD",
                services: ["Airtel Money", "MTN Money", "Zamtel Money", "Zanaco", "FNB"]
            },
            "Wina2": {
                location: "Libala",
                services: ["Airtel Money", "MTN Money", "Zamtel Money", "FNB"]
            },
            "Wina3": {
                location: "Kabwata",
                services: ["Airtel Money", "MTN Money", "Zamtel Money", "Zanaco", "FNB"]
            },
            "Wina4": {
                location: "Mandevu",
                services: ["Airtel Money", "MTN Money", "Zamtel Money"]
            },
            "Wina5": {
                location: "Woodlands",
                services: ["Airtel Money", "MTN Money", "Zanaco", "FNB"]
            },
            "Wina6": {
                location: "Matero East",
                services: ["Airtel Money", "MTN Money", "Zamtel Money"]
            }
        };

        const serviceData = {
            "Airtel Money": { revenue: 0.05 },
            "MTN Money": { revenue: 0.06 },
            "Zamtel Money": { revenue: 0.045 },
            "Zanaco": { revenue: 0.035 },
            "FNB": { revenue: 0.04 }
        };

        function updateBoothDetails() {
            const boothSelect = document.getElementById("boothSelect");
            const selectedBooth = boothSelect.value;
            
            if (selectedBooth && boothData[selectedBooth]) {
                document.getElementById("location").value = boothData[selectedBooth].location;

                const serviceSelect = document.getElementById("serviceSelect");
                serviceSelect.innerHTML = '<option value="">Select Service</option>';
                
                boothData[selectedBooth].services.forEach(service => {
                    const option = document.createElement("option");
                    option.value = service;
                    option.text = service;
                    serviceSelect.add(option);
                });
                
                document.getElementById("revenueInfo").value = "";
            } else {
                document.getElementById("location").value = "";
                document.getElementById("serviceSelect").innerHTML = '<option value="">Select Service</option>';
                document.getElementById("revenueInfo").value = "";
            }
        }

        function updateRevenueInfo() {
            const serviceSelect = document.getElementById("serviceSelect");
            const selectedService = serviceSelect.value;

            if (selectedService && serviceData[selectedService]) {
                const revenue = serviceData[selectedService].revenue;
                document.getElementById("revenueInfo").value = `Revenue per Kwacha: ${revenue}`;
            } else {
                document.getElementById("revenueInfo").value = "";
            }
        }
    </script>
</head>
<body>
    <h1>Customer Transaction View</h1>

    <!-- Booth Selection Dropdown -->
    <form method="POST" action="../controllers/process_transaction.php">
        <label for="boothSelect">Select Booth:</label>
        <select id="boothSelect" name="booth_name" onchange="updateBoothDetails()">
            <option value="">Select Booth</option>
            <option value="Wina1">Wina1</option>
            <option value="Wina2">Wina2</option>
            <option value="Wina3">Wina3</option>
            <option value="Wina4">Wina4</option>
            <option value="Wina5">Wina5</option>
            <option value="Wina6">Wina6</option>
        </select>

        <!-- Display Location in a readonly textbox -->
        <label for="location">Location:</label>
        <input type="text" id="location" readonly placeholder="Select a booth to see the location">

        <!-- Services Dropdown -->
        <label for="serviceSelect">Select Service:</label>
        <select id="serviceSelect" name="service_name" onchange="updateRevenueInfo()">
            <option value="">Select Service</option>
        </select>

        <!-- Display Revenue Info in a readonly textbox -->
        <label for="revenueInfo">Revenue Info:</label>
        <input type="text" id="revenueInfo" readonly placeholder="Select a service to see revenue details">

        <!-- Transaction Amount Input -->
        <label for="transactionAmount">Transaction Amount:</label>
        <input type="number" id="transactionAmount" name="transaction_amount" min="1" required>

        <button type="submit">Submit Transaction</button>
    </form>
</body>
</html>
