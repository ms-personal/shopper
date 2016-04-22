<div class="row">
	<div class="column w100">
		<h2 class="title">Lista de clientes</h2>
	</div>
</div>

<div class="row">
	<div class="column w100">

		<?php $clientes = $this->llist();?>


		<table>
			<thead>
				<tr>
					<th>Nome</th>
					<th>Idade</th>
					<th>RG</th>
					<th>Endereço</th>
					<th>CEP</th>
					<th>Criação</th>
					<th>Última alteração</th>
					<th>Opções</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($clientes as $cliente) { ?>

					<tr>
						<td><?php echo $cliente['nome'];?></td>
						<td><?php echo $cliente['idade'];?></td>
						<td><?php echo $cliente['rg'];?></td>
						<td><?php echo $cliente['endereco'];?></td>
						<td><?php echo $cliente['cep'];?></td>
						<td><?php echo date('d/m/Y H:i', strtotime($cliente['criacao']));?></td>
						<td><?php echo date('d/m/Y H:i', strtotime($cliente['ultima_alteracao']));?></td>
						<td>
							<a href="/edit?id=<?php echo $cliente['idCliente'];?>">Editar</a> /
							<a href="/del?id=<?php echo $cliente['idCliente'];?>">Excluir</a>
						</td>
					</tr>

				<?php } ?>
			</tbody>
		</table>


	</div>
</div>