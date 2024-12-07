<?php
    require('model/Database.php');
    require('model/tripleChocoDB.php');
    require('model/menu_DB.php');

    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $menu_name = filter_input(INPUT_POST, 'menu_name', FILTER_SANITIZE_STRING);

    $menu_id = filter_input(INPUT_POST, 'menu_id', FILTER_VALIDATE_INT);
    if (!$menu_id) {
        $menu_id = filter_input(INPUT_GET, 'menu_id', FILTER_VALIDATE_INT);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if (!$action) {
            $action = 'list_items'; 
        }
    }

    switch($action) {
        case "list_menus": 
            $menus = get_menus();
            include('view/menu_list.php');
            break;
        case "add_menu":
            add_menu($menu_name);
            header("Location: .?action=list_menus");
            break;
        case "add_item":
            if ($menu_id && $description) {
                add_item($menu_id, $description);
                header("Location: .?menu_id=$menu_id");
            } else {
                $error = "Error. Try Again";
                include('view/error.php');
                exit();
            }
            break;
        case "delete_menu":
            if ($menu_id) {
                try {
                    delete_menu($menu_id);
                } catch (PDOException $e) {
                    $error = "Can't delete!";
                    include('view/error.php');
                    exit();
                }
                header("Location: .?action=list_menus");
            }
            break;
        case "delete_item":
            if ($item_id) {
                delete_item($item_id);
                header("Location: .?menu_id=$menu_id");
            } else {
                $error = "Error!";
                include('view/error.php');
            }
            break;
        default:
            $menu_name = get_menu_name($menu_id);
            $menus = get_menus();
            $items = get_item_by_menus($menu_id);
            include('view/item_list.php');
    }

    if (!empty($error)) : ?>
        <section class="error">
            <h2>Error</h2>
            <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
            <p><a href=".">Go to Homepage</a></p>
        </section>
    <?php endif; ?>
    

    