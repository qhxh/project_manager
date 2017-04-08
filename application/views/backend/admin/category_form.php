<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo 'Thêm gói dự án'; ?>
                </div>
            </div>
            <div class="panel-body">
                <!-------------------- start form create/edit category --------------- !-->
                <form action="" method="POST" class="form-horizontal form-groups-bordered">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-comment"></i></span>
                                <input type="text" class="form-control" name="cat-name"  value="" placeholder="Tên gói">

                            </div>
                            <?php echo form_error('cat-name'); ?>
                        </div>

                    </div>  
                    
                    <div class="form-group">
                        <label for="description" class="col-sm-4 control-label"><?php echo get_phrase('description'); ?></label>
                        
                        <div class="col-sm-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-keyboard"></i></span>
                                <textarea class="form-control" placeholder="Mô tả gói" name="cat-desc"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="ngansach" class="col-sm-4 control-label"><?php echo 'Ngân sách'; ?></label>
                        
                        <div class="col-sm-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-cc-nc"></i></span>
                                <input type="text" class="form-control" name="cat-ngansach"  value="" placeholder="VND">
                            </div>
                            <?php echo form_error('cat-ngansach'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="time" class="col-sm-4 control-label"><?php echo 'Thời gian thực hiện'; ?></label>
                        
                        <div class="col-sm-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-clock"></i></span>
                                <input type="text" class="form-control" name="cat-time"  value="" placeholder="Ngày">
                            </div>
                            <?php echo form_error('cat-time'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-7">
                            <button type="submit" class="btn btn-info" name ="cat-create-submit"><?php echo 'Thêm/Sửa'; ?></button>
                        </div>
                    </div>
                </form>

                <!--------------------------- END CATEGORY FORM ------------------------- !-->
            </div>
        </div>
    </div>
</div>


