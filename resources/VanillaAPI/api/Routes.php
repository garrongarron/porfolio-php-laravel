<?php

$model = null;
router('/product', function () use (&$model) {
    $model = Product::instance();
});
