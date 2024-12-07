<?php

//list orders by categories in menu
function get_item_by_menus($menu_id) {
    global $db;

    if ($menu_id) {
        $query = 'SELECT I.id, I.Description, M.menuName 
                  FROM items I 
                  LEFT JOIN menu M ON I.menuID = M.menuID 
                  WHERE I.menuID = :menu_id 
                  ORDER BY I.ID';
        $statement = $db->prepare($query);
        $statement->bindValue(':menu_id', $menu_id);
    } else {
        $query = 'SELECT I.id, I.Description, M.menuName 
                  FROM items I 
                  LEFT JOIN menu M ON I.menuID = M.menuID 
                  ORDER BY I.ID';
        $statement = $db->prepare($query);
    }

    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();

    return $items;
}

//detele orders

    function delete_item($items_id) {
        global $db;
        $query = 'DELETE FROM items WHERE ID = :item_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':item_id', $items_id);
        $statement->execute();
        $statement->closeCursor();
    }

//add orders 

    function add_item($menu_id, $description) {
        global $db;
        $query = 'INSERT INTO items (Description, menuID) VALUES (:descr, :menuID)';

        $statement = $db->prepare($query);
        $statement->bindValue(':descr', $description);
        $statement->bindValue(':menuID', $menu_id);
        $statement->execute();
        $statement->closeCursor();
    }


