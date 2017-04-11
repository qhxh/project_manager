<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo 'Sửa gói dự án'; ?>
                </div>
            </div>
            <div class="panel-body">
                <!-------------------- start form create/edit category --------------- !-->
                <form action="" method="POST" class="form-horizontal form-groups-bordered">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label"><?php echo get_phrase('name'); ?></label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input type="text" class="form-control" name="cat-name"  value="<?php if ($cat->name) echo $cat->name; ?>" placeholder="Tên gói">

                            </div>
                            <?php echo form_error('cat-name'); ?>
                        </div>

                    </div>  
                    
                    <div class="form-group">
                        <label for="description" class="col-sm-4 control-label"><?php echo get_phrase('description'); ?></label>
                        
                        <div class="col-sm-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <textarea class="form-control" placeholder="Mô tả gói" name="cat-desc">
                                    <?php if ( $cat->description ) echo $cat->description; ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="ngansach" class="col-sm-4 control-label"><?php echo 'Ngân sách'; ?></label>
                        
                        <div class="col-sm-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input type="text" class="form-control" name="cat-ngansach" data-mask="fdecimal" data-dec="." value="<?php if ($cat->cat_ngansach) echo $cat->cat_ngansach; ?>"  placeholder="VND">
                            </div>
                            <?php echo form_error('cat-ngansach'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="time" class="col-sm-4 control-label"><?php echo 'Thời gian thực hiện'; ?></label>
                        
                        <div class="col-sm-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-user"></i></span>
                                <input type="text" class="form-control" name="cat-time"  value="<?php if ($cat->cat_time) echo $cat->cat_time; ?>" placeholder="Ngày">
                            </div>
                            <?php echo form_error('cat-time'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-7">
                            <button type="submit" class="btn btn-info" name ="cat-edit-submit"><?php echo 'Sửa'; ?></button>
                        </div>
                    </div>
                </form>

                <!--------------------------- END CATEGORY FORM ------------------------- !-->
            </div>
        </div>
    </div>
</div>


