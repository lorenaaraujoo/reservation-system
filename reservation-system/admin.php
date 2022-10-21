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
				<li><a href="">Reservas Atuais</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
		</div>
	</header>

	<section class="agendamentos">
		<div class="center">

			<?php
				if(isset($_GET['excluir'])){
					$id = (int)$_GET['excluir'];
					$pdo->exec("DELETE FROM `tb_agendados` WHERE id = $id");
					echo '<div class="sucesso">Agendamento excluído com sucesso!</div>';
				}
				$info = $pdo->prepare("SELECT * FROM `tb_agendados`");
				$info->execute();
				$info = $info->fetchAll();
				foreach ($info as $key => $value) {
			?>
			<div class="box-single-horario">
				<div class="box-single-wraper">
					Nome: <?php echo $value['nome'] ?><br />
					Data e Horário: <?php echo date('d/m/Y H:i:s',strtotime($value['horario'])); ?>
					<br />
					<a href="?excluir=<?php echo $value['id']; ?>">Excluir</a>
				</div>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
	</section>
</body>
</html>