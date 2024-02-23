
<?php	foreach($orders as $order) {	?>
        <div class="order-holder">
            <h2 class="order-id"><?= $order['id'] ?></h2>
            <div class="remove-order">
                <form action="/orders/remove/<?= $order['id'] ?>" method="post"  class="remove-order-form">
                    <input type="submit" value="X">
                </form>
            </div>
            <div class="order-description-holder">
                <textarea class="order-description-input"><?= $order['description'] ?></textarea>
            </div>
        </div>
<?php	} 	?>

 
