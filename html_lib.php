<?php
// Thư viện hàm hỗ trợ kết xuất HTML
// 22/04/2013
// 
// 
$style = 'style="font-family: Verdana; font-size: 16pt"';

function htOpen ($title = 'No title') {
	global $style;
	return "<html><head><title>$title</title></head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><body $style>";
}

function htClose () {
	return '</body></html>';
}

function formOpen ($title = 'No title', $name='Myform', $method='post', $action='') {
	global $style, $PHP_SELF;
	$action = $action == '' ? $PHP_SELF : $action;
	return "<html><head><title>$title</title></head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><form name='$name' method='$method' action='$action' $style>";
}

function formClose () {
	return '</form></html>';
}

function textbox ($name='tbox', $value='', $size='', $maxlength='') { 
	global $style;
	$size = $size=='' ? '' : " size='$size'";
	$maxlength = $maxlength=='' ? '' : " maxlength='$maxlength'";
	return "<input type='text' name='$name' value='$value'{$size}{$maxlength} $style />";
}

function passbox ($name='pbox', $value='') { 
	global $style;
	return "<input type='password' name='$name' value='$value' $style />";
}

function checkbox ($name='cb', $value='1', $current='' ) {
	$checked = $current == $value ? ' checked' : '';
	return "<input type='checkbox' name='$name' value='$value'{$checked} />";
}

function radio ($value='', $name='rb', $current='', $submit='') { 
	$submit = $submit=='' ? '' : ' onClick="submit()"';
	$checked = $current == $value ? ' checked' : '';
	return "<input type='radio' name='$name' value='$value'{$submit}{$checked} />";
}

function tableOpen ($width='100%', $border='1', $cellspacing='0', $cellpadding='1') {
	global $style;
	return "<table width='$width' border='$border' cellspacing='$cellspacing' cellpadding='$cellpadding' $style>";
}

function tableClose () {
	return '</table>';
}

function td ($content='&nbsp;', $width='', $align='', $colspan='', $rowspan='', $valign='') {
	$width = $width=='' ? '' : " width='$width'";
	$align = $align=='' ? '' : " align='$align'";
	$colspan = $colspan=='' ? '' : " colspan='$colspan'";
	$rowspan = $rowspan=='' ? '' : " rowspan='$rowspan'";
	$valign = $valign=='' ? '' : " valign='$valign'";
	return "<td{$width}{$align}{$valign}{$colspan}{$rowspan}>$content</td>";
}

function tr ($content, $align='', $valign='') {
	$align = $align=='' ? '' : " align='$align'";
	$valign = $valign=='' ? '' : " valign='$valign'";
	return "<tr{$align}{$valign}>$content</tr>";
}

function cmd ($value='Ok', $name='cmd') {
	global $style;
	return "<input type='submit' name='$name' value='$value' $style /> ";
}

function listbox ($name='lb', $tblname, $fld_value, $fld_dsp, $current, $onchange='') {
	global $style;
	$onchange = ($onchange=='') ? '' : ' onChange="submit()"';
	$result = mysql_query ("select ".$fld_value. "as id, ".$fld_dsp." as name from ".$tblname);
	$retval = "<select name='$name' $style $onchange><option value=' '>&nbsp;</option>";
	while ($r = mysql_fetch_array ($result)) 
		$retval .= '<option value="' . $r['id'] . '"' . ($r['id']==$current ? ' selected>' : '>') . $r['name'] . '</option>';  	
	
	return $retval . '</select>';
}
?>
