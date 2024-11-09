// JavaScript for validating the registration form and displaying feedback

function validateForm() {
    const username = document.getElementById("username").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    
    if (!username || !email || !password) {
        showToast("Please fill in all fields.");
        return false;
    }
    showToast("Registration successful!");
    return true;
}

// Function to create and display a toast notification
function showToast(message) {
    const toast = document.createElement("div");
    toast.className = "toast";
    toast.innerText = message;
    document.body.appendChild(toast);

    // Dismiss the toast after 3 seconds
    setTimeout(() => toast.remove(), 3000);
}

// Styles for Toast (add this style to your CSS file)
const style = document.createElement('style');
style.innerHTML = `
    .toast {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        opacity: 0.9;
    }
`;
document.head.appendChild(style);
