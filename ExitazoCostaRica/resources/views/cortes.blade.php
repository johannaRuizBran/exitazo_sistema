<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
<td id="col1">Contenido del Td 1 </td>
<a onclick="ver('col1');">ver contenido de esta celda</a>
<td id="col2">Contenido del Td 2 </td>
<a onclick="ver('col2');">ver contenido de esta celda</a>
</table>
</body>
<script type="text/javascript">
function ver(col){
content = document.getElementById(col);
alert ("Valor del td: "+content.innerHTML);
}
</script>
</html>