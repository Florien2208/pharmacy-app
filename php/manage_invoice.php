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
      $tex = $_GET["tex"];
      $tex_1 = $_GET["tex_1"];
      $tex_2 = $_GET["tex_2"];
      $tex_3 = $_GET["tex_3"];
      $tex_4 = $_GET["tex_4"];
      $tex_5 = $_GET["tex_5"];
      $tex_6 = $_GET["tex_6"];
      $tex_7 = $_GET["tex_7"];
      updateInvoice($invoice_number, $invoice_date, $total_amount, $total_discount, $net_total,$tex,$tex_1,$tex_2,$tex_3,$tex_4,$tex_5,
    $tex_6,$tex_7);
    }
if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showInvoices();
function showEditInvoices($invoice_number) {
    require "db_connection.php";
    if ($con) {
        $seq_no = 0;
        $query = "
            SELECT invoices.*, customers.NAME, customers.ADDRESS, customers.CONTACT_NUMBER, customers.DOCTOR_NAME, customers.DOCTOR_ADDRESS,
                   GROUP_CONCAT(sales.BATCH_ID SEPARATOR ', ') AS BATCHS,
                   GROUP_CONCAT(sales.QUANTITY SEPARATOR ', ') AS QUANTITIES,
                   GROUP_CONCAT(sales.MRP SEPARATOR ', ') AS MRPS,
                   GROUP_CONCAT(sales.MEDICINE_NAME SEPARATOR ', ') AS MEDICINES
            FROM invoices
            INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID
            INNER JOIN sales ON invoices.INVOICE_ID = sales.INVOICE_NUMBER
            GROUP BY invoices.INVOICE_ID
        ";
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
      <textarea class="form-control" placeholder="Medicine Names" id="medicines"><?php echo $row['MEDICINES']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="medicines_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="Batch IDs" id="batchs"><?php echo $row['BATCHS']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="batchs_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="Quantities" id="quantities"><?php echo $row['QUANTITIES']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="quantities_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="MRPs" id="mrps"><?php echo $row['MRPS']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="mrps_error" style="display: none;"></code>
    </td>
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
    <td><?php echo $row['PAYMENT_STATUS']; ?></td>
   <td><?php echo $row['ADDRESS']; ?></td>
   <td><?php echo $row['CONTACT_NUMBER']; ?></td>
   <td><?php echo $row['DOCTOR_NAME']; ?></td>
   <td><?php echo $row['DOCTOR_ADDRESS']; ?></td>
    <td>
      <textarea class="form-control" placeholder="tex" id="tex"><?php echo $row['TEX']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="tex_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="tex 1" id="tex_1"><?php echo $row['TEX1']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="tex_1_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="tex 2" id="tex_2"><?php echo $row['TEX2']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="tex_2_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="tex 3" id="tex_3"><?php echo $row['TEX3']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="tex_3_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="tex 4" id="tex_4"><?php echo $row['TEX4']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="tex_4_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="tex 5" id="tex_5"><?php echo $row['TEX5']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="tex_5_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="tex 6" id="tex_6"><?php echo $row['TEX6']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="tex_7_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="tex 7" id="tex_7"><?php echo $row['TEX7']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="tex_7_error" style="display: none;"></code>
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
  return false; 
})(); return false;">
  <i class="fa fa-close"></i>
</button>
    </td>
  </tr>
  <?php
}


