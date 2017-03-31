<tfoot>
	<?php $total = 0; foreach ($detalle_mov as $key) { 

		$total = ($key->tipo_mov == 'ingreso')?$total + $key->monto:$total - $key->monto;
		} ?>
	<tr>
		<td colspan="4">Total</td>
		<td id="total_caja"><?=$total;?></td>
	</tr>
</tfoot>
<tbody>
	<?php $i = 1; foreach ($detalle_mov as $key) { ?>
	<tr>
		<td><?=$i;?></td>
		<td><?=$key->fecha;?></td>
		<td><?=$key->tipo_mov;?></td>
		<td><?=$key->tipo_doc;?></td>
		<td><?=$key->num_doc?></td>
		<td><?=$key->monto;?></td>
	</tr>
	<?php } ?>
</tbody>