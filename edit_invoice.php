<?php
require "db_connection.php";

if(isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $query = "SELECT * FROM customers WHERE ID = $customer_id";
    $result = mysqli_query($con, $query);
    $customer = mysqli_fetch_assoc($result);

function editInvoice(customerId) {
    window.location.href = 'edit_invoice.php?id=' + customerId;
}


    // Assuming you have a form to update invoice details
    ?>
    <form method="POST" action="update_invoice.php">
        <input type="hidden" name="invoice_id" value="<?php echo $invoice['ID']; ?>">
        <label for="invoice_number">INVOICE NUMBER:</label>
        <input type="text" name="invoice_number" value="<?php echo $invoice['INVOICE_NUMBER']; ?>"><br>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $invoice['NAME']; ?>"><br>
        <label for="medicine_name">MEDICINE NAME:</label>
        <input type="text" name="medicine_name" value="<?php echo $invoice['MEDICINE_NAME']; ?>"><br>
        <label for="invoice_date">INVOICE DATE:</label>
        <input type="text" name="invoice_date" value="<?php echo $invoice['INVOICE_DATE']; ?>"><br>
        <label for="total_amount">TOTAL AMOUNT:</label>
        <input type="text" name="total_amount" value="<?php echo $invoice['TOTAL_AMOUNT']; ?>"><br>
        <label for="total_discount">TOTAL DISCOUNT:</label>
        <input type="text" name="total_discount" value="<?php echo $invoice['TOTAL_DISCOUNT']; ?>"><br>
        <label for="net_total">NET TOTAL:</label>
        <input type="text" name="net_total" value="<?php echo $invoice['NET_TOTAL']; ?>"><br>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $invoice['ADDRESS']; ?>"><br>
        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" value="<?php echo $invoice['CONTACT_NUMBER']; ?>"><br>
        <label for="doctor_name">Doctor's Name:</label>
        <input type="text" name="doctor_name" value="<?php echo $invoice['DOCTOR_NAME']; ?>"><br>
        <label for="doctor_address">Doctor's Address:</label>
        <input type="text" name="doctor_address" value="<?php echo $invoice['DOCTOR_ADDRESS']; ?>"><br>
        <label for="tex">TEX:</label>
        <input type="text" name="tex" value="<?php echo $invoice['TEX']; ?>"><br>
        <label for="tex1">TEX1:</label>
        <input type="text" name="tex1" value="<?php echo $invoice['TEX1']; ?>"><br>
        <label for="tex2">TEX2:</label>
        <input type="text" name="tex2" value="<?php echo $invoice['TEX2']; ?>"><br>
        <label for="tex3">TEX3:</label>
        <input type="text" name="tex3" value="<?php echo $invoice['TEX3']; ?>"><br>
        <label for="tex4">TEX4:</label>
        <input type="text" name="tex4" value="<?php echo $invoice['TEX4']; ?>"><br>
        <label for="tex5">TEX5:</label>
        <input type="text" name="tex5" value="<?php echo $invoice['TEX5']; ?>"><br>
        

        <button type="submit">Update invoice</button>
    </form>
    <?php
}
?>
