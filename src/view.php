<?php if (!$success):?>
    An error occurred during loading panel "Events"
<?php else: ?>
<table class="table table-bordered table-responsive table-striped panel-info-table">
    <thead>
    <tr>
        <th>Time</th>
        <th>Event</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($events as $event):?>
        <tr><td><?=$event['time']?></td><td><?=$event['name']?></td></tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php endif;?>