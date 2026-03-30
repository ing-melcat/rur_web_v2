<?php
date_default_timezone_set('America/Mexico_City');

// Get last modified time of the current file
$lastModified = date("F d, Y H:i:s", filemtime(__FILE__));
?>
<p class="text-muted text-center">
  Last modified: <?php echo $lastModified; ?>
</p>
