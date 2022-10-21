<?php
	date_default_timezone_set('America/Sao_Paulo');
	$pdo = new PDO('mysql:host=localhost;dbname=sistema','root','');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Reserva</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<header>
		<div class="center">
		<div class="logo">
			<h2>Danki Code</h2>
		</div>

		<nav class="menu">
			<ul>
				<li><a href="">Reservas</a></li>
				<li><a href="">Sobre</a></li>
				<li><a href="">Contato</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
		</div>
	</header>

	<section class="reserva">
		<div class="center">
			<?php
				if(isset($_POST['acao'])){
					//Fazer uma reserva
					$nome = $_POST['nome'];
					$dataHora = $_POST['dataHora'];
					$date = DateTime::createFromFormat('d/m/Y H:i:s', $dataHora);
					$dataHora =  $date->format('Y-m-d H:i:s');
					$sql = $pdo->prepare("INSERT INTO `tb_agendados` VALUES (null,?,?)");
					$sql->execute(array($nome,$dataHora));
					echo '<div class="sucesso"> Horário agendado com sucesso! </div>';
				}
			?>

			<form method="post">
				<input type="text" name="nome" placeholder="Digite seu nome">
				<select name="dataHora">
					<?php
						for($i = 0; $i <= 23; $i++){
							$hora = $i;
							if($i < 10){
								$hora = '0'.$hora;
							}

							$hora.=':00:00';

							$verifica = date('Y-m-d').' '.$hora;
							$sql = $pdo->prepare("SELECT * FROM `tb_agendados` WHERE horario = '$verifica'");
							$sql->execute();

							if($sql->rowCount() == 0 && strtotime($verifica) > time()){
								$dataHora = date('d/m/Y').' '.$hora;
								echo '<option value="'.$dataHora.'">'.$dataHora.'</option>';
							}
						}
					?>

				</select>
				<input type="submit" name="acao" value="Enviar">
			</form>
		</div>
	</section>
</body>
</html>