function updateInvoice($id, $invoice_date, $total_amount, $total_discount, $net_total,$tex_1,$tex,$tex_2,$tex_3,$tex_4,$tex_5,$tex_6,$tex_7) {
  require "db_connection.php";
 $query = "UPDATE invoices SET 
  INVOICE_DATE = '$invoice_date', 
  NET_TOTAL = '$net_total', 
  TOTAL_AMOUNT = '$total_amount', 
  TOTAL_DISCOUNT = '$total_discount',
  TEX = '$tex',
  TEX1 = '$tex_1',
  TEX2 = '$tex_2',
  TEX3 = '$tex_3',
  TEX4 = '$tex_4',
  TEX5 = '$tex_5',
  TEX6 = '$tex_6',
  TEX7 = '$tex_7'
  WHERE INVOICE_ID = $id";
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
    if ($con) {
        $seq_no = 0;
        $query = "
            SELECT customers.ID AS CUSTOMER_ID, invoices.INVOICE_ID, customers.NAME, invoices.INVOICE_DATE, invoices.TOTAL_AMOUNT, invoices.TOTAL_DISCOUNT, invoices.NET_TOTAL, invoices.PAYMENT_STATUS, 
                   customers.ADDRESS, customers.CONTACT_NUMBER, customers.DOCTOR_NAME, customers.DOCTOR_ADDRESS, invoices.TEX, invoices.TEX1, invoices.TEX2, invoices.TEX3, invoices.TEX4, invoices.TEX5, invoices.TEX6, invoices.TEX7, GROUP_CONCAT(sales.BATCH_ID SEPARATOR ', ') AS BATCHS, GROUP_CONCAT(sales.QUANTITY SEPARATOR ', ') AS QUANTITIES, GROUP_CONCAT(sales.MRP SEPARATOR ', ') AS MRPS, 
                   GROUP_CONCAT(sales.MEDICINE_NAME SEPARATOR ', ') AS MEDICINES
            FROM invoices
            INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID
            INNER JOIN sales ON invoices.INVOICE_ID = sales.INVOICE_NUMBER
            GROUP BY invoices.INVOICE_ID, customers.NAME, invoices.INVOICE_DATE, invoices.TOTAL_AMOUNT, invoices.TOTAL_DISCOUNT, invoices.NET_TOTAL, invoices.PAYMENT_STATUS, customers.ID
        ";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $seq_no++;
            showInvoiceRow($seq_no, $row);
        }
    }
}

