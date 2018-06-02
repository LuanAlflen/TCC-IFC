<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../assets/css/main.css">
	<title>Formulario</title>
</head>
<body>



	<div class="container">
		<div class="form__top">
			<h2>Cadastro  <span>Local</span></h2>
		</div>		
		<form class="form__reg"  method="post"  action="?acao=cadastrar" enctype="multipart/form-data">
			<input class="input" type="file"  name="foto"     required>
			<input class="input" type="text"  name="nome"     placeholder="Nome"     required>
            <input class="input" type="email" name="email"    placeholder="Email"    required>
            <input class="input" type="text"  name="endereco" placeholder="Endereço" required>
            <input class="input" type="text"  name="telefone" placeholder="Telefone" required>
            <textarea rows="5" cols="40" maxlength="500" name="descricao" placeholder="Descrição..."></textarea>
                <select name="categoria" class="form-control"">
                    <?php foreach ($categorias as $categoria):?>
                        <option><?= $categoria->nome ?></option>
                    <?php endforeach ?>
                </select>
            <input class="input" value="<?= $_GET['id'] ?>" type="hidden" name="iduser" placeholder="Id_user" required>
			<div class="btn__form">
            	<input class="btn__submit" type="reset" value="Limpar">
            	<input class="btn__reset" type="submit" name="gravar" value="Salvar">  >
            </div>


		</form>
	</div>
	
</body>
</html>