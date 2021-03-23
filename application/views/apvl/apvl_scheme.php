<?php include_once 'header.php'; ?>

  <br>
<hr>
 
 <h2 style="color:green;" align="center">GOVERNMENT OF ARUNACHAL PRADESH </h2> <br>
   DEPARTMENT NAME :- <b> <?= $scheme->dept_id ?> </b>
 
 <hr>

<div class="container-fluid">
    <table class="table table-hover">
             <thead style="color:green;">
                  <tr>
                      <td><b>Project Name</b></td>
                      <td><b>Project Category</b></td>
                      <td><b>Budget Estimate (in Lakhs)</b></td>
                      <td><b>Fund Category</b></td>
                      <td><b>Financial Year</b></td>
                      <td><b>Previous Budget Estimate</b></td>
                      <td><b>Previous Revised Estimate</b></td>

                  </tr>
              </thead>
        <tbody>
            <tr>
                <? if ( count($scheme)): ?>
            
                 <td><b> <?= $scheme->name_scheme ?></b> |</td>
                 <td> <?= $scheme->category ?> |</td>
                 <td><b> Rs. <?= $scheme->budget_est; ?> (in Lakhs) |</b></td>
                 <td> <?= $scheme->fund_cat ?> |</td>
                 <td> <?= $scheme->FY ?> |</td>
                 <td>Rs. <?= $scheme->pre_budget_est ?> (in Lakhs) |</td>
                 <td>Rs. <?= $scheme->pre_revised_est ?> (in Lakhs) |</td>
           </tr>
     

                <? endif; ?>
            </tr>
        </tbody>
    </table>

<hr>
<?php 
    echo form_open("DeptAdmin/approve/{$scheme->id}",['class'=>'form-horizontal']); 
?>

    <input type="hidden" name="status" value="1">

<div class="container">
    
  <div class="col-md-4">
    <h2 style="color:red;" align="center">Please Check Properly Before Approving </h2> 
  </div>
  <div class="col-md-6">
      <button class="btn btn-default" style="float:center;">
          <a href="<?php echo site_url("DeptAdmin") ?>">Cancel</a>
      </button>
      <input type="submit" value="APPROVE" class="btn btn-danger">
  </div>
</div>  
</form>
