<?php
/**
 * @package No DiggBar
 * @author Rob Allen (rob@akrabat.com)
 * @license New BSD: http://akrabat.com/license/new-bsd
 * @version 1.0
 */
/*
Plugin Name: No DiggBar
Plugin URI: http://akrabat.com/no_diggbar
Description: Prevent the use of the DiggBar with this site
Author: Rob Allen
Version: 1.0
Author URI: http://akrabat.com
*/

// Try to redirect via Javascript, but if that fails, provide a blank page
// with just a link to the site.
function akrabat_no_diggbar() {
    if (preg_match('@http://digg.com/\w{1,8}/?$@', $_SERVER['HTTP_REFERER']) ) {
        $url = get_bloginfo('url');
        $title = get_bloginfo('name');
        echo <<<EOT
<html>
<head>
    <title>$title</title>
    <script type="text/javascript">
    if (top !== self) {
        var diggbarPattern = new RegExp(/http:\/\/digg.com\/\w{1,8}\/?$/);
        if(diggbarPattern.test(document.referrer)) {
            top.location.href = '$url/';
        }
    }
    </script>
</head>
<body>
    <noscript>
        <p>Continue to <a target="_top" href="$url">$title</a>.
    </noscript>
</body>
</html>
EOT;
        exit;
    }
}

// add hooks
add_action('init', 'akrabat_no_diggbar');

// vim: set filetype=php expandtab tabstop=4 shiftwidth=4 autoindent smartindent: 

