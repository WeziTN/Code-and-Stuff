// JavaScript to fetch, display, and update transactions

// Function to fetch and display data from the text file
async function fetchData() {
    const response = await fetch('booth_transactions.txt');
    const data = await response.text();
    const transactions = parseData(data);
    displayData(transactions);
}

// Function to parse the data from the text file
function parseData(data) {
    const transactions = [];
    const entries = data.trim().split('\n\n');
    
    for (const entry of entries) {
        const lines = entry.split('\n');
        const transaction = {};
        for (const line of lines) {
            const [key, value] = line.split(': ').map(item => item.trim());
            transaction[key] = value;
        }
        transactions.push(transaction);
    }
    return transactions;
}

// Function to display data in the console (or on a web page if you prefer)
function displayData(transactions) {
    console.log("Booth Transactions:");
    transactions.forEach((transaction, index) => {
        console.log(`Transaction ${index + 1}:`, transaction);
    });
}

// Function to add a new transaction to the file
async function addTransaction(transaction) {
    const data = Object.entries(transaction)
        .map(([key, value]) => `${key}: ${value}`)
        .join('\n') + '\n\n';

    // Sending data to the server for saving (requires server-side handling)
    await fetch('save_transaction.php', {
        method: 'POST',
        headers: { 'Content-Type': 'text/plain' },
        body: data
    });
}

// Example usage
fetchData();

// To add a new transaction:
const newTransaction = {
    TransactionID: 'WB0000005',
    Booth: 'Wina4',
    Location: 'Matero',
    Service: 'Zamtel Money',
    RevenuePerKwacha: '0.04',
    TransactionAmount: '500'
};
addTransaction(newTransaction);
