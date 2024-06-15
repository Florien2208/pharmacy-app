<?php

  if(isset($_GET["action"]) && $_GET["action"] == "delete") {
    require "db_connection.php";
    $invoice_number = $_GET["invoice_number"];
    $query = "DELETE FROM invoices WHERE INVOICE_ID = $invoice_number";
    $result = mysqli_query($con, $query);
    if(!empty($result))
  		showInvoices();
  }
  
if(isset($_GET["action"]) && $_GET["action"] == "edit") {

      $invoice_number = $_GET["invoice_number"];
      
      showEditInvoices($invoice_number);
    }
if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $invoice_number = $_GET["invoice_number"];
      $invoice_date = $_GET["invoice_date"];
      $total_amount = $_GET["total_amount"];
      $total_discount = $_GET["total_discount"];
      $net_total = $_GET["net_total"];
      updateInvoice($invoice_number, $invoice_date, $total_amount, $total_discount, $net_total);
    }
if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showInvoices();
function showEditInvoices($invoice_number) {
    require "db_connection.php";
    if ($con) {
        $seq_no = 0;
        $query = "SELECT invoices.*, customers.NAME 
                  FROM invoices 
                  INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $seq_no++;
                if ($row['INVOICE_ID'] == $invoice_number) {
                    showEditOptionsRow($seq_no, $row);
                } else {
                    showInvoiceRow($seq_no, $row);
                }
            }
        } else {
            echo "No invoices found.";
        }
    }
}

function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['INVOICE_ID']; ?></td>
    <td><?php echo $row['NAME']; ?></td>
    <td>
      <input type="date" class="form-control" value="<?php echo $row['INVOICE_DATE']; ?>" placeholder="Invoice Date" id="invoice_date">
      <code class="text-danger small font-weight-bold float-right" id="invoice_date_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="Total Amount" id="total_amount"><?php echo $row['TOTAL_AMOUNT']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="total_amount_error" style="display: none;"></code>
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['TOTAL_DISCOUNT']; ?>" placeholder="Total Discount" id="total_discount">
      <code class="text-danger small font-weight-bold float-right" id="total_discount_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="Net Total" id="net_total"><?php echo $row['NET_TOTAL']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="net_total_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateInvoice(<?php echo $row['INVOICE_ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="(function() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      document.getElementById('invoices_div').innerHTML = xhttp.responseText;
    }
  };
  xhttp.open('GET', 'php/manage_invoice.php?action=cancel', true);
  xhttp.send();
  return false; // Prevent the default link behavior
})(); return false;">
  <i class="fa fa-close"></i>
</button>
    </td>
  </tr>
  <?php
}


