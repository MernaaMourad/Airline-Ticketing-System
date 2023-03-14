<?php echo $_GET['count']?>
<?php for($i = 0; $i < $_GET['count']; $i++ ): ?>
<hr>
<div class="row">
	<div class="col-md-6">
		<label class="control-label">Name</label>
		<input type="text" name="name[]" class="form-control">
	</div>
	<div class="col-md-6">
		<label class="control-label">Contact Number</label>
		<input type="text" name="contact[]" class="form-control">
	</div>

	<div class="col-md-6">
		<label class="control-label">Package_weight</label>
		<input type="text" name="Package_weight[]" class="form-control">
	</div>

	<div class="col-md-2">
		<label class="control-label">Package_height</label>
		<input type="text" name="Package_height[]" class="form-control">
	</div>
	
	<div class="col-md-12">
		<label class="control-label">Package_width </label>
		<input type="text" name="Package_width[]" class="form-control">
	</div>

	<div class="form-group">
		<label for="gender" class="control-label">Gender:
            (M default)</label>
				</div>
			<div class="form-group">
					<?php
        if (!empty($_GET['gender'])) {
                $selected = $_GET['gender'];
            } else {
                 $selected = 'M';
                }
                ?>
                <label>
                    <input type="radio" name="gender" value="M"/> M
                </label>
                <label>
                            <input type="radio" name="gender" value="F"/> F
                        </label></br>
						</div>



</div>

<div class="row">
<div class="form-group col-md-12">
	<label class="control-label">Address</label>
	<textarea name="address[]" id="" cols="30" rows="2" class="form-control"></textarea>
</div>
</div>

<?php endfor; ?>