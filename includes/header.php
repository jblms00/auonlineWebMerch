<?php
if (
    strpos($_SERVER['REQUEST_URI'], '/user/') !== false ||
    strpos($_SERVER['REQUEST_URI'], '/admin/') !== false ||
    strpos($_SERVER['REQUEST_URI'], '/staff/') !== false
) {
    $linkTg = "../../";
} else {
    $linkTg = "";
}
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $linkTg; ?>assets/media/logo.png">
<title>AU Merchandise Store</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<?php if (
    strpos($_SERVER['REQUEST_URI'], '/admin/') !== false ||
    strpos($_SERVER['REQUEST_URI'], '/staff/') !== false
) { ?>
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css" />
<?php } ?>
<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!-- Custom CSS -->
<link rel="stylesheet" href="<?php echo $linkTg; ?>assets/css/styles.css">