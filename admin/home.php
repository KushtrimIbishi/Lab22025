<h1 class="">Miresevini tek <?php echo $_settings->info('name') ?></h1>
<hr>
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hand-holding"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Sherbimet</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `services_list` where `status` = 1")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-friends"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Klientat</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `client_list` where `status` = 1")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>    
    <div class="col-12 col-sm-12 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Terminet</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `termin_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-receipt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Faturat</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `invoice_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    


</div>
