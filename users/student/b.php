<tbody>
    <tr>
        <?php 
        $status_filter = array();
        $activity_filter = array();
        if(isset($_POST["status_filter"])){
            $status_filter = $_POST["status_filter"];
        }
        if(isset($_POST["activity_filter"])){
            $activity_filter = $_POST["activity_filter"];
        }
        foreach($list_logbook as $i => $data):
            if(!in_array($data['status'],$status_filter) || !in_array($data['activity'],$activity_filter)) {
                continue;
            }
        ?>
        <tr>
        <td>
            <input type="checkbox" name="status_filter[]" value="<?php echo $data['status'] ?>" <?php echo in_array($data['status'],$status_filter)?"checked":"" ?> onchange="filterResults()">
        </td>
        <td>
            <input type="checkbox" name="activity_filter[]" value="<?php echo $data['activity'] ?>" <?php echo in_array($data['activity'],$activity_filter)?"checked":"" ?> onchange="filterResults()">
        </td>
        <td><?php echo $data['date'] ?></td>
        <td><?php echo $data['activity'] ?></td>
        <td><?php echo $data['totaltime'] ?></td>
        <td><?php echo $data['status'] ?></td>
        <td>
            <form style="display: inline-block;" action="view-history.php" method="post">
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <button type="submit" class="label bg-primary text-white f-12" style="border-radius: 10px; border-width: 0px;">View</button>
            </form>
            <form style="display: inline-block;" action="delete.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <button type="submit" class="label bg-danger text-white f-12" style="border-radius: 10px; border-width: 0px;">Delete</button>
            </form>
        </td>
        </tr>
        <?php endforeach; ?>
    </tr>
</tbody>
<script>
    function filterResults() {
        document.getElementById("form-id").submit();
    }
</script>