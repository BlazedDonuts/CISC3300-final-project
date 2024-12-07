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


    <div id="itemsList">
    <script>
        // Function to fetch and load items based on selected menu
        document.getElementById('menuSelect').addEventListener('change', function () {
            const menu_id = this.value; // Get the selected menu_id
            loadItems(menu_id);
        });

        // Initial load of items
        window.onload = function () {
            const menu_id = document.getElementById('menuSelect').value;
            loadItems(menu_id);
        };

        function loadItems(menu_id) {
            fetch(`item_DB.php?menu_id=${menu_id}`) // GET request to fetch items by menu_id
                .then(response => response.json())
                .then(data => {
                    const itemsList = document.getElementById('itemsList');
                    itemsList.innerHTML = ''; // Clear current items

                    if (data.length > 0) {
                        data.forEach(item => {
                            // Add each item dynamically to the page
                            const itemDiv = document.createElement('div');
                            itemDiv.classList.add('list__row');
                            itemDiv.innerHTML = `
                                <div class="list__item">
                                    <p class="bold">${item.menuName}</p>
                                    <p>${item.Description}</p>
                                </div>
                            `;
                            itemsList.appendChild(itemDiv);
                        });
                    } else {
                        itemsList.innerHTML = '<p>No items available in this category.</p>';
                    }
                })
                .catch(error => console.error('Error loading items:', error));
        }
    </script>
    </div>

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

<script>
    function addItem() {
        const menu_id = document.getElementById('menu_id').value;
        const description = document.getElementById('description').value;

        if (menu_id && description) {
            const data = {
                action: 'add_item',
                menu_id: menu_id,
                description: description
            };

            // POST request to add item
            fetch('item_DB.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Item added:', data);
                alert('Item added successfully!');
                loadItems(menu_id); // Reload the items list after adding
            })
            .catch(error => console.error('Error adding item:', error));
        } else {
            alert('Please fill in all fields');
        }
    }
</script>

<div class="update-categories">
    <a href=".?action=list_menus">View or Update Your Categories</a>
</div>

<?php include('view/footer.php') ?>