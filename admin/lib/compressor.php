<?php
function sanitize_output($buffer) {
      require_once ("compressor/phpwee.php");
      return  PHPWee\Minify::html($buffer);
}