function showInvoiceRow($seq_no, $row)
{
    ?>
    <tr>
        <td><?php echo $seq_no; ?></td>
        <td><?php echo $row['INVOICE_ID']; ?></td>
        <td><?php echo $row['NAME']; ?></td>
        <td><?php echo isset($row['MEDICINES']) ? $row['MEDICINES'] : ''; ?></td>
        <td><?php echo isset($row['BATCHS']) ? $row['BATCHS'] : ''; ?></td>
        <td><?php echo isset($row['QUANTITIES']) ? $row['QUANTITIES'] : ''; ?></td>
        <td><?php echo isset($row['MRPS']) ? $row['MRPS'] : ''; ?></td>
        <td><?php echo $row['INVOICE_DATE']; ?></td>
        <td><?php echo $row['TOTAL_AMOUNT']; ?></td>
        <td><?php echo $row['TOTAL_DISCOUNT']; ?></td>
        <td><?php echo $row['NET_TOTAL']; ?></td>
        <td><?php echo $row['PAYMENT_STATUS']; ?></td>
        <td><?php echo $row['ADDRESS']; ?></td>
        <td><?php echo $row['CONTACT_NUMBER']; ?></td>
        <td><?php echo $row['DOCTOR_NAME']; ?></td>
        <td><?php echo $row['DOCTOR_ADDRESS']; ?></td>
        <td><?php echo $row['TEX']; ?></td>
        <td><?php echo $row['TEX1']; ?></td>
        <td><?php echo $row['TEX2']; ?></td>
        <td><?php echo $row['TEX3']; ?></td>
        <td><?php echo $row['TEX4']; ?></td>
        <td><?php echo $row['TEX5']; ?></td>
        <td><?php echo $row['TEX6']; ?></td>
        <td><?php echo $row['TEX7']; ?></td>
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

  function printInvoice($invoice_number)
{
    require "db_connection.php";
    if ($con) {
        $query = "SELECT * FROM sales 
                  INNER JOIN customers ON sales.CUSTOMER_ID = customers.ID 
                  WHERE INVOICE_NUMBER = $invoice_number";
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
        $tex3 = $row['TEX3'];
        $tex4 = $row['TEX4'];
        $tex5 = $row['TEX5'];
        $tex6 = $row['TEX6'];
        $tex7 = $row['TEX7'];
    }

    ?>
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/sidenav.css">
<link rel="stylesheet" href="css/home.css">

<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div class="text-left h3">
                RWANDA SOCIAL SECURITY BOARD (RSSB) <br>
                Tel: +250 598400<br>
                Fax: +250 584445<br>
            </div>
            <div class="text-right">
                <div class="h3">PHARMACIE IWAWE</div>
                <div class="h4">Invoice Date: <?php echo $invoice_date; ?></div>
            </div>
        </div>
    </div>
</div>
    
    <div class="row text-center">
        <hr class="col-md-12" style="border-top: 2px solid #ff5252;">
    </div>
    
    <div class="row">
        <div class="col-md-12" style="font-size: 25px;">
            <div class="d-flex justify-content-between">
                <div>
                    <span class="font-weight-bold">Beneficiary Name: </span><?php echo $customer_name; ?>
                </div>
                <div class="text-right">
                    <span class="font-weight-bold">Invoice Number: </span><?php echo $tex1; ?>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <span class="font-weight-bold">Beneficiary Affiliation Number: </span><?php echo $address; ?>
                </div>
                <div class="text-right">
                    <span class="font-weight-bold">Voucher Identification: </span><?php echo $tex2; ?>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <span class="font-weight-bold">Affiliate's Names: </span><?php echo $contact_number; ?>
                </div>
                <div class="text-right">
                    <span class="font-weight-bold">Health Facility: </span><?php echo $tex3; ?>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <span class="font-weight-bold">Affiliate's Affectation: </span><?php echo $doctor_name; ?>
                </div>
                <div class="text-right">
                    <span class="font-weight-bold">Prescriber's Names: </span><?php echo $tex4; ?>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <span class="font-weight-bold">Beneficiary's Gender M/F: </span><?php echo $doctor_address; ?>
                </div>
                <div class="text-right">
                    <span class="font-weight-bold">Prescriber's Registration Number: </span><?php echo $tex5; ?>
                </div>
            </div>
            <div>
                <span class="font-weight-bold">Beneficiary's Age: </span><?php echo $tex; ?>
            </div>
        </div>
    </div>
    
    <div class="row text-center">
        <hr class="col-md-12" style="border-top: 2px solid #ff5252;">
    </div>
    
    <div class="row">
        <div class="col-md-12 table-responsive" style="font-size: 25px;">
            <table class="table table-bordered table-striped table-hover" id="purchase_report_div" style="font-size: 25px;">
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
                while ($row = mysqli_fetch_array($result)) {
                    $seq_no++;
                ?>
                    <tr>
                        <td><?php echo $seq_no; ?></td>
                        <td><?php echo $row['MEDICINE_NAME']; ?></td>
                        <td><?php echo $row['EXPIRY_DATE']; ?></td>
                        <td><?php echo $row['QUANTITY']; ?></td>
                        <td><?php echo $row['MRP']; ?></td>
                        <td><?php echo $row['DISCOUNT'] . "%"; ?></td>
                        <td><?php echo $row['TOTAL']; ?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot class="font-weight-bold">
                    <tr style="text-align: right; font-size: 30px;">
                        <td colspan="6">Total Amount</td>
                        <td><?php echo $total_amount; ?></td>
                    </tr>
                    <tr style="text-align: right; font-size: 30px;">
                        <td colspan="6">Total Discount</td>
                        <td><?php echo $total_discount; ?></td>
                    </tr>
                    <tr style="text-align: right; font-size: 30px;">
                        <td colspan="6" style="color: green;">Net Amount</td>
                        <td class="text-primary"><?php echo $net_total; ?></td>
                    </tr>
                </tfoot>
               
               <table style="width: 95%;">
  <tr style="font-size: 23px;">
    <td style="width: 20%; text-align: left; color: black;">
      &nbsp; *<< Specialité>> ifite << Générique>>: <br><br>
      iyo umurwayi ahisemo gufata << Specialité>> mu mwanya wa << Générique>>, RSSB yishyura ikurikije igiciro cya << Générique>> gusa
    </td>
    <td style="width: 50%; text-align: center;" style="font-size: 27px;">
      <div>
        <span class="font-weight-bold">RECEIVER NAMES: </span><?php echo $tex6; ?>
      </div>
      <div>
        <span class="font-weight-bold">PHONE Number:</span><?php echo $tex7; ?><br>SIGNATURE</br>
      </div>
    </td>
  </tr>
</table>

<table style="width: 100%;">

    <tr style="font-size: 28px;">
    <td style="width: 50%; text-align: right; color: black;">
      &nbsp; PHARMACY STAMP
    </td>
</tr>
</table>


            </table>
        </div>
    </div>
    
     


    
    <div class="row text-center">
        <hr class="col-md-12" style="border-top: 2px solid #ff5252;">
    </div>
</div>

    <?php
}

?>