<style>
.page {width: 750px; text-align: center; width: 50%; margin: 0 auto }
.title{ color: #00AADD; font-size: 20px;font-weight: bold; margin-top: 40px; margin-botom: 10px; }
.datagrid {width: 750px;}
.datagrid table { border-collapse: collapse; text-align: left; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 3px solid #006699; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; }.datagrid table td, .datagrid table th { padding: 13px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 24px; font-weight: bold; border-left: 0px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #433E85; border-left: 2px solid #B7EEF4;font-size: 20px;font-weight: normal; }.datagrid table tbody .alt td { background: #B0F4DD; color: #00046B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #B9F4F0;} .datagrid table tfoot td { padding: 0; font-size: 20px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #00557F; color: #FFFFFF; background: none; background-color:#006699;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>

<style>
.log_fragment{
	font-weight: regular;
	border: 1px solid #DDF;
	padding: 0px 5px 0px 5px;
	margin: 0px 3px 0px 3px;
	border-radius: 0px 5px 0px 5px;
	-moz-border-radius: 0px 5px 0px 5px;
	-webkit-border-radius: 0px 5px 0px 5px;
}
.class_id{ 
	color: black; 
	background-color: white;
}
.class_timestamp{ 
	color: orange; 
	background-color: white;
}
.class_file{ 
	color: #BBF; 
	background-color: white;
}
.class_line{ 
	color: #FBB; 
	background-color: white;
}
.class_namespace{ 
	color: green; 
	background-color: #DDF;
}
.class_class{ 
	color: red; 
	background-color: #DDF;
}
.class_function{ 
	color: blue; 
	background-color: #DDF;
	font-weight: bold;
}
.class_vars{ 
	color: magenta; 
	background-color: #DFF;
}
.class_stack{ 
	color: green; 
	background-color: #DFF;
}
.class_note{ 
	color: red; 
	background-color: yellow;
}
</style>


<!DOCTYPE html>
<html lang="en">

<?php

$content = file_get_contents('C:\Logs\api.json');
   
$data = json_decode( '{ "data": [' .substr($content, 1). '] }' );

// print_r($content);
$output = '<table>';

foreach($data->data as $record) {	
	$id = property_exists($record, "id") ? $record->id : "";
	$type = property_exists($record, "type") ? $record->type : "";
	$title = property_exists($record, "title") ? $record->title : "";
	
	$file = property_exists($record, "fp") ? $record->fp : "";
	$file = property_exists($record, "path") ? $record->path : $file;
	
	$line = property_exists($record, "ln") ? $record->ln : "";
	$line = property_exists($record, "line") ? $record->line : $line;
	
	$namespace = property_exists($record, "ns") ? $record->ns : "";
	$namespace = property_exists($record, "namespace") ? $record->namespace : $namespace;
	
	$class = property_exists($record, "cl") ? $record->cl : "";
	$class = property_exists($record, "class") ? $record->class : $class;
	
	$function = property_exists($record, "fc") ? $record->function : "";
	$function = property_exists($record, "function") ? $record->function : $function;
	
	$vars = property_exists($record, "vars") ? json_encode($record->vars) : "";
	$vars = property_exists($record, "variables") ? json_encode($record->variables) : $vars;
	
	$stack = property_exists($record, "stack") ? json_encode($record->stack) : "";
	
	$note = property_exists($record, "note") ? $record->note : "";
	
	$timestamp = property_exists($record, "ts") ? $record->ts : "";
	$timestamp = property_exists($record, "timestamp") ? $record->timestamp : $timestamp;

	$output .= "  <tr class='{$type}'><td>{$title}</td>";
	$output .= "    <td><span class='log_fragment class_id'>{$id}</span></td>";
	$output .= "    <td><span class='log_fragment class_timestamp'>{$timestamp}</span></td>";
	$output .= "    <td><span class='log_fragment class_namespace'>{$namespace}</span></td>";
	$output .= "    <td><span class='log_fragment class_class'>{$class}</span></td>";
	$output .= "    <td><span class='log_fragment class_function'>{$function}</span></td>";
	$output .= "    <td><span class='log_fragment class_vars'>{$vars}</span></td>";
	$output .= "    <td><span class='log_fragment class_stack'>{$stack}</span></td>";
	$output .= "    <td><span class='log_fragment class_file'>{$file}</span></td>";
	$output .= "    <td><span class='log_fragment class_line'>{$line}</span></td>";
	$output .= "    <td><span class='log_fragment class_note'>{$note}</span></td>";
	$output .= "  </tr>";
}

$output .= '</table>';

echo $output;
?>