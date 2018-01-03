<?php

	require "db.php";

	$data = $_POST;
	if(isset($data['do_signup']))
	{
		$errors = array();
		if(trim($data['login']) == '')
		{
			$errors[] = 'Имя не введено!';
		}

		if(trim($data['email']) == '')
		{
			$errors[] = 'Введите почту!';
		}

		if($data['password'] == '')
		{
			$errors[] = 'Введите пароль!';
		}

		if($data['password_2'] != $data['password'])
		{
			$errors[] = 'Пароли не совпадают';
		}

		if(R::count('users', "email = ?", array($data['email'])) > 0)
		{
			$errors[] = "Пользователь с такой почтой уже существует!";
		}

		if(empty($errors))
		{
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			R::store($user);
			echo '<div style="color: green;">Вы успешно зарегестрировались!</div><hr>';
		}
		else
		{
			echo '<div style="color: red;">.array_shift($errors).</div><hr>';
		}
	}
?>


<form action="/signup.php" method="POST">
	
	<p>
		<p><strong>Ваше имя</strong>:</p>
		<input type="text" name="login" value="<?php echo @$data ['login']?>">
	</p>

	<p>
		<p><strong>Ваше почта</strong>:</p>
		<input type="email" name="email" value="<?php echo @$data ['email']?>">
	</p>

	<p>
		<p><strong>Ваш пароль</strong>:</p>
		<input type="password" name="password" value="<?php echo @$data ['password']?>">
	</p>

	<p>
		<p><strong>Проверка пароля</strong>:</p>
		<input type="password" name="password_2" value="<?php echo @$data ['password_2']?>">
	</p>

	<p>
		<button type="submit" name="do_signup">Зарегестрироватся</button>
	</p>

</form>