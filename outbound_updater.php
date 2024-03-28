<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'experiment');


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['csv', 'xls', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];

        // Load the file into a Spreadsheet object
        $spreadsheet = IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // Skip the header row
        $headerSkipped = false;

        foreach ($data as $row) {
            // Skip the header row
            if (!$headerSkipped) {
                $headerSkipped = true;
                continue;
            }

            // Retrieve data from the row
            $SN = isset($row['A']) ? $row['A'] : '';
            $trx_id = isset($row['B']) ? $row['B'] : '';
            $item_id = isset($row['C']) ? $row['C'] : '';
            $item_description = isset($row['D']) ? $row['D'] : '';
            $item_quantity = isset($row['E']) ? $row['E'] : '';
            $unit_price = isset($row['F']) ? $row['F'] : '';
            $date_shipped = isset($row['G']) ? $row['G'] : '';
            $department = isset($row['H']) ? $row['H'] : '';
            $destination = isset($row['I']) ? $row['I'] : '';
            $total_price = isset($row['J']) ? $row['J'] : '';
            $remarks = isset($row['K']) ? $row['K'] : '';

            // SQL query to insert data
            $outboundQuery = "INSERT INTO outbound (SN, trx_id,item_id, item_description, item_quantity, unit_price, date_shipped, department, destination, total_price, remarks) VALUES 
            ('$SN',
            '$trx_id',
            '$item_id',
            '$item_description',
            '$item_quantity',
            '$unit_price',
            '$date_shipped',
            '$department',
            '$destination',
            '$total_price',
            '$remarks')";

            // Execute the query
            $result = mysqli_query($con, $outboundQuery);
            if ($result) {
                $msg = "Successfully imported";
            } else {
                $msg = "Error occurred while importing data: " . mysqli_error($con);
                break; // Exit the loop if an error occurs
            }
        }

        $_SESSION['message'] = $msg;
        header('location: outbound_updater.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Invalid file format. Please upload a CSV, XLS, or XLSX file.";
        header('location: outbound_updater.php');
        exit(0);
    }
}
// Function to download the Excel file
function downloadExcelFile($con)
{
    require_once 'vendor/autoload.php'; // Include autoload.php

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add header row
    $headerRow = ['SN', 'Transaction Id','Item Id', 'Item Description', 'Item Quantity', 'Unit Price', 'Date Shipped', 'Department', 'Destination', 'Total Price', 'Remarks'];
    $column = 'A';
    foreach ($headerRow as $headerCell) {
        $sheet->setCellValue($column++ . '1', $headerCell);
    }

    // Fetch data from the database
    $sql = "SELECT * FROM outbound";
    $result = mysqli_query($con, $sql);
    $rowCount = 2; // Start from the second row after the header

    // Add data rows
    while ($row = mysqli_fetch_assoc($result)) {
        $column = 'A';
        foreach ($row as $cell) {
            $sheet->setCellValue($column++ . $rowCount, $cell);
        }
        $rowCount++;
    }

    // Set headers for download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="outbound_data.xlsx"');
    header('Cache-Control: max-age=0');

    // Write to output
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
}

