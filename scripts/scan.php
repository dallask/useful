<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Kyvgyla
 * Date: 21-Sep-18
 * Time: 18:02
 */

define("SCAN_DIR", 'scan/');
define("SCAN_SOURCE_DIR", 'html/');
define("SCAN_IMAGES_DIR", 'img/');
define("SCAN_THEME_PATH", 'docroot/themes/custom/theme_name/');

/**
 * @param $path
 *
 * @return array
 */
function getFiles($path) {
  $objects = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST
  );
  $files = [];
  foreach ($objects as $name => $object) {
    if (!$object->isDir()) {
      $files[] = $name;
    }
  }
  return $files;
}

$images = getFiles(SCAN_DIR . SCAN_IMAGES_DIR);
$sources = getFiles(SCAN_DIR . SCAN_SOURCE_DIR);
$unusedFiles = [];

foreach ($images as $image) {
  $found = FALSE;
  $image = str_replace(SCAN_DIR, "", $image);
  foreach ($sources as $source) {
    $row = file_get_contents($source);
    if (stripos($row, $image) !== FALSE) {
      $found = TRUE;
    }
  }
  if (!$found) {
    $unusedFiles[] = $image;
    echo $image . "\n";
  }
}

print_r($unusedFiles);

/**
 * Uncomment next for real delete files
 */
//foreach ($unusedFiles as $file) {
//  unlink(SCAN_DIR . $image);
//}

