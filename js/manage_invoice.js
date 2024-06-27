function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      document.getElementById("invoices_div").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "php/manage_invoice.php?action=cancel", true);
  xhttp.send();
  return false; // Prevent the default link behavior
}

function deleteInvoice(invoice_number) {
  var confirmation = confirm("Are you sure?");
  if (confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if ((xhttp.readyState = 4 && xhttp.status == 200))
        document.getElementById("invoices_div").innerHTML = xhttp.responseText;
    };
    xhttp.open(
      "GET",
      "php/manage_invoice.php?action=delete&invoice_number=" + invoice_number,
      true
    );
    xhttp.send();
  }
}
function editInvoice(invoiceId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("invoices_div").innerHTML = xhttp.responseText;
    console.log("htt", xhttp.status);
  };
  xhttp.open(
    "GET",
    "php/manage_invoice.php?action=edit&invoice_number=" + invoiceId,
    true
  );
  xhttp.send();
}

function updateInvoice(invoiceNumber) {
  var invoice_date = document.getElementById("invoice_date").value;
  var total_amount = document.getElementById("total_amount").value;
  var total_discount = document.getElementById("total_discount").value;
  var net_total = document.getElementById("net_total").value;
  var tex_7 = document.getElementById("tex_7").value;
  var tex_6 = document.getElementById("tex_6").value;
  var tex_5 = document.getElementById("tex_5").value;
  var tex_4 = document.getElementById("tex_4").value;
  var tex_3 = document.getElementById("tex_3").value;
  var tex_2 = document.getElementById("tex_2").value;
  var tex_1 = document.getElementById("tex_1").value;
  var tex = document.getElementById("tex").value;
  var medicines = document.getElementById("medicines").value;
  var batchs = document.getElementById("batchs").value;
  var quantities = document.getElementById("quantities").value;
  var mrps = document.getElementById("mrps").value;
  var payment_status = document.getElementById("payment_status").value;

  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "php/manage_invoice.php?action=update&invoice_number=" +
      invoiceNumber +
      "&invoice_date=" +
      encodeURIComponent(invoice_date) +
      "&total_amount=" +
      encodeURIComponent(total_amount) +
      "&total_discount=" +
      encodeURIComponent(total_discount) +
      "&net_total=" +
      encodeURIComponent(net_total) +
      "&tex=" +
      encodeURIComponent(tex) +
      "&tex_1=" +
      encodeURIComponent(tex_1) +
      "&tex_2=" +
      encodeURIComponent(tex_2) +
      "&tex_3=" +
      encodeURIComponent(tex_3) +
      "&tex_4=" +
      encodeURIComponent(tex_4) +
      "&tex_5=" +
      encodeURIComponent(tex_5) +
      "&tex_6=" +
      encodeURIComponent(tex_6) +
      "&tex_7=" +
      encodeURIComponent(tex_7) +
      "&payment_status=" +
      encodeURIComponent(payment_status) +
      "&medicines=" +
      encodeURIComponent(medicines) +
      "&batchs=" +
      encodeURIComponent(batchs) +
      "&quantities=" +
      encodeURIComponent(quantities) +
      "&mrps=" +
      encodeURIComponent(mrps),
    true
  );
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("invoices_div").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}

function refresh() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("invoices_div").innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_invoice.php?action=refresh", true);
  xhttp.send();
}

function searchInvoice(text, tag) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      document.getElementById("invoices_div").innerHTML = xhttp.responseText;
  };
  xhttp.open(
    "GET",
    "php/manage_invoice.php?action=search&text=" + text + "&tag=" + tag,
    true
  );
  xhttp.send();
}

function printInvoice(invoice_number) {
  var print_content;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((xhttp.readyState = 4 && xhttp.status == 200))
      print_content = xhttp.responseText;
  };
  xhttp.open(
    "GET",
    "php/manage_invoice.php?action=print_invoice&invoice_number=" +
      invoice_number,
    false
  );
  xhttp.send();
  var print_window = window.open("", "", "width=1000,height=600");
  var is_chrome = Boolean(print_window.chrome);
  print_window.document.write(print_content);

  if (is_chrome) {
    setTimeout(function () {
      print_window.document.close();
      print_window.focus();
      print_window.print();
      print_window.close();
    }, 250);
  } else {
    print_window.document.close();
    print_window.focus();
    print_window.print();
    print_window.close();
  }
  return true;
}
