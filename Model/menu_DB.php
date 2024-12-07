<?php

//get categories  
function get_menus() {
    global $db;
    $query = 'SELECT * FROM menu ORDER BY menuID';

        $statement = $db->prepare($query);
        $statement->execute();
        $menus = $statement->fetchAll();
        $statement->closeCursor();
        return $menus;
}


//get category names
function get_menu_name($menu_id) {
    if(!$menu_id) {
        return "All menus";
    }


//db setup
    global $db;
    $query = 'SELECT * FROM menu WHERE menuID = :menu_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':menu_id', $menu_id);
        $statement->execute();
        $menu = $statement->fetch();
        $statement->closeCursor();
        $menu_name = $menu['menuName'];
        return $menu_name;

}


//delete categories
function delete_menu($menu_id) {
    global $db;
    $query = 'DELETE FROM menu WHERE menuID = :menu_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':menu_id', $menu_id);
    $statement->execute();
    $statement->closeCursor();
}

//add categories
function add_menu($menu_name) {
    global $db;
    $query = 'INSERT INTO menu (menuName) VALUES (:menuName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':menuName', $menu_name);
    $statement->execute();
    $statement->closeCursor();
}


