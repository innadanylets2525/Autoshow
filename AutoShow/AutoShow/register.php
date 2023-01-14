<?php
$per = '';
include("includes/connection.php");
if(isset($_POST["register"])){
	$per = $_POST['per'];
		if(!empty($_POST['Initials']) && !empty($_POST['Email']) && !empty($_POST['Phone_number']) && !empty($_POST['Password'])) {
			$Initials= htmlspecialchars($_POST['Initials']);
			$Email=htmlspecialchars($_POST['Email']);
			$Phone_number=htmlspecialchars($_POST['Phone_number']);
			$Company=htmlspecialchars($_POST['Company']);
			$Password=htmlspecialchars($_POST['Password']);
			if($per == 1) $query=mysqli_query($con,"SELECT * FROM buyer WHERE Email='".$Email."'");
			else if($per == 2) $query=mysqli_query($con,"SELECT * FROM workers WHERE Email='".$Email."'");
			else if($per == 3) $query=mysqli_query($con,"SELECT * FROM supplier WHERE Email='".$Email."'");
			$numrows=mysqli_num_rows($query);
			if($numrows==0)
			{
				if($per == 1) $sql="INSERT INTO buyer
				(Initials, Email, Phone_number,Password)
				VALUES('$Initials','$Email', '$Phone_number', '$Password')";
				else if($per == 2) $sql="INSERT INTO workers
				(Initials, Email, Phone_number,Password)
				VALUES('$Initials','$Email', '$Phone_number', '$Password')";
					else if($per == 3) $sql="INSERT INTO supplier
				(Initials, Email, Company, Phone_number,Password)
				VALUES('$Initials','$Email', '$Company', '$Phone_number', '$Password')";
				$result=mysqli_query($con,$sql);
				if($result){
					$message = "Account Successfully Created";
				} else {
					$message = "Failed to insert data information!";
				}
			} else {
				$message = "That Email already exists! Please try another one!";
			}
		} else {
			$message = "All fields are required!";
		}
	}
?>

	<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>


<?php include("includes/header.php"); ?>
<div class="container mregister">
	<div id="login">
		<h1>Реєстрація</h1>
		<form action="register.php" id="registerform" method="post"name="registerform">
			<p><label for="user_login">Призвіще, ініціали *<br>
				<input class="input" id="Initials" name="Initials"size="32"  type="text" value=""></label></p>
				<p><label for="user_pass">E-mail *<br>
					<input class="input" id="Email" name="Email" size="32"type="email" value=""></label></p>					
					<p><label for="user_pass">Номер телефону +38 0ХХ ХХХХХХХ *<br>
						<input class="input" id="Phone_number" name="Phone_number"size="9" type="text" value=""></label></p>
						<p ><label for="user_pass">Компанія<br>
							<input class="input" id="Company" name="Company"size="20" type="text" value=""></label></p>
							<p><label for="user_pass">Пароль *<br>
								<input class="input" id="Password" name="Password"size="32"   type="password" value=""></label></p>
								<p id="radio"><label for="user_pass">
									<input type="radio" name="review_type" value="1"  checked> Покупець<br>
								<input type="radio" name="review_type" value="2"> Працівник<br>
								<input type="radio" name="review_type" value="3"> Постачальник<br>
								</label></p>
								 <input id="per" name="per" type="hidden" value="1">
								<script>
									document.querySelector('#radio').onclick = function(e) {				
										
										console.log(e.target.value);
										$("#per").val(e.target.value);

									}
								</script>

								<p class="regtext" style="color: black; text-align: right;">(* обов'язкові поля)</p>
								<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зареєструватись"></p>
								<p class="regtext">Вже зареєстровані? <a href= "login.php">Введіть ім'я користувача</a>!</p>
							</form>
						</div>
					</div>
					<?php include("includes/footer.php"); ?>