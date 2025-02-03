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
		<h3 class="card-title">Lista e sherbimeve</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Shto nje sherbim te ri</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="20%">
					<col width="10%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th class="text-center">Data e krijimit</th>
						<th class="text-center">Emri i Sherbimit</th>
						<th class="text-center">Pershkrimi</th>
						<th class="text-center">Cmimi</th>
						<th class="text-center">Statusi</th>
						<th class="text-center">Veprimi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `services_list`  order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="text-center"><?php echo date("d-m-Y",strtotime($row['date_created'])) ?></td>
							<td class="text-center"><?php echo $row['name'] ?></td>
							<td class="text-center"><?php echo $row['description'] ?></td>
							<td class="text-center"><?php echo number_format($row['price'],2) ?></td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-info rounded-pill" style="background-color: #4bd9f8; color: black">Aktiv</span>
                                <?php else: ?>
                                    <span class="badge badge-danger rounded-pill">Joaktiv</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
								 Shfaq Listen
				                    <span class="sr-only">Shfaq Listen</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> Shiko</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Ndrysho</a>
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
			_conf("Doni ta fshini kete sherbim?","delete_service",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Shto nje sherbim te ri","maintenance/manage_service.php","mid-large")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Ndrysho detajet e sherbimit","maintenance/manage_service.php?id="+$(this).attr('data-id'),"mid-large")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-list'></i> Detajet e sherbimit","maintenance/view_service.php?id="+$(this).attr('data-id'),"")
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_service($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_service",
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