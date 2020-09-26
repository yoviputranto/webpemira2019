<?php
error_reporting(0);
require '../include/koneksi.inc.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
} elseif (isset($_POST['login'])) {
    $username = stripslashes(mysqli_real_escape_string($kon, $_POST['username']));
    $userpass = stripslashes(mysqli_real_escape_string($kon, $_POST['password']));

    $sql = mysqli_query($kon, "SELECT username, password FROM admin WHERE username = '$username'");
    list($username, $password) = mysqli_fetch_array($sql);

    if (mysqli_num_rows($sql) > 0) {
        if (password_verify($userpass, $password)) {
            $_SESSION['username'] = $username;
            setcookie("username", $_SESSION['username'], time()+1800);
            
            header("Location: home.php");
            die();
        } else {
            header("Location: index.php?res=invalid");
        }
    } else {
        header("Location: index.php?res=invalid");
    }    
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Admin Panel">
    <meta name="author" content="muhammad_naufal@apps.ipb.ac.id">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="../favicon.ico"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jasny-bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css" >
    <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
    <script type="text/javascript" src="../js/sweetalert.min.js"></script>
    <style type="text/css">
        /* vietnamese */
        @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 400;
        src: local('Quicksand Regular'), local('Quicksand-Regular'), url(../fonts/quicksand/v9/6xKtdSZaM9iE8KbpRA_hJFQNcOM.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
        }
        /* latin-ext */
        @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 400;
        src: local('Quicksand Regular'), local('Quicksand-Regular'), url(../fonts/quicksand/v9/6xKtdSZaM9iE8KbpRA_hJVQNcOM.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 400;
        src: local('Quicksand Regular'), local('Quicksand-Regular'), url(../fonts/quicksand/v9/6xKtdSZaM9iE8KbpRA_hK1QN.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>
    <style type="text/css">
        html, body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
              <a class="navbar-left" href="#"><img src="../images/svipb.png" style="margin-top: 7px; margin-bottom: 7px; max-width: 100%; height: auto;"></a>
              <!--a class="navbar-brand" href="#"></a--><!-- PEMIRA MICRO IT 2019 -->
            </div>
        </div>
    </nav>

	<div class="container-fluid" style="max-width: 635px;">
		<div class="panel panel-body">
            <h2><?php
            if (isset($_GET['res']) && $_GET['res'] == 'invalid') {
                echo 'Data salah';
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal(
                    "Error!",
                    "Data salah, kak.",
                    "error")';
                echo '}, 100);</script>';
            } else {
                echo 'Login';
            }
            ?></h2>
            <hr>
			<form method="post" action="" autocomplete="off">
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control" placeholder="Username" oninvalid="this.setCustomValidity('Tolong diisi usernamenya')" oninput="setCustomValidity('')" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" placeholder="********" oninvalid="this.setCustomValidity('Tolong diisi passwordnya')" oninput="setCustomValidity('')" required>
			</div>
			<div class="form-group"> 
				Forgot password? Try to remember that!
			</div>
			<div class="form-group">
				<button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
			</div>                                                      
		    </form>
		</div><!-- /.panel -->
	</div><!-- /.container -->
	
	<footer class="footer">
		<div class="container">
			<p class="text-muted">&copy; 2019 &middot; HIMAVO MICRO IT</p>
		</div>
	</footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jasny-bootstrap.min.js"></script>
</body>
</html>