<?php include('layouts/header.php')?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    ?>
    <script>
        window.location.href="login.php";
    </script>
    <?php
    exit();
}
?>

<?php
//1. Determine page no
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    // If the user has already entered a page, the page number is the one they selected
    $page_no = $_GET['page_no'];
} else {
    // If the user just entered the page, the default page is 1
    $page_no = 1;
}

//2. Get total number of Staff
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM staffs");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

//3. Calculate staff per page and pagination
$total_records_per_page = 5;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);

//4. Get all Staff
$stmt2 = $conn->prepare("SELECT * FROM staffs LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$staffs = $stmt2->get_result();
?>

<div class="container-fluid">
    <div class="row" style="min-height: 100%">
        <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h3 class="mb-sm-0  pt-5">Staffs</h3>
                        <div class="page-title-right menu">
                            <ol class="breadcrumb pt-5">
                                <li class="breadcrumb-item">Awesome Store</li>
                                <li class="breadcrumb-item active">Staff List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($_GET['edit_success_message'])) : ?>
                <p class="text-center" style="color: green;"><?php echo htmlspecialchars($_GET['edit_success_message']); ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['edit_failure_message'])) : ?>
                <p class="text-center" style="color: red;"><?php echo htmlspecialchars($_GET['edit_failure_message']); ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['deleted_successfully'])) : ?>
                <p class="text-center" style="color: green;"><?php echo htmlspecialchars($_GET['deleted_successfully']); ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['deleted_failure'])) : ?>
                <p class="text-center" style="color: red;"><?php echo htmlspecialchars($_GET['deleted_failure']); ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['staff_created'])) : ?>
                <p class="text-center" style="color: green;"><?php echo htmlspecialchars($_GET['staff_created']); ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['staff_failed'])) : ?>
                <p class="text-center" style="color: red;"><?php echo htmlspecialchars($_GET['staff_failed']); ?></p>
            <?php endif; ?>

            <p class="text-center"></p>
            <div class="table-responsive">
            <table class="table table-striped table-sm table-bordered">
                    <thead>
                        <tr>
                        <th scope="col" style="text-align: center;">Staff Id</th>
                        <th scope="col" style="text-align: center;">Staff Name</th>
                        <th scope="col" style="text-align: center;">Staff Age</th>
                        <th scope="col" style="text-align: center;">Staff Email</th>
                        <th scope="col" style="text-align: center;">Staff Address</th>
                        <th scope="col" style="text-align: center;">Staff Salary</th>
                        <th scope="col" style="text-align: center;">Edit</th>
                        <th scope="col" style="text-align: center;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staffs as $staff) : ?>
                            <tr>
                                <td style="text-align: center;"><?php echo htmlspecialchars($staff['id']); ?></td>
                                <td style="text-align: center;"><?php echo htmlspecialchars($staff['staff_name']); ?></td>
                                <td style="text-align: center;"><?php echo htmlspecialchars($staff['staff_age']); ?></td>
                                <td style="text-align: center;"><?php echo htmlspecialchars($staff['staff_email']); ?></td>
                                <td style="text-align: center;"><?php echo htmlspecialchars($staff['staff_address']); ?></td>
                                <td style="text-align: center;"><?php echo htmlspecialchars($staff['staff_salary']); ?></td>
                                <td style="text-align: center;"><a class="btn btn-primary" href="edit_staff.php?id=<?php echo htmlspecialchars($staff['id']); ?>"><i class="fas fa-edit"></i> Edit</a></td>
                                <td style="text-align: center;"><a class="btn btn-danger" href="delete_staff.php?id=<?php echo htmlspecialchars($staff['id']); ?>"><i class="fas fa-trash-alt"></i> Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation example" class="mx-auto">
                    <ul class="pagination mt-5 mx-auto">
                        <li class="page-item <?php if ($page_no <= 1) { echo 'disabled'; } ?>">
                            <a class="page-link" href="<?php if ($page_no <= 1) { echo '#'; } else { echo "?page_no=" . ($page_no-1); } ?>">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                        <?php if ($page_no >= 3) : ?>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a></li>
                        <?php endif; ?>
                        <li class="page-item <?php if ($page_no >= $total_no_of_pages) { echo 'disabled'; } ?>">
                            <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) { echo '#'; } else { echo "?page_no=" . ($page_no+1); } ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  <?php if(isset($_GET['error'])): ?>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '<?php echo $_GET['error']; ?>'
    })
  <?php endif; ?>

  <?php if(isset($_GET['success'])): ?>
    Swal.fire({
      icon: 'success',
      title: 'Success',
      text: '<?php echo $_GET['success']; ?>'
    })
  <?php endif; ?>
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

</body>
</html>
