<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT i.*, c.fullname as fullnameC, d.fullname as fullnameD, b.name from `termin_list` i inner join client_list c on i.client_id = c.id  inner join doctors_list d on i.doctors_id = d.id inner join services_list b on i.service_id = b.id where i.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k=>$v){
            $$k= $v;
        }

        $qry_meta = $conn->query("SELECT i.*,s.name,s.description FROM termin_services i inner join services_list s on i.termin_id = s.id where i.termin_id = '{$id}'");
    }   
}
?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title">Detajet e Terminit</h5>
    </div>
    <div class="card-body">
        <div class="container-fluid" id="print_out">
            <style>
                @media print{
                    .bg-lightblue {
                        background-color: #3c8dbc !important;
                    }
                }
                body {
                -webkit-print-color-adjust: exact !important;
                }
            </style>
            <h3 class="text-info">Termini: <b><?php echo isset($doctor_code) ? $doctor_code :'' ?></b></h3>
            <fieldset class="border-bottom border-info">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="client_id" class="control-label text-info">Klienti</label>
                        <div><b><?php echo strtoupper($fullnameC) ?></b></div>
                    </div>
                </div>
            </fieldset>
                <fieldset class="border-bottom border-info">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="doctors_id" class="control-label text-info">Doktori</label>
                        <div><b><?php echo strtoupper($fullnameD) ?></b></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="service_id" class="control-label text-info">Sherbimi</label>
                        <div><b><?php echo strtoupper($name) ?></b></div>
                    </div>
                </div>
            </fieldset>
            </fieldset>
                <fieldset class="border-bottom border-info">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="termin_list" class="control-label text-info">Data</label>
                        <div><b><?php echo strtoupper($date_created) ?></b></div><br>
                        <div><b><?php echo strtoupper($date_ofTermin) ?></b></div>
                    </div>
                </div>
            </fieldset>
                <!-- <table class="table table-hover table-striped table-bordered" id="service-list">
                    <colgroup>
                        <col width="10%">
                        <col width="30%">
                        <col width="40%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr class="bg-lightblue text-light" style="background: #3c8dbc !important;">
                            <th class="px-2 py-2 text-center">#</th>
                            <th class="px-2 py-2 text-center">Sherbimi</th>
                            <th class="px-2 py-2 text-center">Pershkrimi</th>
                            <th class="px-2 py-2 text-center">Cmimi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $total = 0;
                        while($row = $qry_meta->fetch_assoc()):
                            $total += $row['price'];
                        ?>
                            <tr>
                                <td class="px-1 py-2 text-center align-middle"><?php echo $i++; ?></td>
                                <td class="px-1 py-2 align-middle service"><?php echo $row['name'] ?></td>
                                <td class="px-1 py-2 align-middle description"><?php echo $row['description'] ?></td>
                                <td class="px-1 py-2 text-right align-middle price"><?php echo $row['price'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-lightblue text-light disabled">
                            <th class="px-2 py-2 text-right" colspan="3">
                                Nentotali
                            </th>
                            <th class="px-2 py-2 text-right sub_total"><?php echo number_format($total,2) ?></th>
                        </tr>
                        <tr class="bg-lightblue text-light disabled">
                            <th class="px-2 py-2 text-right" colspan="3">
                                Zbritja (<?php echo isset($discount_perc) ? $discount_perc : 0 ?>%)
                            </th>
                            <th class="px-2 py-2 text-right discount"><?php echo isset($discount) ? number_format($discount,2) : 0 ?></th>
                        </tr>
                        <!--<tr class="bg-lightblue text-light disabled">
                            <th class="px-2 py-2 text-right" colspan="3">
                                Taksat <small><i>Inclusive</i></small>
                                (<?php echo isset($tax_perc) ? $tax_perc : 0 ?>%)
                            </th>
                            <th class="px-2 py-2 text-right tax"><?php echo isset($tax) ? number_format($tax,2) : 0 ?></th>
                        </tr>
                        <tr class="bg-lightblue text-light disabled">
                            <th class="px-2 py-2 text-right" colspan="3">
                                Totali
                            </th>
                            <th class="px-2 py-2 text-right grand_total"><?php echo isset($total) ? number_format($total,2) : 0 ?></th>
                        </tr>
                    </tfoot>
                </table> -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <!-- <label for="remarks" class="control-label text-info">Shenime</label>
                        <p><?php echo isset($remarks) ? $remarks : "N/A" ?></p> -->
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status" class="control-label text-info">Statusi i Pageses</label>
                        <div class="pl-4">
                            <?php if($status == 1): ?>
                                <span class="badge badge-pill badge-success">Paguar</span>
                            <?php else: ?>
                                <span class="badge badge-pill badge-primary">Ne pritje</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="card-footer text-center">
            <button class="btn btn-flat btn-sn btn-success" type="button" id="print"><i class="fa fa-print"></i> Printo</button>
            <a class="btn btn-flat btn-sn btn-primary" href="<?php echo base_url."admin?page=termin/manage_termin&id=".$id ?>"><i class="fa fa-edit"></i> Ndrysho</a>
            <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url."admin?page=termin" ?>">Prapa tek lista</a>
    </div>
</div>
<script>
    $(function(){
        $('#print').click(function(){
            start_loader()
            var _el = $('<div>')
            var _head = $('head').clone()
                _head.find('title').text("termin Details - Print View")
            var p = $('#print_out').clone()
            p.find('tr.text-light').removeClass("text-light")
            p.find('tr.bg-lightblue').removeClass("bg-lightblue")
            _el.append(_head)
            _el.append('<div class="d-flex justify-content-center">'+
                      '<div class="col-1 text-right">'+
                      '<img src="<?php echo validate_image($_settings->info('avatar-1.png')) ?>" width="65px" height="65px" />'+
                      '</div>'+
                      '<div class="col-10">'+
                      '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>'+
                      '<h4 class="text-center">termin</h4>'+
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
</script>