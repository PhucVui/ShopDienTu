<?php
if (!defined('DB_NAME')) {
    $currentFolderPath = dirname(__FILE__);
    include $currentFolderPath . '/config.php';
    include $currentFolderPath . '/../lib/database.php';
    include $currentFolderPath . '/../helpers/format.php';
    include $currentFolderPath . '/../lib/session.php';
}