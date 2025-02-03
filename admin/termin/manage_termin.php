<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM termin_list where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k=>$v){
            $$k= $v;
        }

        $qry_meta = $conn->query("SELECT i.* FROM termin_services i inner join doctors_list s on i.doctor_id = s.id inner join services_list b on i.service_id where i.termin_id = '{$id}'");
        $qry_meta2 = $conn->query("SELECT i.*,s.name,s.description FROM invoice_services i inner join services_list s on i.service_id = s.id where i.invoice_id = '{$id}'");
    }
}
?>
<style>
	img#cimg{
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
        <h5 class="card-title"><?php echo isset($id) ? "Ndrysho detajet e klientit - ".$doctor_code : 'Shto nje termin te ri' ?></h5>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="" id="termin-form">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="col-md-12">
                    <fieldset class="border-bottom border-info">
                        <legend class="text-info">Informatat personale</legend>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="client_id" class="control-label text-info">Klienti</label>
                                <select name="client_id" id="client_id" class="custom-select custom-select-sm rounded-0 select2" data-placeholder="Zgjedh klientin" required>
                                    <option <?php echo !isset($client_id) ? "selected" : '' ?> disabled></option>
                                    <?php 
                                    $client_qry = $conn->query("SELECT * FROM client_list where `status` = 1 ".(isset($client_id) && $client_id > 0 ? " OR id = '{$client_id}'":"")." order by fullname asc ");
                                    while($row = $client_qry->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($client_id) && $client_id == $row['id'] ? "selected" : '' ?>><?php echo $row['client_code'].' - '.$row['fullname'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="doctors_id" class="control-label text-info">Doktori</label>
                                <select name="doctors_id" id="doctors_id" class="custom-select custom-select-sm rounded-0 select2" data-placeholder="Zgjedh doktorin" required>
                                    <option <?php echo !isset($doctors_id) ? "selected" : '' ?> disabled></option>
                                    <?php 
                                    $doctor_qry = $conn->query("SELECT * FROM doctors_list where `status` = 1 ".(isset($doctors_id) && $doctors_id > 0 ? " OR id = '{$doctors_id}'":"")." order by fullname asc ");
                                    while($row = $doctor_qry->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($doctors_id) && $doctors_id == $row['id'] ? "selected" : '' ?>><?php echo $row['doctor_code'].' - '.$row['fullname'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                </div>
                                <div class="form-group col-sm-6">
                                <label for="service_id" class="control-label text-info">Sherbimi</label>
                                <select name="service_id" id="service_id" class="custom-select custom-select-sm rounded-0 select2" data-placeholder="Zgjedh sherbimin" required>
                                    <option <?php echo !isset($service_id) ? "selected" : '' ?> disabled></option>
                                    <?php 
                                    $services_qry = $conn->query("SELECT * FROM services_list where `status` = 1 ".(isset($service_id) && $service_id > 0 ? " OR id = '{$service_id}'":"")." order by name asc ");
                                    while($row = $services_qry->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($service_id) && $service_id == $row['id'] ? "selected" : '' ?>><?php echo $row['name']?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                                <div class="form-group col-sm-4">
                                <label for="date_created" class="control-label text-info">Koha e terminit</label>
                                <input type="time" class="form-control form-control-sm rounded-0" id="date_created" name="date_created" value="<?php echo isset($date_created) ? $date_created : '' ?>" required><br>
                                <label for="date_ofTermin" class="control-label text-info">Data e terminit</label>
                                <input type="date" class="form-control form-control-sm rounded-0" id="date_ofTermin" name="date_ofTermin" value="<?php echo isset($date_ofTermin) ? $date_ofTermin : ''?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <?php if(isset($status)): ?>
                            <div class="form-group col-md-4">
                                <label for="status" class="control-label text-info">Statusi</label>
                                <select name="status" id="status" class="custom-select selevt">
                                    <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Pranuar</option>
                                    <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Ne pritje</option>
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
                                <img src="<?php echo validate_image(isset($id) ? "uploads/termin-".$id.".png" :'')."?v=".(isset($date_updated) ? strtotime($date_updated) : "") ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                            </div>
                        </div>
                    </fieldset>-->
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer text-center">
        <button class="btn btn-flat btn-sn btn-primary" type="submit" form="termin-form">Ruaj</button>
        <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url."admin?page=termin" ?>">Anulo</a>
    </div>
</div>

<script>
    $(function(){
		$('.select2').select2({
			width:'resolve'
		})

        $('#termin-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_termin",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("U shtua me sukses",'success');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = _base_url_+"admin?page=termin/view_termin&id="+resp.id;
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
	        	$('#cimg').attr('src', e.target.result);
                _this.siblings('label').text(input.files[0].name)
	        }
	        reader.readAsDataURL(input.files[0]);
	    }else{
            $('#cimg').attr('src', "<?php echo validate_image('no-image-available.png') ?>");
            _this.siblings('label').text('Choose file')
        }
	}
</script>