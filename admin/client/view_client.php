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
<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title">Detajet e Klientit</h5>
    </div>
    <div class="card-body">
        <div class="container-fluid" id="print_out">
            <style>
                img#cimg{
                    height: 20vh;
                    width: 20vh;
                    object-fit: scale-down;
                    object-position: center center;
                }
                /* Add styles for the invoice image */
                #invoice-image {
                    width: 50%; /* Adjust the width as needed */
                    height: auto;
                    margin-bottom: 20px; /* Adjust the margin-bottom as needed */
                }
                .xray{
                    float: right;
                }
                .portrait-img{
                    width: 250px !important;
                    height: 250px !important;
                }
                .xray-img{
                    width: 450px !important;
                    height: 450px !important;
                }
                .rounded-pill{
                    background-color: #4bd9f8;
                }
            </style>
                        <img id="invoice-image" src="../uploads/teethNumbers.png" alt="Invoice Image" class="mx-auto d-block">
            <h3 class="text-info">Klienti: <b><?php echo isset($fullname) ? $fullname :'' ?></b></h3>
            
            <!-- //Display Portrait Pho -->
            <div class="row portrait">
                <div class="col-md-4">
                    <label for="">Portreti</label><br>
                    <img class="portrait-img" src="<?php echo validate_image(isset($id) ? "admin/images/client-".$id.".png" :'')."?v=".(isset($date_updated) ? strtotime($date_updated) : "") ?>" alt="Portrait Photo" class="img-fluid bg-dark-gradient" id="portrait_img">
                </div>
                <div class="col-md-4">
                    <label for="">Ortopani</label>
                    <img class="xray-img" src="<?php echo validate_image(isset($id) ? "admin/images/xray-".$id.".png" :'')."?v=".(isset($date_updated) ? strtotime($date_updated) : "") ?>" alt="X-Ray Photo" class="img-fluid bg-dark-gradient" id="xray_img">
                </div>
            </div>

            <!-- Display X-Ray Photo -->
            <!-- <div class="row xray">
                <div class="col-md-4">
                    <img class="xray-img" src="<?php echo validate_image(isset($id) ? "admin/images/xray-".$id.".png" :'')."?v=".(isset($date_updated) ? strtotime($date_updated) : "") ?>" alt="X-Ray Photo" class="img-fluid bg-dark-gradient" id="xray_img">
                </div>
            </div>  -->
            <div class="row">
                <div class="col-md-6">
                    <dl>
                        <dt class="text-info">Emri:</dt>
                        <dd class="fw-bold pl-3"><?php echo isset($fullname) ? $fullname : "" ?></dd>
                        <dt class="text-info">Gjinia:</dt>
                        <dd class="fw-bold pl-3"><?php echo isset($gender) ? $gender : "" ?></dd>
                        <dt class="text-info">Datelindja:</dt>
                        <dd class="fw-bold pl-3"><?php echo isset($dob) ? date("F d, Y",strtotime($dob)) : "" ?></dd>
                    </dl>
                    <div class="form-group col-md-6">
                        <label for="remarks" class="control-label text-info">Shenime</label>
                        <p><?php echo isset($remarks) ? $remarks : "N/A" ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    
                    <dl>
                        <dt class="text-info">Emaili:</dt>
                        <dd class="fw-bold pl-3"><?php echo isset($email) ? $email : "" ?></dd>
                        <dt class="text-info">Numri kontaktues:</dt>
                        <dd class="fw-bold pl-3"><?php echo isset($contact) ? $contact : "" ?></dd>
                        <dt class="text-info">Adresa:</dt>
                        <dd class="fw-bold pl-3"><?php echo isset($address) ? $address : "" ?></dd>
                        <dt class="text-info">Statusi:</dt>
                        <dd class="pl-3">
                            <?php if($status == 1): ?>
                                <span class="badge badge-info rounded-pill">Aktiv</span>
                                <?php endif; ?>
                                <?php if($status == 0): ?>
                                <span class="badge badge-danger rounded-pill">Joaktiv</span>
                            <?php endif; ?>
                            <?php if($status == 2): ?>
                                <span class="badge badge-success rounded-pill">Perfunduar</span>
                                <?php endif; ?>
                        </dd>
                    </dl>
                </div>
                <!-- <div class="col-md-4">
                    <dl>
                        <dt class="text-info">Seanca</dt>
                        <dd class="fw-bold pl-3"><?php echo isset($termin_number) ? $termin_number : "" ?></dd>
                    </dl>
                </div>
                <div class="col-md-4">
                    <dl>
                        <dt class="text-info">Data e Seances</dt>
                        <dd class="fw-bold pl-3"><?php echo isset($termin_date) ? $termin_date : "" ?></dd>
                    </dl>
                </div> -->
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
            <button class="btn btn-flat btn-sn btn-success" type="button" id="print"><i class="fa fa-print"></i> Printo</button>
            <!--<button class="btn btn-flat btn-sn btn-primary bg-lightblue" id="reset_password" type="button"><i class="fa fa-key"></i> Reset Password</button>-->
            <a class="btn btn-flat btn-sn btn-primary" href="<?php echo base_url."admin?page=client/manage_client&id=".$id ?>"><i class="fa fa-edit"></i> Ndrysho</a>
            <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url."admin?page=client" ?>">Prapa tek lista</a>
    </div>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <img src="" alt="Image Preview" class="img-fluid" id="modalImage">
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#reset_password').click(function(){
            _conf("Are you sure to reset the password of <b>Client - <?php echo $client_code ?></b>?",'reset_password')
        })
        $('#print').click(function(){
            start_loader()
            var _el = $('<div>')
            var _head = $('head').clone()
                _head.find('title').text("Detajet e Klientit - Print View")
                _head.append($('#libraries').clone())
            var p = $('#print_out').clone()
            p.find('tr.text-light').removeClass("text-light bg-navy")
            _el.append(_head)
            _el.append('<div class="d-flex justify-content-center">'+
                      '<div class="col-1 text-right">'+
                      '<img src="logo-1648796846.png" width="65px" height="65px" />'+
                      '</div>'+
                      '<div class="col-10">'+
                      '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>'+
                      '<h4 class="text-center">Detajet e Klientit</h4>'+
                      '</div>'+
                      '<div class="col-1 text-right">'+
                      '</div>'+
                      '</div><hr/>')
            _el.append(p.html())
            var nw = window.open("","","width=1200,height=900,left=250,location=no,titlebar=yes")
                     nw.document.write(_el.html())
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                            nw.close()
                            end_loader()
                         }, 200);
                     }, 500);
        })
    })
    function reset_password(){
        start_loader()
        $.ajax({
            url:_base_url_+"classes/Master.php?f=reset_password",
            method:'POST',
            data:{id:"<?php echo $id ?>"},
            dataType:'json',
            error:err=>{
                console.log(err)
                alert_toast("Ndodhi nje gabim",'error')
                end_loader()
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.reload()
                }else{
                    alert_toast(res.msg,'error')
                }
                end_loader()
            }
        })
    }

    //Modal images
    $(document).ready(function(){
        // Function to open a new window with the image
        function openFullScreenImage(imageSrc) {
            var newWindow = window.open('', '_blank', 'fullscreen=yes');
            newWindow.document.write('<html><head><title>Full Screen Image</title></head><body style="margin: 0; overflow: hidden;">');
            newWindow.document.write('<img src="' + imageSrc + '" alt="Full Screen Image" style="width: 100vw; height: 100vh; object-fit: contain;">');
            newWindow.document.write('</body></html>');
            newWindow.document.close();
        }

        // Click event for portrait image
        $('#portrait_img').on('click', function(){
            var portraitSrc = $(this).attr('src');
            openFullScreenImage(portraitSrc);
        });

        // Click event for x-ray image
        $('#xray_img').on('click', function(){
            var xraySrc = $(this).attr('src');
            openFullScreenImage(xraySrc);
        });
    });
</script>