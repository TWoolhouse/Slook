<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>


<style>
html {
	background: linear-gradient(to bottom, #ad3da2, #337796);
	font-family: "Segoe UI", sans-serif;
}
html, body{
	height: 100%;
	margin:0px;
	
}

#title{
	font-size: 4em;
	position: fixed;
	top: 0;
	left: 0.5em;
	margin: 0px;

}
.home{
	display: flex;
	flex-direction: row;
	position: relative;
	align-items: center;
	justify-content: center;
	text-align: center;
	top: 50%;

}
button{
	width: 30%;
	height: 10em;
	display: inline-block;
	
}
</style>

</head>



<body>
<h1 id="title">Slook</h1>
<div class="home">
	<button id="textchat">Text Chat</button>
	<button id="analytics">Data Analytics</button>
</div>



</body>
</html>




