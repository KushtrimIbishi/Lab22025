<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT i.*,c.fullname FROM invoice_list i inner join client_list c on i.client_id = c.id where i.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k=>$v){
            $$k= $v;
        }

        $qry_meta = $conn->query("SELECT i.*,s.name,s.description FROM invoice_services i inner join services_list s on i.service_id = s.id where i.invoice_id = '{$id}'");
        
        // Fetch the paid and owed amounts
        $paid_amount = $conn->query("SELECT COALESCE(SUM(amount_paid), 0) as total_paid FROM invoice_list WHERE id = '{$id}'")->fetch_assoc()['total_paid'];
        $owed_amount = $total_amount - $paid_amount;
    }
}
?>

<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title">Detajet e fatures</h5>
    </div>
    <div class="card-body">
        <div class="container-fluid" id="print_out">
        <style>
                @media print {
                    .bg-lightblue {
                        background-color: #3c8dbc !important;
                    }
                    
                    body {
                        -webkit-print-color-adjust: exact !important;
                    }

                    .col-md-6 {
                        float: left;
                        width: 48%;
                    }

                    p {
                        text-align: left;
                    }

                    hr {
                        display: none;
                    }
                    #nenshkrimi{
                        margin-top: 60px; /* Adjust the value as needed */
                    }

                    /* Add styles for the invoice image */
                    #invoice-image {
                        width: 40%;
                        height: auto;
                        margin-bottom: 20px; /* Adjust the margin-bottom as needed */
                    }
                }
                                    /* Add styles for the invoice image */
                #invoice-image {
                    width: 50%;
                    height: auto;
                    margin-bottom: 20px; /* Adjust the margin-bottom as needed */
                }
            </style>
            <img id="invoice-image" src="../uploads/teethNumbers.png" alt="Invoice Image" class="mx-auto d-block">
            <h3 class="text-info">Fatura: <b><?php echo isset($invoice_code) ? $invoice_code :'' ?></b></h3>
            <fieldset class="border-bottom border-info">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="client_id" class="control-label text-info">Klienti</label>
                        <div><b><?php echo strtoupper($fullname) ?></b></div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border-bottom border-info">
                <legend>Sherbimet</legend>
                <table class="table table-hover table-striped table-bordered" id="service-list">
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
                                Totali
                            </th>
                            <th class="px-2 py-2 text-right grand_total"><?php echo isset($total) ? number_format($total,2) : 0 ?></th>
                        </tr>
                    </tfoot>
                </table>
                <!-- <div style="justify-content: center;" class="row">
                            <div class="form-group">
                                <label for="terminStart" class="control-label text-info">Fillimi i seancave:  </label>
                                <input style="pointer-events: none" type="text" name="date_start" value="<?php echo isset($date_start) ? $date_start : 0 ?>">
                                <!-- <br> 
                                <label for="terminEnd" class="control-label text-info">Mbarimi i Seancave:</label>
                                <input style="pointer-events: none" type="text" name="date_end" placeholder="Data"  value="<?php echo isset($date_end) ? $date_end : 0 ?>">
                            </div>
                        </div> -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="amount_paid" class="control-label text-info">Shuma e paguar</label>
                        <p><?php echo number_format($paid_amount, 2) ?></p>
                        <label for="remarks" class="control-label text-info">Shenime</label>
                        <textarea name="remarks" id="remarks" class="form-control rounded-0" rows="3" style="resize:none" readonly><?php echo isset($remarks) ? $remarks : "" ?></textarea>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="amount_due" class="control-label text-info">Mbetja</label>
                        <p><?php echo number_format($owed_amount, 2) ?></p>
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
                <div class="row">
                    <div class="col-md-6" id="nenshkrimi">
                        <p>Nenshkrimi dhe vula _________________________________</p>
                    </div>
                    <div class="col-md-6" id="nenshkrimi">
                        <p style="text-align: right">Nenshkrimi i klientit ___________________________________</p>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="card-footer text-center">
        <button class="btn btn-flat btn-sn btn-success" type="button" id="print"><i class="fa fa-print"></i> Printo</button>
        <a class="btn btn-flat btn-sn btn-primary" href="<?php echo base_url."admin?page=invoice/manage_invoice&id=".$id ?>"><i class="fa fa-edit"></i> Ndrysho</a>
        <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url."admin?page=invoice" ?>">Prapa tek lista</a>
    </div>
</div>

<script>
    $(function(){
        $('#print').click(function(){
            start_loader()
            var _el = $('<div>')
            var _head = $('head').clone()
            _head.find('title').text("Invoice Details - Print View")
            var p = $('#print_out').clone()
            p.find('tr.text-light').removeClass("text-light")
            p.find('tr.bg-lightblue').removeClass("bg-lightblue")
            _el.append(_head)
            _el.append('<div class="d-flex justify-content-center">'+
                      '<div class="col-1 text-right">'+
                      '<img src="<?php echo validate_image($_settings->info('cover-163609763800001.png')) ?>" width="65px" height="65px" />'+
                      '</div>'+
                      '<div class="col-10">'+
                      '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>'+
                      '<h4 class="text-center">Invoice</h4>'+
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
