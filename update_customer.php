<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $doctor_name = $_POST['doctor_name'];
    $doctor_address = $_POST['doctor_address'];

    $query = "UPDATE customers SET NAME = '$name', ADDRESS = '$address', CONTACT_NUMBER = '$contact_number', DOCTOR_NAME = '$doctor_name', DOCTOR_ADDRESS = '$doctor_address' WHERE ID = $customer_id";
    if (mysqli_query($con, $query)) {
        echo "Customer updated successfully.";
    } else {
        echo "Error updating customer: " . mysqli_error($con);
    }
}
?>
