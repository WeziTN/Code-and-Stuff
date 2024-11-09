// Function to retrieve booth locations based on user GPS coordinates
function fetchBoothLocations(latitude, longitude) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `server_endpoint.php?lat=${latitude}&lng=${longitude}`, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const boothData = JSON.parse(xhr.responseText);
            showToast(`Found ${boothData.length} booths near you.`);
        }
    };
    xhr.send();
}
