<?php
require_once __DIR__ . '/NextSmallestNumberFinder.php';

$f = new NextSmallestNumberFinder([3, 4, 6, 9, 10, 12, 14, 15, 17, 19, 21]);
var_dump($f->findNextSmallestLinear(14));exit();
