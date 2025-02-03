<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM doctors_list where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k=>$v){
            $$k= $v;
        }

        $qry_meta = $conn->query("SELECT * FROM doctor_meta where doctor_id = '{$id}'");
        while($row = $qry_meta->fetch_assoc()){
            if(!isset(${$row['meta_field']}))
            ${$row['meta_field']} = $row['meta_value'];
        }
    }
}
?>
<style>
	img#dimg{
		height: 15vh;
		width: 15vh;
		object-fit: scale-down;
		object-position: center center;
		border-radius: 100% 100%;
	}
    .select2-container--default .select2-selection--single{
        border-radius:0;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title"><?php echo isset($id) ? "Ndrysho detajet e doktorit - ".$doctor_code : 'Shto nje klient te ri' ?></h5>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="" id="doctor-form">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="col-md-12">
                    <fieldset class="border-bottom border-info">
                        <legend class="text-info">Informatat personale</legend>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="firstname" class="control-label text-info">Emri</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="firstname" name="firstname" value="<?php echo isset($firstname) ? $firstname : '' ?>" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="lastname" class="control-label text-info">Mbiemri</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="lastname" name="lastname" value="<?php echo isset($lastname) ? $lastname : '' ?>" required>
                            </div>
                            <!--<div class="form-group col-sm-4">
                                <label for="middlename" class="control-label text-info">Middle Name</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="middlename" name="middlename" value="<?php echo isset($middlename) ? $middlename : '' ?>" placeholder="optional">
                            </div>-->
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="gender" class="control-label text-info">Gjinia</label>
                                <select name="gender" id="gender" class="custom-select custom-select-sm rounded-0" required>
                                    <option <?php echo isset($gender) && $gender == 'Male' ? "selected" : '' ?>>Mashkull</option>
                                    <option <?php echo isset($gender) && $gender == 'Female' ? "selected" : '' ?>>Femer</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="dob" class="control-label text-info">Datelindja</label>
                                <input type="date" class="form-control form-control-sm rounded-0" id="dob" name="dob" value="<?php echo isset($dob) ? $dob : '' ?>" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="contact" class="control-label text-info">Numri kontaktues</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="contact" name="contact" value="<?php echo isset($contact) ? $contact : '' ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="address" class="control-label text-info">Adresa</label>
                                <textarea type="text" class="form-control form-control-sm rounded-0" id="address" name="address"  placeholder="Rruga, Qyteti, Shteti"><?php echo isset($address) ? $address : '' ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="email" class="control-label text-info">Emaili</label>
                                <input type="email" class="form-control form-control-sm rounded-0" id="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" >
                            </div>
                            <?php if(isset($status)): ?>
                            <div class="form-group col-md-4">
                                <label for="status" class="control-label text-info">Statusi</label>
                                <select name="status" id="status" class="custom-select selevt">
                                    <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Aktiv</option>
                                    <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Joaktiv</option>
                                </select>
                            </div>
                            <?php endif; ?>
                        </div>
                    </fieldset>

                    <!--<fieldset class="border-bottom border-info">
                        <legend class="text-info">Fotoja e klientit</legend>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <div class="custom-file rounded-0">
                                    <input type="file" class="custom-file-input rounded-0" id="avatar" name="avatar" onchange="displayImg(this,$(this))">
                                    <label class="custom-file-label rounded-0" for="avatar">Zgjedh</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-4 text-center">
                                <img src="<?php echo validate_image(isset($id) ? "uploads/client-".$id.".png" :'')."?v=".(isset($date_updated) ? strtotime($date_updated) : "") ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                            </div>
                        </div>
                    </fieldset>-->
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer text-center">
        <button class="btn btn-flat btn-sn btn-primary" type="submit" form="doctor-form">Ruaj</button>
        <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url."admin?page=doctor" ?>">Anulo</a>
    </div>
</div>
<script>
    $(function(){
		$('.select2').select2({
			width:'resolve'
		})

        $('#doctor-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_doctor",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("Te dhenat u perditesuan me sukses",'success');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = _base_url_+"admin?page=doctor/view_doctor&id="+resp.id;
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
						alert_toast("Ndodhi nje gabim",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#dimg').attr('src', e.target.result);
                _this.siblings('label').text(input.files[0].name)
	        }
	        reader.readAsDataURL(input.files[0]);
	    }else{
            $('#dimg').attr('src', "<?php echo validate_image('no-image-available.png') ?>");
            _this.siblings('label').text('Choose file')
        }
	}
</script>