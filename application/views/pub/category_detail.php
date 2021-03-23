<?php include_once('header.php'); ?>
<!------END !------->

<?php if($feedback = $this->session->flashdata('feedback')): 
		$feedback_class = $this->session->flashdata('feedback_class'); //**WORKS ONLY IF BOOTSTRAP.MIN.CSS WORK CORRECTLY
?>
    <div class="row">
    	<div class="col-lg-6 col-lg-offset-3">
    
        <div class="alert alert-success">
          <?= $feedback ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
	<table border="1" class="table table-hover">
		<thead align="center" style="color:blue;" bgcolor="white-gray">
			    <td><b>Sl.No</td>
			    <td><b>NAME_OF SCHEME</td>
				<td><b>BUDGET ESTIMATE (in Lakhs)</b></td>
				<td><b>FINANCIAL YEAR</b></td>
				<td><b>FUND TYPE</b></td>
				<td><b>IMPLEMENTING DEPT.</b></td>
		</thead>
		<tbody>

            <? if ( count($cat_id)): ?>
		<?php	$count = $this->uri->segment(4,0); ?>
          <?php foreach ($cat_id as $dd): ?>
		
			<tr align="center">
					<td> <?= ++$count ?> </td>
					<td> <?= $dd->name_scheme ?> </td>	
					<td> <b>Rs. <?= $dd->budget_est ; ?> Lakhs </b></td>
					<td> <?= $dd->FY ; ?>  </td>
					<td> <?= $dd->fund_cat ; ?>  </td>
					<td> <?= $dd->user_id ; ?> </td>
			</tr>
				
<?php endforeach; ?>
		</tbody>
	</table>
	<div class="pagination">
	    <?= $this->pagination->create_links(); ?>
	</div>
	<br>
	<?php foreach ($cat_id as $dd): ?>
<?php 
echo "SCHEME HEAD :-  <b>" . $dd->category . "</b>";
exit;
?>
<?php endforeach; ?>
	<br><br><br>

	

	
</div></td></tr></tbody></table></div></div></div></nav></body></html>


