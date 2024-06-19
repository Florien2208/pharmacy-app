<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice_id = $_POST['invoice_id'];
    $invoice_number = $_POST['invoice_number'];
    $name = $_POST['name'];
    $medicine_name = $_POST['medicine_name'];
    $invoice_date = $_POST['invoice_date'];
    $total_amount = $_POST['total_amount'];
    $total_discount = $_POST['total_discount'];
    $net_total = $_POST['net_total'];
    $payment_status = $_POST['payment_status'];
    $customer_address = $_POST['customer_address'];
    $contact_number = $_POST['contact_number'];
    $doctor_name = $_POST['doctor_name'];
    $doctor_address = $_POST['doctor_address'];
    $tex = $_POST['tex'];
    $tex1 = $_POST['tex1'];
    $tex2 = $_POST['tex2'];
    $tex3 = $_POST['tex3'];
    $tex4 = $_POST['tex4'];
    $tex5 = $_POST['tex5'];

    $query = "UPDATE invoices SET INVOICE_NUMBER = '$invoice_number', NAME = '$name', MEDICINE_NAME = '$medicine_name', INVOICE_DATE = '$invoice_date', TOTAL_AMOUNT = '$total_amount', TOTAL_DISCOUNT = '$total_discount', NET_TOTAL = '$net_total', PAYMENT_STATUS = '$payment_status', ADDRESS = '$customer_address', CONTACT_NUMBER = '$contact_number', DOCTOR_NAME = '$doctor_name', DOCTOR_ADDRESS = '$doctor_address', TEX = '$tex', TEX1 = '$tex1', TEX2 = '$tex2', TEX3 = '$tex3', TEX4 = '$tex4', TEX5 = '$tex5' WHERE ID = $customer_id";
    if (mysqli_query($con, $query)) {
        echo "Invoice updated successfully.";
    } else {
        echo "Error updating invoice: " . mysqli_error($con);
    }
}
?>
