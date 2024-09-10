<?php if(!empty($cities)): ?>
    <option value="">--Select City--</option>
    <?php foreach($cities as $city): ?>
        <option value="<?php echo $city["id"]; ?>"><?php echo $city["city_name"]; ?></option>
    <?php endforeach; ?>
<?php else: ?>
    <option value="">--No city Available--</option>
<?php endif; ?>