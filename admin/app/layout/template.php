<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/vendor/autoload.php';
include_once 'head.php';
?>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php if(\App\App::getInstance()->checkSession()) include_once 'sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php if(\App\App::getInstance()->checkSession()) include_once 'topbar.php'; ?>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">

                {{ content }}

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once 'footer.php'; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php include_once 'scripts.php'; ?>
</body>

</html>
