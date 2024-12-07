<?php
include('Database.php');

if (isset($_GET['menu_id'])) {
    $menu_id = $_GET['menu_id'];
    $items = get_item_by_menus($menu_id);
    echo json_encode($items);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    if ($data['action'] === 'add_item') {
        $menu_id = $data['menu_id'];
        $description = $data['description'];
        add_item_to_database($menu_id, $description);
        echo json_encode(['message' => 'Item added successfully']);
        exit;
    }
}

function get_items_by_menu($menu_id) {
    global $db;
    if ($menu_id == 0) {
        $query = 'SELECT * FROM items ORDER BY id';
    } else {
        $query = 'SELECT * FROM items WHERE menuID = :menu_id ORDER BY id';
    }

    $statement = $db->prepare($query);
    if ($menu_id != 0) {
        $statement->bindValue(':menu_id', $menu_id);
    }
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();

    return $items;
}

// Function to add item to the database
function add_item_to_database($menu_id, $description) {
    global $db;
    $query = 'INSERT INTO items (menuID, Description) VALUES (:menu_id, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':menu_id', $menu_id);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

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


