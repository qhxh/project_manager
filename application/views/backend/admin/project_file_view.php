
<?php 
$file_information	=	$this->db->get_where('project_file' , array('project_file_id'=>$param2))->result_array();
foreach ($file_information as $row):
?>

    <div class="alert alert-info"> 
    	<?php echo $row['description'];?>
    </div>
    
    <iframe src="http://docs.google.com/viewer?url=<?php echo base_url();?>uploads/project_file/<?php echo $row['name'];?>&embedded=true" width="100%" height="780" style="border: none;"></iframe>


<?php endforeach;?>