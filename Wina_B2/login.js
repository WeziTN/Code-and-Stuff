async function handleLogin(event) {
  event.preventDefault();
  
  const form = event.target;
  const formData = new FormData(form);
  
  try {
      const response = await fetch('php/authenticate.php', {
          method: 'POST',
          body: formData
      });

      const result = await response.json();
      
      if (result.success) {
          window.location.href = 'portal-user.html';
      } else {
          document.getElementById('error-message').textContent = 
              result.error || 'Login failed';
      }
  } catch (error) {
      console.error('Login error:', error);
      document.getElementById('error-message').textContent = 
          'An error occurred during login';
  }
  
  return false;
}