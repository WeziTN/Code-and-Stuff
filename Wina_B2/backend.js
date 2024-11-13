const express = require('express');
const fs = require('fs');
const app = express();
const port = 3000;

// Middleware to parse JSON bodies
app.use(express.json());

// Endpoint to fetch all transactions from the file
app.get('/transactions', (req, res) => {
    fs.readFile('booth_transactions.txt', 'utf8', (err, data) => {
        if (err) {
            return res.status(500).send('Error reading transactions file');
        }
        res.send(data);
    });
});

// Endpoint to add a new transaction to the file
app.post('/transactions', (req, res) => {
    const transaction = req.body;

    // Format transaction as text
    const transactionText = `
TransactionID: ${transaction.TransactionID}
Booth: ${transaction.Booth}
Location: ${transaction.Location}
Service: ${transaction.Service}
RevenuePerKwacha: ${transaction.RevenuePerKwacha}
TransactionAmount: ${transaction.TransactionAmount}
AmountAfterTax: ${transaction.AmountAfterTax}
`;

    // Append transaction to file
    fs.appendFile('booth_transactions.txt', transactionText, (err) => {
        if (err) {
            return res.status(500).send('Error writing transaction to file');
        }
        res.send({ message: 'Transaction added successfully!' });
    });
});

// Start server
app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