function updateInvoice($id, $invoice_date, $total_amount, $total_discount, $net_total) {
  require "db_connection.php";
  $query = "UPDATE invoices SET INVOICE_DATE = '$invoice_date', NET_TOTAL = '$net_total', TOTAL_AMOUNT = '$total_amount', TOTAL_DISCOUNT = '$total_discount' WHERE INVOICE_ID = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showInvoices();
}








  if(isset($_GET["action"]) && $_GET["action"] == "refresh")
    showInvoices();

  if(isset($_GET["action"]) && $_GET["action"] == "search")
    searchInvoice(strtoupper($_GET["text"]), $_GET["tag"]);

  if(isset($_GET["action"]) && $_GET["action"] == "print_invoice")
    printInvoice($_GET["invoice_number"]);

  function showInvoices() {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }

  function showInvoiceRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['INVOICE_ID']; ?></td>
      <td><?php echo $row['NAME']; ?></td>
      <td><?php echo $row['INVOICE_DATE']; ?></td>
      <td><?php echo $row['TOTAL_AMOUNT']; ?></td>
      <td><?php echo $row['TOTAL_DISCOUNT']; ?></td>
      <td><?php echo $row['NET_TOTAL']; ?></td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="printInvoice(<?php echo $row['INVOICE_ID']; ?>);">
          <i class="fa fa-fax"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteInvoice(<?php echo $row['INVOICE_ID']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
     <button class="btn btn-info btn-sm" onclick="editInvoice(<?php echo $row['INVOICE_ID']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
      </td>
    </tr>
    <?php
  }

  function searchInvoice($text, $column) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      if($column == 'INVOICE_ID')
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE CAST(invoices.$column AS VARCHAR(9)) LIKE '%$text%'";
      else if($column == "INVOICE_DATE")
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE invoices.$column = '$text'";
      else
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE UPPER(customers.$column) LIKE '%$text%'";

      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }

  function printInvoice($invoice_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM sales INNER JOIN customers ON sales.CUSTOMER_ID = customers.ID WHERE INVOICE_NUMBER = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $customer_name = $row['NAME'];
      $address = $row['ADDRESS'];
      $contact_number = $row['CONTACT_NUMBER'];
      $doctor_name = $row['DOCTOR_NAME'];
      $doctor_address = $row['DOCTOR_ADDRESS'];

      $query = "SELECT * FROM invoices WHERE INVOICE_ID = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $invoice_date = $row['INVOICE_DATE'];
      $total_amount = $row['TOTAL_AMOUNT'];
      $total_discount = $row['TOTAL_DISCOUNT'];
      $net_total = $row['NET_TOTAL'];
      $tex = $row['TEX'];
      $tex1 = $row['TEX1'];
      $tex2 = $row['TEX2'];
    }

    ?>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 h3" style="color: #ff5252;">Customer Invoice<span class="float-right">Invoice Number : <?php echo $invoice_number; ?></span></div>
    </div>
    <div class="row font-weight-bold">
      <div class="col-md-1"></div>
      <div class="col-md-10"><span class="h4 float-right">Invoice Date. : <?php echo $invoice_date; ?></span></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4">
        <span class="h4">Customer Details : </span><br><br>
        <span class="font-weight-bold">Name : </span><?php echo $customer_name; ?><br>
        <span class="font-weight-bold">Address : </span><?php echo $address; ?><br>
        <span class="font-weight-bold">Contact Number : </span><?php echo $contact_number; ?><br>
        <span class="font-weight-bold">Doctor's Name : </span><?php echo $doctor_name; ?><br>
        <span class="font-weight-bold">Doctor's Address : </span><?php echo $doctor_address; ?><br>
              <span class="font-weight-bold">TEX : </span><?php echo $tex; ?><br>
        <span class="font-weight-bold">TEX1 : </span><?php echo $tex1; ?><br>
        <span class="font-weight-bold">TEX2 : </span><?php echo $tex2; ?><br>
        
      </div>
      
      <div class="col-md-3"></div>

      <?php

      $query = "SELECT * FROM admin_credentials";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $p_name = $row['PHARMACY_NAME'];
      $p_address = $row['ADDRESS'];
      $p_email = $row['EMAIL'];
      $p_contact_number = $row['CONTACT_NUMBER'];
      ?>

      <div class="col-md-4">
        <span class="h4">Shop Details : </span><br><br>
        <span class="font-weight-bold"><?php echo $p_name; ?></span><br>
        <span class="font-weight-bold"><?php echo $p_address; ?></span><br>
        <span class="font-weight-bold"><?php echo $p_email; ?></span><br>
        <span class="font-weight-bold">Mob. No.: <?php echo $p_contact_number; ?></span>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="purchase_report_div">
          <thead>
            <tr>
              <th>SL</th>
              <th>Medicine Name</th>
              <th>Expiry Date</th>
              <th>Quantity</th>
              <th>MRP</th>
              <th>Discount</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $seq_no = 0;
              $total = 0;
              $query = "SELECT * FROM sales WHERE INVOICE_NUMBER = $invoice_number";
              $result = mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                $seq_no++;
                ?>
                <tr>
                  <td><?php echo $seq_no; ?></td>
                  <td><?php echo $row['MEDICINE_NAME']; ?></td>
                  <td><?php echo $row['EXPIRY_DATE']; ?></td>
                  <td><?php echo $row['QUANTITY']; ?></td>
                  <td><?php echo $row['MRP']; ?></td>
                  <td><?php echo $row['DISCOUNT']."%"; ?></td>
                  <td><?php echo $row['TOTAL']; ?></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
          <tfoot class="font-weight-bold">
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="6">&nbsp;Total Amount</td>
              <td><?php echo $total_amount; ?></td>
            </tr>
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="6">&nbsp;Total Discount</td>
              <td><?php echo $total_discount; ?></td>
            </tr>
            <tr style="text-align: right; font-size: 22px;">
              <td colspan="6" style="color: green;">&nbsp;Net Amount</td>
              <td class="text-primary"><?php echo $net_total; ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <?php
  }

?>
