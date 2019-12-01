<div class="corpinho">     
    <div class="caixinha">
        <h3>Listar Produtos</h3>
<table class="table" border="1">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Estoque</th>
		</tr>
	</thead>
		<?php foreach ($admin as $produto): ?>
			<tr>
                            <td><?=$produto['nome']?></td>
                            <td><?=$produto['estoque_maximo']?></td>
			</tr>
		<?php endforeach; ?>
</table>
    </div>
</div>
    