<?php
include 'koneksi.php';
session_start();
if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
if ($email!="" && $password!=""){
  $mysql = mysqli_query($koneksi, "select * from pembeli where email='$email' and password='$password'");
  if($data=mysqli_fetch_array($mysql)){  
    $_SESSION['email']=$data['email'];
    $_SESSION['password']=$data['password'];
    header("Location:cart.php");
  }else{
    header("Location:loginuser.php");
  }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=>, initial-scale=1.0">
    <title>Document</title>
    <style>
body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
	background: linear-gradient(to bottom right, aqua, black, aqua);
}
.main{
	width: 350px;
	height: 500px;
	background: red;
	overflow: hidden;
	background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000;
}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
}
label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 60px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}
input{
	width: 60%;
	height: 20px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
}
button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: #573b8a;
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background: #6d44b8;
}
.login{
	height: 450px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: #573b8a;
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}

    </style>
</head>
<body>
<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="sign_in">
				<form action="" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="email" placeholder="email" required="">
                    <input type="text" name="password" placeholder="password" required="">
					<button name="submit">Login</button>
					<center><a href="daftaruser.php">Buat akun? </a>/ <a href="adminlg.php">login Admin!</a></center>
				</form>
			</div>
	</div>
</body>