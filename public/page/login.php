<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>


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

#loginTitle{
    text-align: left;
	opacity: 0.9;
}

body{
	display: flex;
	position: relative;
	align-items: center;
	justify-content: center;
	overflow: hidden;


}
.login {

	padding: 0em 1em 1em;
    
	width: 30%;

    border-radius: 1em;

	background-color: rgba(255,255,255,0.5);

}

input{
  height: 2em;
  position: relative;
  width: 100%;
  border-radius: 0.5em;
  border: 0;
  font-size: 1em;
  box-sizing: border-box;
  padding-left: 2%;

}
.submit {
  background: linear-gradient(to bottom, rgb(91,100,154), rgb(81,105,153));

  border-radius: 0.5em;
  border: 0;
  position: relative;
  box-sizing: border-box;
  color: #eee;
  cursor: pointer;
  font-size: 1.5em;
  height: 2em;
  margin-top: 1.5em;
  // outline: 0;
  text-align: center;
  width: 100%;
}

.submit:hover {
  filter: brightness(85%);
}
</style>

<script>

$(document).ready(function(){
	//checks the db to see if the username and password are correct. if so, then moves to home page.
	$("#loginForm").submit(function(event){
		let username = document.getElementById("loginEmailInput").value.toLowerCase();
		let password = document.getElementById("loginPasswordInput").value;
		$.ajax({type: "POST", 
		url:"loginBackend.php",
		data:{'submitted':true, 'password': password, 'email': username},
		success: function(response){
			if (response == true){
				document.getElementById("passwordCheck").style.display = "none";
				//go to home screen
				window.location.href = "home.php";
			}
			else{
				document.getElementById("passwordCheck").style.display = "block";
				document.getElementById("passwordCheck").innerHTML = "Error: incorrect credentials";
			}
		}
		});
		event.preventDefault();	
	});
		
});

</script>
</head>



<body>
<h1 id="title">Slook</h1>
<div class="login">
	<form id="loginForm" name = "loginForm" action="loginBackend.php" method="post">  
		<h1 id="loginTitle">Login</h1>
		<div>
		<input type="email" id="loginEmailInput" name="loginEmailInput" placeholder = "Your email" pattern = "^[A-Za-z0-9._%+-]+@makeitall\.com$" required>
		</div>
		<br>
		<div>
		<p id = "passwordCheck" style="display: none; color: red;">Username or password is incorrect</p>
		<input type="password" id="loginPasswordInput" class = "form-control"name="loginPasswordInput" placeholder = "Your password" required><br>
		</div>
		<button type="submit" class="submit" name="loginSubmit" value="Submit">Submit</button>
	</form>
</div>

</body>
</html>




