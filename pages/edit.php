<?php

	$cliente = $this->edit();

?>


<div class="row">
	<div class="column w100">
		<h2 class="title">Editar <?php echo $cliente['nome'];?></h2>
	</div>
</div>

<form action="/edit?id=<?php echo $_GET['id'];?>" method="POST">

	<input type="hidden" name="idCliente" value="<?php echo $cliente['idCliente'];?>">

	<div class="form-input">
		<div class="column w20">
			<label for="nome">Nome</label>
		</div>
		<div class="column w80">
			<input name="nome" id="nome" type="text" value="<?php echo $cliente['nome'];?>">
		</div>
	</div>

	<div class="form-input">
		<div class="column w20">
			<label for="idade">Idade</label>
		</div>
		<div class="column w80">
			<input name="idade" id="idade" type="text" value="<?php echo $cliente['idade'];?>">
		</div>
	</div>

	<div class="form-input">
		<div class="column w20">
			<label for="rg">RG</label>
		</div>
		<div class="column w80">
			<input name="rg" id="rg" type="text" value="<?php echo $cliente['rg'];?>">
		</div>
	</div>

	<div class="form-input">
		<div class="column w20">
			<label for="endereco">Endereço</label>
		</div>
		<div class="column w80">
			<input name="endereco" id="endereco" type="text" value="<?php echo $cliente['endereco'];?>">
		</div>
	</div>

	<div class="form-input">
		<div class="column w20">
			<label for="cep">CEP</label>
		</div>
		<div class="column w80">
			<input name="cep" id="cep" type="text" value="<?php echo $cliente['cep'];?>">
		</div>
	</div>

	<div class="form-input">
		<div class="column w100">
			<button type="submit">Salvar</button>
		</div>
	</div>

</form>