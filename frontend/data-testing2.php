<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Testing</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="KNN Sentimen Analisis" />
    <meta name="author" content="KNN" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
</head>

<body data-menu-color="dark" data-sidebar="default">

    <!-- Begin page -->
    <div id="app-layout">

        <!-- Topbar Start -->
        <?php include 'topbar.php' ?>
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <?php include 'sidebar.php' ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-xxl">

                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold m-0">Data Testing</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Data Tweet</h5>
                                            <table id='dataTweetTable' class='table table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Data</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Data Pelabelan</h5>
                                            <table id='dataPelabelanTable' class='table table-bordered'>
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Sentimen</th>
                                                        <th>Status</th>
                                                        <th>Aktual</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container-fluid -->
            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include 'footer.php' ?>
            <!-- end Footer -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <?php include 'scripts.php' ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // fetch('http://127.0.0.1:5000/data-testing')
        fetch('http://127.0.0.1:5000/data-testing')
            .then(response => response.json())
            .then(responseData => {
                // Data Tweet
                const dataTweet = responseData.data_tweet;
                const tweetTableBody = document.querySelector('#dataTweetTable tbody');
                dataTweet.forEach((item, index) => {
                    const row = document.createElement('tr');
                    const cellIndex = document.createElement('td');
                    const cellData = document.createElement('td');
                    const cellStatus = document.createElement('td');

                    cellIndex.textContent = index + 1;
                    cellData.textContent = item.rawContent;
                    cellStatus.textContent = item.status;

                    row.appendChild(cellIndex);
                    row.appendChild(cellData);
                    row.appendChild(cellStatus);
                    tweetTableBody.appendChild(row);
                });

                // Data Pelabelan
                const dataPelabelan = responseData.data_pelabelan;
                const pelabelanTableBody = document.querySelector('#dataPelabelanTable tbody');
                dataPelabelan.forEach((item, index) => {
                    const row = document.createElement('tr');
                    const cellIndex = document.createElement('td');
                    const cellSentimen = document.createElement('td');
                    const cellStatus = document.createElement('td');
                    const cellAktual = document.createElement('td');

                    cellIndex.textContent = index + 1;
                    cellSentimen.textContent = item.sentimen;
                    cellStatus.textContent = item.status;
                    cellAktual.textContent = item.aktual;

                    row.appendChild(cellIndex);
                    row.appendChild(cellSentimen);
                    row.appendChild(cellStatus);
                    row.appendChild(cellAktual);
                    pelabelanTableBody.appendChild(row);
                });

                // Initialize DataTables
                new DataTable('#dataTweetTable');
                new DataTable('#dataPelabelanTable');
            })
            .catch(error => console.error('Error fetching data:', error));
    });
    </script>
</body>

</html>