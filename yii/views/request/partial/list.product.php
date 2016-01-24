<div class="list-group-item" id="list-<?php echo $model->product->id; ?>">
    <?php echo "{$model->quantity}  - {$model->product->name}, Custo R$ ".number_format($model->price,2,',','.'); ?>
    <div class="pull-right">
        <a href="#" data-id="<?php echo $model->product->id; ?>" class="dropProduct remove-link label label-danger">
            <span class="glyphicon glyphicon-remove"></span>
        </a>
    </div>
    <input type="hidden" name="products[<?php echo $model->product->id; ?>][product_id]" value="<?php echo $model->product->id;?>">
    <input type="hidden" name="products[<?php echo $model->product->id; ?>][quantity]" value="<?php echo $model->quantity;?>">
    <input type="hidden" name="products[<?php echo $model->product->id; ?>][price]" value="<?php echo $model->price;?>">
</div>