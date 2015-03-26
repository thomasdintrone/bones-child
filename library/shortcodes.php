<?php 
/*******************************************************
HERE'S SOME HANDY DANDY SHORTCODES MADE BY YOURS TRULY

* Note, the [span{x}]s require BOOTSRAP
*******************************************************/

/* [span1] */
function span1($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-1 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span1", "span1");

function span2($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-2 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span2", "span2");

/* [span3] */
function span3($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-3 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span3", "span3");

/* [span4] */
function span4($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"interior"	=> '',
    	"notoppad"  => '',
		"custom_class" => '',
	), $atts));
	
	$size = 'sm';
	
	if($xsmall 		== 'yes') { $size = 'xs'; }
	if($small 		== 'yes') { $size = 'sm'; }
	if($medium 		== 'yes') { $size = 'md'; }
	if($large 		== 'yes') { $size = 'lg'; }
	if($first 		== 'yes') { $space = ' first'; }
	if($interior 	== 'yes') { $side = ' interiorSide'; }
	if($notoppad 	== 'yes') { $side .= ' noTopPad'; }
	
    return '<div class="col-'.$size.'-4 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span4", "span4");

/* [span5] */
function span5($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-5 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span5", "span5");

/* [span6] */
function span6($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"nopad"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	if($nopad 	== 'yes') { $rpad = ' noPad'; }
	
    return '<div class="col-'.$size.'-6 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span6", "span6");

/* [span7] */
function span7($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-7 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span7", "span7");

/* [span8] */
function span8($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-8 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span8", "span8");

/* [span9] */
function span9($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-9 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span9", "span9");

/* [span10] */
function span10($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-10 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span10", "span10");

/* [span11] */
function span11($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-11 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span11", "span11");

/* [span12] */
function span12($atts, $content = null) {
    extract(shortcode_atts(array(
        "xsmall" 	=> '',
        "small" 	=> '',
		"medium" 	=> '',
		"large" 	=> '',
		"first"		=> '',
		"custom_class" => '',
    ), $atts));
	
	$size = 'sm';
	
	if($xsmall 	== 'yes') { $size = 'xs'; }
	if($small 	== 'yes') { $size = 'sm'; }
	if($medium 	== 'yes') { $size = 'md'; }
	if($large 	== 'yes') { $size = 'lg'; }
	if($first 	== 'yes') { $space = ' first'; }
	
    return '<div class="col-'.$size.'-12 '.$custom_class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("span12", "span12");

/* [hr] */
function hr($atts, $content = null) {
    extract(shortcode_atts(array(
		'dashed'	=> '',
    ), $atts));
		
		$class = '';
		if($dashed == 'yes' || $dashed == 'Yes' || $dashed == 'YES') { $class = 'dashed'; }	
		
    return '<hr class="'.$class.'" />';
}
add_shortcode("hr", "hr");

/* [br] */
function br($atts, $content = null) {
    extract(shortcode_atts(array(
    ), $atts));
	
    return '<br />';
}
add_shortcode("br", "br");

/* [h1] */
function h1($atts, $content = null) {
    extract(shortcode_atts(array(
    ), $atts));
	
    return '<h1 class="contentH">'.$content.'</h1>';
}
add_shortcode("h1", "h1");

/* [h2] */
function h2($atts, $content = null) {
    extract(shortcode_atts(array(
    ), $atts));
	
    return '<h2 class="contentH">'.$content.'</h2>';
}
add_shortcode("h2", "h2");

/* [h3] */
function h3($atts, $content = null) {
    extract(shortcode_atts(array(
    ), $atts));
	
    return '<h3 class="contentH">'.$content.'</h3>';
}
add_shortcode("h3", "h3");

/* [h4] */
function h4($atts, $content = null) {
    extract(shortcode_atts(array(
    ), $atts));
	
    return '<h4 class="contentH">'.$content.'</h4>';
}
add_shortcode("h4", "h4");

/* [h5] */
function h5($atts, $content = null) {
    extract(shortcode_atts(array(
    ), $atts));
	
    return '<h5 class="contentH">'.$content.'</h5>';
}
add_shortcode("h5", "h5");

/* [h6] */
function h6($atts, $content = null) {
    extract(shortcode_atts(array(
    ), $atts));
	
    return '<h6 class="contentH">'.$content.'</h6>';
}
add_shortcode("h6", "h6");


/************************************************
WANT TO ADD SOME OF YOUR OWN CUSTOM SHORTCODES..?

Aww.. how cute. Add them below:
************************************************/

?>