<?php
# func/sanitize_filename.php
function sanitize_filename($title) {
    $$title = preg_replace('/[^a-zA-Z0-9_.]/', '', $title);
    return $title;
}