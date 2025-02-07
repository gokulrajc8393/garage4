<?php
require('header.php');
?>

<!-- tables -->
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet">



<main id="main" class="main">

  <div class="pagetitle">
    <h1>Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="activeuser.php">Home</a></li>
        <!--<li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Active Users</li>-->
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <section class="section">
        <div class="row">
          <div class="col-lg-12">

          <div class="card"> 
          <div class="card-body"> 
            <h5 class="card-title"> 
              User List
            </h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
                    <thead>
                        <tr>
                            <th>OrderID</th>
                            <th>Car</th>
                            <th>User</th>
                            <th>User Email</th>
                            <th>Ordered Date</th>
                            <th>Delivered Date</th>
                            <th>Price</th>
                            <th>Booking Price</th>
                            <th>Status</th>
                            <th>Invoice</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * from booking";
                        $res = select_data($sql);

                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><a href="view.php?id=<?php echo $row['car_id']; ?>"><?php echo $row['car_name']; ?></a>
                            <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                            <td><?php echo $row['email_id']; ?></td>
                            <td><?php echo date_format(date_create($row['order_date']), 'd-m-Y h:i A'); ?></td>
                            <td>
                                <?php
                                    if ($row['delivered_date'] != NULL)
                                        echo date_format(date_create($row['delivered_date']), 'd-m-Y h:i A');
                                    else
                                        echo "-";
                                    ?>
                            </td>
                            <td>₹ <?php echo $row['price']; ?></td>
                            <td>₹ 50000</td>
                            <td>
                                <?php
                                    if ($row['status'] == 1)
                                        echo "<p style='color: orange;'>Pending</p>";
                                    else if ($row['status'] == 2)
                                        echo "<p style='color: green;'>Completed</p>";
                                    ?>
                            </td>
                            <td><a class="btn btn-sm btn-primary" target="_blank"
                                    href="invoice.php?id=<?php echo $row['order_id']; ?>">View</a></td>
                            <td>
                                <?php
                                    if ($row['status'] == 1) {
                                    ?>
                                <button class="btn btn-sm btn-primary"
                                    onclick="update(<?php echo $row['order_id']; ?>,<?php echo $row['status'] + 1; ?>,'<?php echo $row['email_id']; ?>')">Update
                                    to<br> Delivered</button>
                                <?php
                                    } else {
                                        echo "-";
                                    }

                                    ?>
                            </td>
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- //blank-page -->
    </div>
</div>

<?php
require('footer.php');
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    let table = new DataTable('#table', {
        order: [],
        dom: 'lBfrtip',
        buttons: [{
            extend: 'copyHtml5',
            text: '<i class="fa fa-copy"> Copy</i>',
        }, {
            extend: 'excelHtml5',
            title: "Orders(<?php echo $email; ?>) - Carmax",
            text: '<i class="fa fa-file-excel-o"> Excel</i>',
            exportOptions: {
                columns: 'th:not(:last-child)'
            }
        }, {
            extend: 'pdfHtml5',
            title: "Orders(<?php echo $email; ?>) - Carmax",
            orientation: 'landscape',
            pageSize: 'A3',
            text: '<i class="fa fa-file-pdf-o"> PDF</i>',
            titleAttr: 'PDF',
            exportOptions: {
                columns: 'th:not(:last-child)'
            }
        }, {
            extend: 'print',
            title: "Orders(<?php echo $email; ?>) - Carmax",
            orientation: 'landscape',
            pageSize: 'A4',
            text: '<i class="fa fa-print"> Print</i>',
            exportOptions: {
                columns: 'th:not(:last-child)'
            }
        }],
    });
});

function update(order_id, status, email) {
    Swal.fire({
        title: 'Order Update',
        text: "Are you sure want to update?",
        icon: 'question',
        showClass: {
            popup: 'animated fadeInDown faster'
        },
        hideClass: {
            popup: 'animated zoomOut faster'
        },
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "php/order_status.php",
                type: "post",
                data: {
                    order_id: order_id,
                    status: status,
                    email: email
                },
                beforeSend: function() {
                    Swal.fire({
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    });
                    Swal.showLoading();
                },
                success: function(res) {
                    console.log(res);
                    Swal.fire({
                        icon: 'success',
                        title: ' Success!',
                    }).then((result) => {
                        window.location.reload(true);
                    })
                }
            });
        }

    });
}
</script>