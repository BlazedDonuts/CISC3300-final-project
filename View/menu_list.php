<?php include('view/header.php') ?>

<?php if($menus) { ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>
            Categories:
        </h1>
    </header>

    <?php foreach ($menus as $menu) : ?>
    <div class="list__row">
        <div class="list__item">
            <p class="bold"><?= $menu['menuName'] ?></p>
        </div>
        <div class="list__removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_menu">
                <input type="hidden" name="menu_id" value="<?= $menu['menuID']; ?>">
                <button class="remove-button">&#x1F5D9;</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</section>

<?php } else { ?>
    <section id="no-items" class="no-items">
        <p>None yet. Add some of your choice!</p>
    </section>
<?php } ?>

<section id="add" class="add">
    <h2>Add A Category</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_menu">
        <div class="add__inputs">
            <label>What Type of Food Would You Like?</label>
            <input type="text" name="menu_name" maxlength="50" placeholder="Crepes/Waffles/Drinks" autofocus required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<section id="view-orders" class="view-orders">
    <p>View and Update Orders</p>
    <a href=".?action=view_orders">View Orders</a>
</section>

<br>

<?php include('view/footer.php') ?>
