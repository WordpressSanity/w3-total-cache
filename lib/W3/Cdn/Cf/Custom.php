<?php

/**
 * Amazon CloudFront (Custom origin) CDN engine
 */
require_once W3TC_LIB_W3_DIR . '/Cdn/Cf.php';

class W3_Cdn_Cf_Custom extends W3_Cdn_Cf {
    var $type = W3TC_CDN_CF_TYPE_CUSTOM;
}
