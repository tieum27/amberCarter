<?php 
error_reporting (E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member System - Reset Password</title>
</head>
<body>
<?php 

if ($userid && $username)
	{
	if ($_POST['resetpass'])
		{
		// get the form data
		$pass = $_POST['pass'];
		$newpass = $_POST['newpass'];
		$confirmpass = $_POST['confirmpass'];
		
		// make sure all data was entered
		if ($pass)
			{
			if ($newpass)
				{
				if ($confirmpass)
					{
					if ($newpass === $confirmpass)
						{
						$password = md5(md5("hihHLf".$pass."DFSg846360"));
						
						// connect to db
						require("./connect.php");
						
						// make sur password is correct	
						$query = mysql_query("SELECT * FROM users WHERE username='$user' AND password='$password'");
						$numrows = mysql_num_rows($query);
						
						if($numrows == 1)
							{
							// encrypt new password
							$newpassword = md5(md5("hihHLf".$newpass."DFSg846360"));
							
							// update db with new password
							mysql_query("UPDATE users SET password='$newpassword' WHERE username='$username'");
							
							// make sure password was changed
							$query = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");
							$numrows = mysql_num_rows($query);
						
							if($numrows == 1)
								{
								echo "Your password has been reset.";
								}
								else
									echo "An error has occured and the password was not reset.";
							}
							else
								echo "Your current password is incorrect.";
								
						mysql_close();
						}
						else
							echo "Your password did not match. ";
					}
					else
						echo "You must confirm your new password";
				}
				else
					echo "You must enter your new password";
			}
			else
				echo "You must enter your current password";
		}
		echo "<form action='./resetpass.php' method='post'>
				<table>
					<tr>
					<td>Current Password: </td>
					<td><input type='text' name='pass' /></td>
				</tr>
				<tr>
					<td>New Password: </td>
					<td><input type='password' name='newpass' /></td>
				</tr>
				<tr>
					<td>Confirm Password: </td>
					<td><input type='password' name='confirmpass' /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type='submit' name='resetpass' value='Reset Password' /></td>
				</tr>
				</table>
			  </form>";

	}
	else
		echo "$username Please login to acces this page. <a href='./login.php'>Login here</a>";


?>
</body>
</html>
