// Check authentication on page load
document.addEventListener('DOMContentLoaded', async () => {
  const user = await checkAuth();
  if (user) {
      document.getElementById('user-info').textContent = 
          `Welcome, ${user.username}!`;
  }
});

function viewTransactions() {
  // Implement transaction viewing logic
  console.log('Viewing transactions...');
}

function findBooths() {
  // Implement booth finding logic
  console.log('Finding nearby booths...');
}

function editProfile() {
  // Implement profile editing logic
  console.log('Editing profile...');
}