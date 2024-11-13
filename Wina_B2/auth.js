// Function to fetch and parse user data
async function fetchUsers() {
  const response = await fetch('authenticate.txt');
  const data = await response.text();
  return parseUserData(data);
}

// Function to parse the user data
function parseUserData(data) {
  const users = [];
  const entries = data.trim().split('\n\n');
  
  for (const entry of entries) {
      const lines = entry.split('\n');
      const user = {};
      for (const line of lines) {
          const [key, value] = line.split(': ').map(item => item.trim());
          user[key] = value;
      }
      users.push(user);
  }
  return users;
}

// Function to add a new user
async function addUser(user) {
  const data = Object.entries(user)
      .map(([key, value]) => `${key}: ${value}`)
      .join('\n') + '\n\n';

  try {
      const response = await fetch('save_user.php', {
          method: 'POST',
          headers: { 'Content-Type': 'text/plain' },
          body: data
      });
      return response.ok;
  } catch (error) {
      console.error('Error adding user:', error);
      return false;
  }
}

// Authentication related functions
async function checkAuth() {
  try {
      const response = await fetch('php/check_auth.php');
      const data = await response.json();
      
      if (!data.authenticated) {
          window.location.href = 'login-user.html';
      } else {
          return data.user;
      }
  } catch (error) {
      console.error('Auth check failed:', error);
      window.location.href = 'login-user.html';
  }
}

function logout() {
  window.location.href = 'php/logout.php';
}
// Example usage:
// Fetch users
fetchUsers().then(users => {
  console.log('Users:', users);
});

// Add a new user
const newUser = {
  UserID: 'WU0000004',
  Username: 'new_user',
  Password: '$2y$10$hashedpasswordhere',
  Role: 'user',
  Status: 'active'
};
addUser(newUser);