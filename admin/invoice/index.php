<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
	.btn-primary{
        background-color: #4bd9f8 !important;
		border-color: #4bd9f8;
		color: black;
    }
	.page-item.active{
		background-color: #4bd9f8;
		border-color: #4bd9f8;
	}
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Lista e faturave</h3>
		<div class="card-tools">
			<a href="<?php echo base_url."admin?page=invoice/manage_invoice" ?>" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Shto nje fature te re</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="25%">
					<col width="10%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th class="text-center">Data</th>
						<th class="text-center">Fillimi i Seancave</th>
						<th class="text-center">Mbarimi i Seancave</th>
						<th class="text-center">Klienti</th>
						<th class="text-center">Shuma totale</th>
						<th class="text-center">Statusi</th>
						<th class="text-center">Veprimi</th>
					</tr>

				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT i.*,c.fullname from `invoice_list` i inner join client_list c on i.client_id = c.id order by unix_timestamp(i.date_created) desc");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="text-center"><?php echo date("d-m Y",strtotime($row['date_created'])) ?></td>
							<td class="text-center"><?php echo $row['date_start'] ?></td>
							<td class="text-center"><?php echo $row['date_end'] ?></td>
							<td class="text-center"><?php echo strtoupper($row['fullname']) ?></td>
							<td class="text-center"><?php echo number_format($row['total_amount'],2) ?></td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success rounded-pill" style="background-color: #4bd9f8;">Paguar</span>
                                <?php else: ?>
                                    <span class="badge badge-primary rounded-pill">Ne pritje</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
								 Shfaq Listen
				                    <span class="sr-only">Shfaq Listen</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="<?php echo base_url."admin?page=invoice/view_invoice&id=".$row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> Shiko</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="<?php echo base_url."admin?page=invoice/manage_invoice&id=".$row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Ndrysho</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Fshij</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
					<thead>
					<tr id="trShuma">
						<th class="text-center">Shuma totale DITORE</th>
					</tr>
				</thead>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT SUM(`total_amount`) AS shumaDitore from `invoice_list` i where DATE(i.date_created) like CURDATE()");
						while($row = $qry->fetch_assoc()):
					?>
					<td class="text-center"><?php echo number_format($row['shumaDitore'],2) ?></td>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Doni ta fshini kete fature nga sistemi?","delete_invoice",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Detajet e fatures","invoices/view_details.php?id="+$(this).attr('data-id'))
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_invoice($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_invoice",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("Ndodhi nje gabim",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("Ndodhi nje gabim",'error');
					end_loader();
				}
			}
		})
	}
</script>