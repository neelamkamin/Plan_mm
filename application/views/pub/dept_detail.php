<?php 
	include_once('header.php'); 
	//echo "<pre>";
	//print_r($dept_id); die();

?>

<!--TESTING CODE START HERE !-->
	<table border="1" class="table table-hover">
		<thead align="center">
			<tr style="color:green;">
			    <td><b>Sl._No.</td>
                <td><b>CATEGORY_of_SCHEME</td>
                <td><b>TOTAL_SCHEMES</b></td>
                <td><b>TOTAL_BUDGET_ESTIMATE (in Lakhs)</b></td>
		</thead>
		<tbody>

            <? if ( count($dept_id)): ?>
		<?php	$count = $this->uri->segment(4,0); ?>
          <?php foreach ($dept_id as $dd): ?>
		
			<tr align="center">
					<td> <?= ++$count ?> </td>
					<td><?= anchor ("user/dept_category/{$dd->category}/{$dd->user_id}",$dd->category) ?></td>	
					<td><b> <?= $dd->TOTAL ; ?> Nos </b></td>
					<td><b> Rs. <?= $dd->AMOUNT ; ?> Lakhs </b></td>					
		    </tr>
				
<?php endforeach; ?>
		</tbody>
	</table>
		<?= $this->pagination->create_links() ?>

	<br>
	<?php foreach ($dept_id as $dd): ?>
<?php 
echo "<b>NAME OF THE DEPT :-  </b>" . $dd->user_id ;
exit;
?>
<?php endforeach; ?>
	<br><br><br>

	

	
</div></td></tr></tbody></table></div></div></div></nav></body></html>







