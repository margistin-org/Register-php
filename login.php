<?php

	require "db.php";

	$data = $_POST;
	$errors = array();
	if(isset($data['do_login']))
	{
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if($user)
		{
			if(md5($data['password'], $user->password))
			{
				$_SESSION['logged_user'] = $user;
				echo '<div style="color: green;">Вы успешно авторизовались!</br><a href="/">Перейти на шлавную страницу</a></div><hr>';
			}
			else
			{
				$errors[] = 'Пароль неверный!';
			}
		}
		else
		{
			$errors[] = "Такого пользователя не существует!";
		}

		if( ! empty($errors))
		{
			echo '<div style="color: red;">.array_shift($errors).</div><hr>';
		}
	}

?>

<form action="login.php" method="POST">

	<p>
		<p><strong>Ваше имя</strong>:</p>
		<input type="text" name="login" value="<?php echo @$data ['login']?>">
	</p>

	<p>
		<p><strong>Ваш пароль</strong>:</p>
		<input type="password" name="password" value="<?php echo @$data ['login']?>">
	</p>

	<p>
		<button type="submit" name="do_login">Войти</button>
	</p>


</form>