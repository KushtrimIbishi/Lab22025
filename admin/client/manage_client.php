<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM client_list where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k=>$v){
            $$k= $v;
        }

        $qry_meta = $conn->query("SELECT * FROM client_meta where client_id = '{$id}'");
        while($row = $qry_meta->fetch_assoc()){
            if(!isset(${$row['meta_field']}))
            ${$row['meta_field']} = $row['meta_value'];
        }
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
        <h5 class="card-title"><?php echo isset($id) ? "Ndrysho detajet e klientit - ".$client_code : 'Shto nje klient te ri' ?></h5>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="" id="client-form">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="col-md-12">
                    <fieldset class="border-bottom border-info">
                        <legend class="text-info">Informatat personale</legend>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="firstname" class="control-label text-info">Emri</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="firstname" name="firstname" value="<?php echo isset($firstname) ? $firstname : '' ?>">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="lastname" class="control-label text-info">Mbiemri</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="lastname" name="lastname" value="<?php echo isset($lastname) ? $lastname : '' ?>">
                            </div>
                            <!--<div class="form-group col-sm-4">
                                <label for="middlename" class="control-label text-info">Middle Name</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="middlename" name="middlename" value="<?php echo isset($middlename) ? $middlename : '' ?>" placeholder="optional">
                            </div>-->
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="gender" class="control-label text-info">Gjinia</label>
                                <select name="gender" id="gender" class="custom-select custom-select-sm rounded-0">
                                    <option <?php echo isset($gender) && $gender == 'Male' ? "selected" : '' ?>>Mashkull</option>
                                    <option <?php echo isset($gender) && $gender == 'Female' ? "selected" : '' ?>>Femer</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="dob" class="control-label text-info">Datelindja</label>
                                <input type="date" class="form-control form-control-sm rounded-0" id="dob" name="dob" value="<?php echo isset($dob) ? $dob : '' ?>" >
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="contact" class="control-label text-info">Numri kontaktues</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="contact" name="contact" value="<?php echo isset($contact) ? $contact : '' ?>">
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
                                    <option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Perfunduar</option>
                                </select>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- <div class="row">
                            <div class="form-group col-sm-2" style="margin-left:80px;">
                                <label for="seanca_name1" class="control-label text-info">Seanca 1</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name1" name="seanca_name1" value="<?php echo isset($seanca_name1) ? $seanca_name1 : '' ?>">
                          
                                <label for="seanca_name2" class="control-label text-info">Seanca 2</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name2" name="seanca_name2" value="<?php echo isset($seanca_name2) ? $seanca_name2 : '' ?>">
                        
                                <label for="seanca_name3" class="control-label text-info">Seanca 3</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name3" name="seanca_name3" value="<?php echo isset($seanca_name3) ? $seanca_name3 : '' ?>">
                         
                                <label for="seanca_name4" class="control-label text-info">Seanca 4</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name4" name="seanca_name4" value="<?php echo isset($seanca_name4) ? $seanca_name4 : '' ?>">
                       
                                <label for="seanca_name5" class="control-label text-info">Seanca 5</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name5" name="seanca_name5" value="<?php echo isset($seanca_name5) ? $seanca_name5 : '' ?>">
                         
                                <label for="seanca_name6" class="control-label text-info">Seanca 6</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name6" name="seanca_name6" value="<?php echo isset($seanca_name6) ? $seanca_name6 : '' ?>">
                            </div>

                            <div class="form-group col-sm-2">
                                <label for="seanca_date1" class="control-label text-info">Data e Seances 1</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date1" name="seanca_date1" value="<?php echo isset($seanca_date1) ? $seanca_date1 : '' ?>">
                          
                                <label for="seanca_date2" class="control-label text-info">Data e Seances 2</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date2" name="seanca_date2" value="<?php echo isset($seanca_date2) ? $seanca_date2 : '' ?>">
                        
                                <label for="seanca_date3" class="control-label text-info">Data e Seances 3</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date3" name="seanca_date3" value="<?php echo isset($seanca_date3) ? $seanca_date3 : '' ?>">
                         
                                <label for="seanca_date4" class="control-label text-info">Data e Seances 4</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date4" name="seanca_date4" value="<?php echo isset($seanca_date4) ? $seanca_date4 : '' ?>">
                       
                                <label for="seanca_date5" class="control-label text-info">Data e Seances 5</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date5" name="seanca_date5" value="<?php echo isset($seanca_date5) ? $seanca_date5 : '' ?>">
                         
                                <label for="seanca_date6" class="control-label text-info">Data e Seances 6</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date6" name="seanca_date6" value="<?php echo isset($seanca_date6) ? $seanca_date6 : '' ?>">
                            </div>

                            <div class="form-group col-sm-2" style="margin-left:140px;">
                                <label for="seanca_name7" class="control-label text-info">Seanca 7</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name7" name="seanca_name7" value="<?php echo isset($seanca_name7) ? $seanca_name7 : '' ?>">
                          
                                <label for="seanca_name8" class="control-label text-info">Seanca 8</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name8" name="seanca_name8" value="<?php echo isset($seanca_name8) ? $seanca_name8 : '' ?>">
                        
                                <label for="seanca_name9" class="control-label text-info">Seanca 9</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name9" name="seanca_name9" value="<?php echo isset($seanca_name9) ? $seanca_name9 : '' ?>">
                         
                                <label for="seanca_name10" class="control-label text-info">Seanca 10</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name10" name="seanca_name10" value="<?php echo isset($seanca_name10) ? $seanca_name10 : '' ?>">
                       
                                <label for="seanca_name11" class="control-label text-info">Seanca 11</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name11" name="seanca_name11" value="<?php echo isset($seanca_name11) ? $seanca_name11 : '' ?>">
                         
                                <label for="seanca_name12" class="control-label text-info">Seanca 12</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_name12" name="seanca_name12" value="<?php echo isset($seanca_name12) ? $seanca_name12 : '' ?>">
                            </div>

                            <div class="form-group col-sm-2">
                                <label for="seanca_date7" class="control-label text-info">Data e Seances 7</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date7" name="seanca_date7" value="<?php echo isset($seanca_date7) ? $seanca_date7 : '' ?>">
                          
                                <label for="seanca_date8" class="control-label text-info">Data e Seances 8</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date8" name="seanca_date8" value="<?php echo isset($seanca_date8) ? $seanca_date8 : '' ?>">
                        
                                <label for="seanca_date9" class="control-label text-info">Data e Seances 9</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date9" name="seanca_date9" value="<?php echo isset($seanca_date9) ? $seanca_date9 : '' ?>">
                         
                                <label for="seanca_date10" class="control-label text-info">Data e Seances 10</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date10" name="seanca_date10" value="<?php echo isset($seanca_date10) ? $seanca_date10 : '' ?>">
                       
                                <label for="seanca_date11" class="control-label text-info">Data e Seances 11</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date11" name="seanca_date11" value="<?php echo isset($seanca_date11) ? $seanca_date11 : '' ?>">
                         
                                <label for="seanca_date12" class="control-label text-info">Data e Seances 12</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="seanca_date12" name="seanca_date12" value="<?php echo isset($seanca_date12) ? $seanca_date12 : '' ?>">
                            </div>
                        </div> -->
                    </fieldset>
                    <div class="row">
                        <label for="remarks" class="control-label text-info">Shenime</label>
                        <textarea name="remarks" id="remarks" class="form-control rounded-0" rows="3" style="resize:none"><?php echo isset($remarks) ? $remarks : "" ?></textarea>
                    </div>

                    <fieldset class="border-bottom border-info">
                        <legend class="text-info">Fotoja e klientit</legend>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <div class="custom-file rounded-0">
                                    <input type="file" class="custom-file-input rounded-0" id="avatar" name="avatar" onchange="displayImg(this, $(this))">
                                    <label class="custom-file-label rounded-0" for="avatar">Zgjedh</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-4 text-center">
                                <img src="<?php echo validate_image(isset($id) ? "admin/images/client-".$id.".png" :'') . "?v=" . (isset($date_updated) ? strtotime($date_updated) : "") ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border-bottom border-info">
                        <legend class="text-info">Rentgeni</legend>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <div class="custom-file rounded-0">
                                    <input type="file" class="custom-file-input rounded-0" id="xray" name="xray" onchange="displayImg2(this, $(this))">
                                    <label class="custom-file-label rounded-0" for="xray">Zgjedh</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-4 text-center">
                                <img src="<?php echo validate_image(isset($id) ? "admin/images/xray-".$id.".png" :'') . "?v=" . (isset($date_updated) ? strtotime($date_updated) : "") ?>" alt="" id="xray-img" class="img-fluid img-thumbnail">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer text-center">
        <button class="btn btn-flat btn-sn btn-primary" type="submit" form="client-form">Ruaj</button>
        <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url."admin?page=client" ?>">Anulo</a>
    </div>
</div>
<script>
    $(function(){
		$('.select2').select2({
			width:'resolve'
		})

        $('#client-form').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
			start_loader();
            $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_client",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err);
                alert_toast("Te dhenat u perditesuan me sukses",'success');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.href = _base_url_ + "admin?page=client&view_client&id=" + resp.id;
                } else if (resp.status == 'failed' && !!resp.msg) {
                    var el = $('<div>')
                    el.addClass("alert alert-danger err-msg").text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                    end_loader()
                } else {
                    alert_toast("An error occurred", 'error');
                    end_loader();
                    console.log(resp);
                }
            }
        });
    });
	})
	function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
                _this.siblings('label').text(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#cimg').attr('src', "<?php echo validate_image('no-image-available.png') ?>");
            _this.siblings('label').text('Choose file');
        }
    }

    function displayImg2(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#xray-img').attr('src', e.target.result);
                _this.siblings('label').text(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#xray-img').attr('src', "<?php echo validate_image('no-image-available1.png') ?>");
            _this.siblings('label').text('Choose file');
        }
    }
</script>