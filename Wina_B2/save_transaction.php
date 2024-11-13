<?php
header('Content-Type: application/json');

try {
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Get the transaction data and log it
    $rawInput = file_get_contents('php://input');
    error_log("Raw input received: " . $rawInput);
    
    $transaction = json_decode($rawInput, true);
    
    if (!$transaction) {
        throw new Exception('Invalid transaction data: ' . json_last_error_msg());
    }

    // Define the file path and log it
    $filePath = __DIR__ . '/booth_transactions.txt';
    error_log("Attempting to write to: " . $filePath);

    // Format the transaction data
    $transactionText = "TransactionID: " . $transaction['TransactionID'] . "\n" .
                      "Booth: " . $transaction['Booth'] . "\n" .
                      "Location: " . $transaction['Location'] . "\n" .
                      "Service: " . $transaction['Service'] . "\n" .
                      "RevenuePerKwacha: " . $transaction['RevenuePerKwacha'] . "\n" .
                      "TransactionAmount: " . $transaction['TransactionAmount'] . "\n" .
                      "AmountAfterTax: " . $transaction['AmountAfterTax'] . "\n" .
                      "DateTime: " . $transaction['DateTime'] . "\n" .
                      "----------------------------------------\n\n";

    // Log the permissions
    error_log("File exists: " . (file_exists($filePath) ? 'Yes' : 'No'));
    error_log("File is writable: " . (is_writable($filePath) ? 'Yes' : 'No'));
    error_log("Directory is writable: " . (is_writable(dirname($filePath)) ? 'Yes' : 'No'));

    // Append the transaction to the file
    $result = file_put_contents($filePath, $transactionText, FILE_APPEND | LOCK_EX);
    
    if ($result === false) {
        throw new Exception('Failed to write to file: ' . error_get_last()['message']);
    }

    error_log("Successfully wrote " . $result . " bytes to file");
    echo json_encode(['success' => true, 'message' => 'Transaction saved successfully']);
} catch (Exception $e) {
    error_log("Error in save_transaction.php: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>