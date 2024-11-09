
import React from 'react';
import TransactionForm from './try'; // Ensure the path is correct

const HomePage = () => {
  return (
    <div>
      <div className="back-btn-container">
        <a href="homepage.html" className="back-btn">Back to Homepage</a>
        <a href="profile-selection.html" className="back-btn">Back to Profile Selection</a>
      </div>

      <div id="login">
        <h2>Wina Bwangu Web App Prototype</h2>
        <TransactionForm /> {/* Add the TransactionForm here */}
      </div>

      <footer>
        <p>&copy; 2024 Wina Bwangu. All Rights Reserved.</p>
      </footer>
    </div>
  );
};

export default HomePage;
