<?php

$bug = $this->db->get_where('project_bug', array('project_bug_id' => $param2))->result_array();
foreach ($bug as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <blockquote class="blockquote-default">
                <p>
                    <strong><?php echo $row['title']; ?></strong>
                </p>
                <p>
                    <small><?php echo $row['description']; ?></small>
                    <?php if ($row['file'] != ''): ?>
                        <br>

                        <i class="entypo-download" style="color: #ccc;"></i>
                        <a style="font-size: 10px; color: #979797;" href="<?php echo base_url(); ?>uploads/bug_file/<?php echo $row['file']; ?>"><?php echo $row['file']; ?></a>

                    <?php endif; ?>
                <hr />

                <i class="entypo-user" style="color: #ccc;"></i>
                <?php
                $type = $row['user_type'];
                $id = $row['user_id'];
                $name = $this->db->get_where($type, array($type . '_id' => $id))->row()->name;
                echo $name;
                ?>
                &nbsp;
                &nbsp;
                <i class="entypo-calendar" style="color: #ccc;"></i>
    <?php echo date("d M Y", $row['timestamp']); ?>
                &nbsp;
                &nbsp;
                
                </p>

            </blockquote>

        </div>
    </div>

<?php endforeach; ?>