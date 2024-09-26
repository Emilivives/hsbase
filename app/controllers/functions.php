<?php
// functions.php
function formatCommaSeparated($value) {
    return implode('<br>', explode(',', $value));
}