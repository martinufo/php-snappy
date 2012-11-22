#! /usr/bin/env php
<?php
/*
 * Simple snappy cli script.
 *
 * Basic usage:
 * # ./snappy.php -c < file.in > compressed
 * # ./snappy.php -d < compressed > file.out
 */

// define options
$opts = 'cdq::v::';
$options = getopt($opts);

// handle verbosity
$quiet = isset($options['q']);
$verbose = isset($options['v']);
if (!$quiet && $verbose) {
    error_reporting(E_ALL | E_WARNING);
} else {
    error_reporting(0);
}

// (un)compress
if (isset($options['d'])) {
    // uncompress
    $data = file_get_contents('php://stdin');
    $rs = snappy_uncompress($data);
} elseif (isset($options['c'])) {
    // compress
    $data = file_get_contents('php://stdin');
    $rs = snappy_compress($data);
} else {
    // help
    echo 'CLI tool for STDIN (un)compression' . PHP_EOL;
    echo '==================================' . PHP_EOL;
    echo PHP_EOL;
    echo '# snappy.php [-q] MODE' . PHP_EOL;
    echo PHP_EOL;
    echo 'MODE is either of' . PHP_EOL .
         ' -c for compression' . PHP_EOL .
         ' -d for decompression' . PHP_EOL .
         'Use -q to surpress messages' . PHP_EOL .
         'and -v to print detailed warnings.' . PHP_EOL;

}

// print results
if (isset($rs)) {
    if ($rs === false) {
        if (!$quiet) {
            echo 'Failed to (un)compress.' . PHP_EOL;
        }
        exit(1);
    } else {
        echo $rs;
    }
}

exit(0);
