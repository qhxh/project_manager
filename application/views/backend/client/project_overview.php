<?php 
	$current_project = $this->db->get_where('project' , array(
		'project_code' => $project_code
	))->result_array();
	foreach ($current_project as $row):
?>
<div class="col-md-9">
	
    <!-- project description -->
    <div class="panel panel-primary" data-collapsed="0">
            
        
        <div class="panel-heading">
            <div class="panel-title"><?php echo get_phrase('project_overview');?></div>
            
        </div>
        
        <div class="panel-body">
            
            <p>
                <?php echo $row['description'];?>
            </p>
            <hr />
            <p style="font-size: 10px;">
                <i class="entypo-calendar" style="color: #ccc;"></i>
                <?php echo $row['timestamp_start'];?>  <b>to</b>  <?php echo $row['timestamp_end'];?>
                &nbsp;
                &nbsp;
                <i class="entypo-globe" style="color: #ccc;"></i>
                <a href="<?php echo $row['demo_url'];?>" target="_blank"><?php echo $row['demo_url'];?></a>
                <?php if ($row['company_id'] > 0):?>
                &nbsp;
                &nbsp;
                <i class="entypo-suitcase" style="color: #ccc;"></i>
                    <?php echo $this->db->get_where('company' , array('company_id' => $row['company_id']))->row()->name;?>
                <?php endif;?> 
            </p>
            
            <p>

                <?php 
                $status = 'info';
                if ($row['progress_status'] == 100)$status = 'success';
                if ($row['progress_status'] < 50)$status = 'danger';
                ?>
              
                <div class="progress progress-striped <?php if ($row['progress_status']!=100)echo 'active';?> tooltip-primary" 
                    style="height:10px !important; cursor:pointer;"  data-toggle="tooltip"  data-placement="top"
                        title="" data-original-title="<?php echo $row['progress_status'];?>% completed" >
                    <div class="progress-bar progress-bar-<?php echo $status;?>" 
                        role="progressbar" aria-valuenow="<?php echo $row['progress_status'];?>" 
                            aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row['progress_status'];?>%">
                      <span class="sr-only">40% Complete (success)</span>
                    </div>
                </div>
                
            </p>

            

        </div>
        
    </div>
    <!-- project description -->

</div>
<?php endforeach;?>
