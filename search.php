<?php include 'assets/includes/header.php';  includeHeader("Picryption"); ?>
<body>
<?php include 'assets/includes/nav.php'; ?>

<?php
$searchString = $_POST["search"];
echo '<div class="wrapper">
		<div class="container">
			<div class="page-header">
				<h2>Picryption <small>search</small></h2>
			</div>';



$dir = new DirectoryIterator('./');
echo '<h3><small>Showing all results for search: '.$searchString.'</small></h3>';
foreach ($dir as $file) {
    $content = file_get_contents($file->getPathname());
    if($file->isDot()) continue;
    $path_parts = pathinfo($file->getPathname());
    if (strpos($content, $searchString) !== false) {
        echo '<h3><a href="'.$file->getPathname().'">'.$path_parts["filename"].'</a></h3>';
    }
}
?>
<!-- Insert Footer -->
<?php include 'assets/includes/footer.php'; ?>
</body>
</html>

