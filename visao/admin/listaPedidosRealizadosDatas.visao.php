<div class="corpinho">     
    <div class="caixinha">
        <h3>listar Pedidos por Datas</h3>
<table class="table" border="1">
	<thead>
		<tr>
			<th>Data da Compra</th>
			<th>Total</th>
		</tr>
	</thead>
		<?php foreach ($admin as $data): ?>
			<tr>
                            <td><?=$data['datacompra']?></td>
                            <td><?=$data['total']?></td>
			</tr>
		<?php endforeach; ?>
</table>
    </div>
</div>
   