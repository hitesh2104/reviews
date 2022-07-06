<!DOCTYPE html>
<html>
    <?php
    if (isSystemAdmin()) {
        $dashboardTitle = 'System Administrator';
    } elseif (isMasterAdmin()) {
        $dashboardTitle = 'Master Administrator';
    } elseif (isClient()) {
        $dashboardTitle = 'Client';
    } elseif (isStaff()) {
        $dashboardTitle = 'Test Administrator';
    } elseif (isCandidate()) {
        $dashboardTitle = 'Candidate';
    }
    $testCheck = $this->uri->segment(2);
    ?>
    <!-- include header here -->
    <?php include_once 'header.php'; ?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- include top menu -->
            <?php include_once 'top-menu.php'; ?>
            <!-- include side menu -->
            <?php include_once 'side-menu.php'; ?>   

            <?= $content_for_layout ?>
            <!-- include footer -->
            <?php include_once 'footer.php'; ?>
        </div>
    </body>
</html>
<!-- END  PAGE LEVEL SCRIPTS -->
<script>
    $(document).ready(function () {
        $('.message-alert').delay(5000).fadeOut(400);
    });
    <?php if ($testCheck == 'begin' || $testCheck == 'register' || $testCheck == 'consent') { ?>
        $('body').addClass('sidebar-collapse');
        $('.sidebar-toggle').hide();
    <?php } ?>
</script>

