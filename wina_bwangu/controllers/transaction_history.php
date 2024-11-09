<?php
include '../config.php'; // Update to your actual config file

// Fetch all transactions
$sql = "SELECT transaction_id, booth_name, service_name, transaction_amount, AfterTaxAmount, TaxRate FROM transactions";
$stmt = $pdo ->prepare($sql);
$stmt->execute();
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate TaxPerformance for each transaction
foreach ($transactions as &$transaction) {
    $transaction['TaxPerformance'] = ($transaction['transaction_amount'] - $transaction['AfterTaxAmount']) / $transaction['transaction_amount'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .performance-bar {
            width: 100px;
            background-color: lightgray;
        }
        .bar-fill {
            height: 100%;
            background-color: green;
            text-align: center;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Transaction History</h1>
    <table>
        <tr>
            <th>Transaction ID</th>
            <th>Booth</th>
            <th>Service</th>
            <th>Transaction Amount</th>
            <th>After Tax</th>
            <th>Tax Performance</th>
        </tr>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= htmlspecialchars($transaction['transaction_id']); ?></td>
                <td><?= htmlspecialchars($transaction['booth_name']); ?></td>
                <td><?= htmlspecialchars($transaction['service_name']); ?></td>
                <td><?= htmlspecialchars(number_format($transaction['transaction_amount'], 2)); ?></td>
                <td><?= htmlspecialchars(number_format($transaction['AfterTaxAmount'], 2)); ?></td>
                <td>
                    <div class="performance-bar">
                        <div class="bar-fill" style="width: <?= $transaction['TaxPerformance'] * 100; ?>%;">
                            <?= round($transaction['TaxPerformance'] * 100); ?>%
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
