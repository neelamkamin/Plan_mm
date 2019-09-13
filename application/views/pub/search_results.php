<?php include_once('header.php'); ?>

<div class="container-fluid">
	<h3 style="color:blue;"> <b>Search Results</h3>
	<hr>
	<table class="table table-hover">
		<thead align="center">
			<tr style="color:green;">
				<td><b>Sl. No.</td>
				<td><b>NAME OF SCHEMES</td>	
				<td><b>BUDGET_ESTIMATE (in Lakhs)</b></td>
				<td><b>CATEGORY_OF_SCHEME</b></td>
				<td><b>CATEGORY_OF_FUND</b></td>
				<td><b>IMPLEMENTING DEPT</b></td>
				<td><b>FINANCIAL YEAR</b></td>
			</tr>
			</thead>
		<tbody align="center">
			<tr>
			<? if ( count($src_result)): ?>
		<?php	$count = $this->uri->segment(4,0); ?>
		<?php foreach( $src_result as $mm): ?>
				<td> ( <?= ++$count ?> ) </td>
				<td><?= anchor ("user/article/{$mm->id}",$mm->name_scheme) ?></td>
				
				<td> Rs. <?= $mm->budget_est; ?> Lakhs</td>
				<td> <?= $mm->category; ?> </td>
				<td> <?= $mm->fund_cat; ?> </td>	
				<td> <?= $mm->user_id; ?> </td>
				<td> <?= $mm->FY; ?> </td>
				
			</tr>

		<?php endforeach; ?>
			<? else: ?>
		<tr>
		</tr>

		<? endif; ?>
			</tr>
		</tbody>
	</table>

		<?= $this->pagination->create_links() ?>

</div></td></td></tr></thead></table></div></div>

<?php include_once('footer.php'); ?>