if (isset($_POST['download_excel'])) {
    downloadExcelFile($con);
}
// Function to construct SQL query for searching within a date range
function buildDateRangeQuery($startDate, $endDate)
{
    $sql = " AND date_shipped BETWEEN '$startDate' AND '$endDate'";
    return $sql;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <title>Search Outbound Data</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-box {
            border: 2px solid #007bff;
            padding: 1px;
            margin-top: 60px;
            border-radius: 10px;
            background-color: #fff;
        }

        .form-control-sm {
            border-radius: 5px;
        }

        .btn-dark {
            border-radius: 5px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php include 'index.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container-box">
                    <form class="my-3 mx-3" method="post">
                        <h2 class="mb-4">Search And Update Outbound Details</h2>
                        <div class="row">
                        <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm mb-3" name="trx_id" placeholder="Transcation ID">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm mb-3" name="item_id" placeholder="Item ID">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm mb-3" name="item_description" placeholder="Item description">
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control form-control-sm mb-3" name="date_shipped_from" placeholder="Extract Date From">
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control form-control-sm mb-3" name="date_shipped_to" placeholder="Extract Date To">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm mb-3" name="department" placeholder="Department name">
                            </div>
                        </div>
                        <div class="button-group">
                            <button type="submit" name="submit" class="btn btn-primary">Search</button>
                            <button type="submit" name="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" name="download_excel" class="btn btn-success">Download Excel</button>
                            <a href="create_outb.php" class="btn btn-secondary">Create</a>
                        </div>
                    </form>
                    <div class="container my-1 mx-1 table-container">
                        <table class="table table-bordered border-primary table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>SN</th>
                                    <th>Transaction Id</th>
                                    <th>Item Id</th>
                                    <th>Item Description</th>
                                    <th>Item Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Date Shipped</th>
                                    <th>Department</th>
                                    <th>Destination</th>
                                    <th>Total Price</th>
                                    <th>Remarks</th>
                                    <th>Updated By</th>
                                    <th>Updated Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_connect_errno()) {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                    exit();
                                }

                                // Number of columns per page
                                $columns_per_page = 10;

                                // Number of records per page
                                $records_per_page = $columns_per_page; // Adjust to match the number of columns

                                // Determine current page number
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                                // Calculate the starting record for the current page
                                $start_from = ($current_page - 1) * $records_per_page;



                                if (!isset($_POST['submit'])) {
                                    $sql = "SELECT * FROM `outbound` WHERE SN <= 50 LIMIT $start_from, $records_per_page";
                                    $result = mysqli_query($con, $sql);

                                    $counter = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";

                                        echo '<td>' . $row['SN'] . '</td>
                                        <td>' . $row['trx_id'] . '</td>        
                                        <td>' . $row['item_id'] . '</td>
                                                <td>' . $row['item_description'] . '</td>
                                                <td>' . $row['item_quantity'] . '</td>
                                                <td>' . $row['unit_price'] . '</td>
                                                <td>' . $row['date_shipped'] . '</td>
                                                <td>' . $row['department'] . '</td>
                                                <td>' . $row['destination'] . '</td>
                                                <td>' . $row['total_price'] . '</td>
                                                <td>' . $row['remarks'] . '</td>
                                                <td>' . $row['updated_by'] . '</td>
                                                <td>' . $row['updated_time'] . '</td>
                                                <td>
                                                <a href="update_outb.php?SN=' . $row['SN'] . '" class="btn btn-info btn-sm">Update</a>
                                            </td>';


                                        echo "</tr>";
                                    }
                                } else {
                                    // Handling form submission with SQL query
                                    $trx_id = isset($_POST['trx_id']) ? $_POST['trx_id'] : '';
                                    $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : '';
                                    $item_description = isset($_POST['item_description']) ? $_POST['item_description'] : '';
                                    $date_shipped_from = isset($_POST['date_shipped_from']) ? $_POST['date_shipped_from'] : ''; // Corrected variable name
                                    $date_shipped_to = isset($_POST['date_shipped_to']) ? $_POST['date_shipped_to'] : ''; // Corrected variable name
                                    $department = isset($_POST['department']) ? $_POST['department'] : '';

                                    $sql = "SELECT * FROM `outbound` WHERE 1=1";

                                    if (!empty($trx_id)) {
                                        $sql .= " AND trx_id LIKE '%$trx_id%'";
                                    }
                                    if (!empty($item_id)) {
                                        $sql .= " AND item_id LIKE '%$item_id%'";
                                    }
                                    if (!empty($item_description)) {
                                        $sql .= " AND item_description LIKE '%$item_description%'";
                                    }
                                    if (!empty($date_shipped_from) && !empty($date_shipped_to)) {
                                        // Call the function to build the date range query
                                        $sql .= buildDateRangeQuery($date_shipped_from, $date_shipped_to);
                                    } elseif (!empty($date_shipped_from)) {
                                        // Only start date is provided
                                        $sql .= " AND date_shipped >= '$date_shipped_from'";
                                    } elseif (!empty($date_shipped_to)) {
                                        // Only end date is provided
                                        $sql .= " AND date_shipped <= '$date_shipped_to'";
                                    }
                                    if (!empty($department)) {
                                        $sql .= " AND department LIKE '%$department%'";
                                    }

                                    $result = mysqli_query($con, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['SN'] <= 50) { // Only display rows with SN up to 80
                                                echo '<tr>
                                                    <td>' . $row['SN'] . '</td>
                                                    <td>' . $row['trx_id'] . '</td>
                                                    <td>' . $row['item_id'] . '</td>
                                                    <td>' . $row['item_description'] . '</td>
                                                    <td>' . $row['item_quantity'] . '</td>
                                                    <td>' . $row['unit_price'] . '</td>
                                                    <td>' . $row['date_shipped'] . '</td>
                                                    <td>' . $row['department'] . '</td>
                                                    <td>' . $row['destination'] . '</td>
                                                    <td>' . $row['total_price'] . '</td>
                                                    <td>' . $row['remarks'] . '</td>
                                                    <td>' . $row['updated_by'] . '</td>
                                                    <td>' . $row['updated_time'] . '</td>
                                                    <td>
                                                <a href="update_outb.php?SN=' . $row['SN'] . '" class="btn btn-info btn-sm">Update</a>
                                            </td>
                                                </tr>';
                                            }
                                        }
                                    } else {
                                        echo '<tr><td colspan="8">Data not found</td></tr>';
                                    }
                                }

                                echo "</table>";

                                // Pagination links
                                echo '<div>';
                                $total_records_sql = "SELECT COUNT(*) AS total_records FROM `outbound` WHERE SN <= 50";
                                $result = mysqli_query($con, $total_records_sql);
                                $total_records = mysqli_fetch_assoc($result)['total_records'];
                                $total_pages = ceil($total_records / $records_per_page);

                                echo '<nav aria-label="Page navigation example">';
                                echo '<ul class="pagination">';
                                // Previous button
                                if ($current_page > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                                }

                                // Page numbers
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    echo '<li class="page-item ' . ($current_page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                }

                                // Next button
                                if ($current_page < $total_pages) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                                }
                                echo '</ul>';
                                echo '</nav>';

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="import_file" class="form-control" />
                        <button type="submit" name="save_excel_data" class="btn btn-primary mt-3">Import</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
    </div>
</body>

</html>