<?php
require "db_connection.php";

if(isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $query = "SELECT * FROM customers WHERE ID = $customer_id";
    $result = mysqli_query($con, $query);
    $customer = mysqli_fetch_assoc($result);

function editCustomer(customerId) {
    window.location.href = 'edit_customer.php?id=' + customerId;
}


    // Assuming you have a form to update customer details
    ?>
    <form method="POST" action="update_customer.php">
        <input type="hidden" name="customer_id" value="<?php echo $customer['ID']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $customer['NAME']; ?>"><br>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $customer['ADDRESS']; ?>"><br>
        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" value="<?php echo $customer['CONTACT_NUMBER']; ?>"><br>
        <label for="doctor_name">Doctor's Name:</label>
        <input type="text" name="doctor_name" value="<?php echo $customer['DOCTOR_NAME']; ?>"><br>
        <label for="doctor_address">Doctor's Address:</label>
        <input type="text" name="doctor_address" value="<?php echo $customer['DOCTOR_ADDRESS']; ?>"><br>
        <button type="submit">Update Customer</button>
    </form>
    <?php
}
?>
