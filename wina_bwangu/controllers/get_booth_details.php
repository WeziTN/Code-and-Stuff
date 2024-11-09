<?php
include '../db_connection.php';

if (isset($_GET['booth_name'])) {
    $boothName = $_GET['booth_name'];

    // Fetch booth location
    $locationQuery = $conn->prepare("SELECT location FROM booths WHERE booth_name = :booth");
    $locationQuery->execute(['booth' => $boothName]);
    $location = $locationQuery->fetchColumn();

    // Fetch services for the booth
    $servicesQuery = $conn->prepare("SELECT s.service_name FROM services s JOIN booth_services bs ON s.service_name = bs.service_name WHERE bs.booth_name = :booth");
    $servicesQuery->execute(['booth' => $boothName]);
    $services = $servicesQuery->fetchAll(PDO::FETCH_ASSOC);

    // Output JSON response
    echo json_encode(['location' => $location, 'services' => $services]);
} else {
    echo json_encode(['error' => 'Booth name not specified']);
}
?>
