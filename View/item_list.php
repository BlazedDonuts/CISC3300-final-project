<?php include('view/header.php') ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>
            Orders
        </h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_items">
            <select name="menu_id" required>
                <option value="0">All</option>
                <?php foreach ($menus as $menu) : ?>
                <?php if ($menu_id == $menu['menuID']) { ?>
                <option value="<?= $menu['menuID'] ?>" selected>
                    <?php } else { ?>
                <option value="<?= $menu['menuID'] ?>">
                    <?php } ?>
                    <?= $menu['menuName'] ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button class="add-button bold">Go</button>
        </form>
    </header>


    <?php if($items) { ?>
    <?php foreach ($items as $item) : ?>
    <div class="list__row">
        <div class="list__item">
            <p class="bold"><?= "{$item['menuName']}" ?></p>
            <p><?= $item['Description']; ?></p>
        </div>



        <!--remmove-->
        <div class="list__removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_item">
                <input type="hidden" name="item_id" value="<?= $item['id']; ?>">
                <button class="remove-button">&#x1F5D9;</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
    <?php } else { ?>
    <br>
    <?php if ($menu_id) { ?>
    <p>Add an item!</p>
    <?php } else { ?>
    <p>Add an item!</p>
    <?php } ?>
    <br>
    <?php } ?>
</section>

<section id="add" class="add">
<section id="add" class="add">
    <h2>Add Items</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_item">
        <div class="add__inputs">
            <label>Category:</label>
            <select name="menu_id" required>
                <option value="">Select</option>
                <?php foreach ($menus as $menu) : ?>
                <option value="<?= $menu['menuID'] ?>">
                    <?= htmlspecialchars($menu['menuName']); ?>
                </option>
                <?php endforeach; ?>
            </select>
            <label>Description</label>
            <input type="text" name="description" maxlength="500" placeholder="What Flavor?" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<div class="update-categories">
    <a href=".?action=list_menus">View or Update Your Categories</a>
</div>

<?php include('view/footer.php') ?>