<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting for debugging

include '../config.php'; // Ensure this path is correct

function generateTransactionID($pdo) {
    $sql = "SELECT COUNT(*) AS count FROM transactions";
    $result = $pdo->query($sql);
    $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
    return 'WB' . str_pad($count + 1, 7, '0', STR_PAD_LEFT);
}

function calculateAfterTax($amount, $taxRate) {
    return $amount - ($amount * $taxRate);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booth_name = $_POST['booth_name'];
    $service_name = $_POST['service_name'];
    $transaction_amount = $_POST['transaction_amount'];

    // Example: Fetch the tax rate based on the service name (modify this as needed)
    $taxRate = 0.05; // Default tax rate, you can adjust this as necessary

    // Calculate after-tax amount
    $afterTaxAmount = calculateAfterTax($transaction_amount, $taxRate);

    // Generate Transaction ID
    $transactionID = generateTransactionID($pdo);

    // Prepare SQL statement to insert the transaction
    $sql = "INSERT INTO transactions (transaction_id, booth_name, service_name, transaction_amount, TaxRate, AfterTaxAmount) 
            VALUES (:transactionID, :booth_name, :service_name, :amount, :taxRate, :afterTaxAmount)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':transactionID' => $transactionID,
        ':booth_name' => $booth_name,
        ':service_name' => $service_name,
        ':amount' => $transaction_amount,
        ':taxRate' => $taxRate,
        ':afterTaxAmount' => $afterTaxAmount
    ]);

    // Redirect or show a success message
    echo "Transaction processed successfully!";
    header("Location: ../views/customer_view.php?success=1"); // Redirect back to the form page
    exit();
}
?>
