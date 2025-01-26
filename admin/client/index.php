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
	/* .rounded-pill{
		background-color: #4bd9f8;
	} */
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
		<h3 class="card-title">Lista e klientave</h3>
		<div class="card-tools">
			<a href="<?php echo base_url."admin?page=client/manage_client" ?>" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Shto nje klient te ri</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="10%">
					<col width="20%">
					<col width="30%">
					<col width="30%">
					<col width="10%">
					<col width="30%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Data e regjistrimit</th>
						<!--<th>Fotoja</th>-->
						<th class="text-center">Klienti</th>
						<th class="text-center">Statusi</th>
						<th class="text-center">Veprimi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT *  from `client_list`order by fullname asc ");
						while($row = $qry->fetch_assoc()):
						
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="text-center"><?php echo date("d-m-Y ",strtotime($row['date_created'])) ?></td>
							<!--<td class="text-center"><img src="<?php echo validate_image("uploads/client-".$row['id'].".png")."?v=".(isset($row['date_updated']) ? strtotime($row['date_updated']) : "") ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>-->
							<td class="text-center">
								<p class="m-0">
									<small>
										<span class="text-muted">Kodi: </span><span><?php echo $row['client_code'] ?></span><br>
										<span class="text-muted">Emri: </span><span><?php echo $row['fullname'] ?></span>
									</small>
								</p>
							</td>
							<td class="text-center">
								<?php if ($row['status'] == 1): ?>
									<span class="badge badge-info rounded-pill" style="background-color: #4bd9f8; color: black">Aktiv</span>
								<?php elseif ($row['status'] == 0): ?>
									<span class="badge badge-danger rounded-pill">Joaktiv</span>
								<?php elseif ($row['status'] == 2): ?>
									<span class="badge badge-success rounded-pill">Perfunduar</span>
								<?php endif; ?>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
								 		Shfaq Listen
				                    <span class="sr-only">Shfaq Listen</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="<?php echo base_url."admin?page=client/view_client&id=".$row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> Shiko</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="<?php echo base_url."admin?page=client/manage_client&id=".$row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Ndrysho</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Fshij</a>
				                  </div>
							</td>
						</tr>
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
			_conf("Doni qe ta fshini klientin nga databaza?","delete_client",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Detajet e klientit","clients/view_details.php?id="+$(this).attr('data-id'))
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_client($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_client",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("Ndodhi nje gabim!",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("Ndodhi nje gabim!",'error');
					end_loader();
				}
			}
		})
	}
</script>