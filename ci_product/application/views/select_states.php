<?php if(!empty($states)): ?>
    <option value="">--Select State--</option>
    <?php foreach($states as $state): ?>
        <option value="<?php echo $state["id"]; ?>"><?php echo $state["state_name"]; ?></option>
    <?php endforeach; ?>
<?php else: ?>
    <option value="">--No States Available--</option>
<?php endif; ?>