<div class="row">
	<div class="column w100">
		<h2 class="title">Adicionar cliente</h2>
	</div>
</div>

<form action="/add" method="POST">

	<div class="form-input">
		<div class="column w20">
			<label for="nome">Nome</label>
		</div>
		<div class="column w80">
			<input name="nome" id="nome" type="text">
		</div>
	</div>

	<div class="form-input">
		<div class="column w20">
			<label for="idade">Idade</label>
		</div>
		<div class="column w80">
			<input name="idade" id="idade" type="text">
		</div>
	</div>

	<div class="form-input">
		<div class="column w20">
			<label for="rg">RG</label>
		</div>
		<div class="column w80">
			<input name="rg" id="rg" type="text">
		</div>
	</div>

	<div class="form-input">
		<div class="column w20">
			<label for="endereco">Endereço</label>
		</div>
		<div class="column w80">
			<input name="endereco" id="endereco" type="text">
		</div>
	</div>

	<div class="form-input">
		<div class="column w20">
			<label for="cep">CEP</label>
		</div>
		<div class="column w80">
			<input name="cep" id="cep" type="text">
		</div>
	</div>

	<div class="form-input">
		<div class="column w100">
			<button type="submit">Adicionar</button>
		</div>
	</div>

</form>