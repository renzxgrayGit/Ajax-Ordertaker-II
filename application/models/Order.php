<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Model {

	function fetch_all() {
        return $this->db->query("SELECT * FROM orders")->result_array();
    }

    function create($new_order) {
        $query = "INSERT INTO orders (description, created_at, updated_at) VALUES (?, ?, ?)";
        $values = array($new_order['description'], $new_order['created_at'], $new_order['updated_at']);
        return $this->db->query($query, $values);
    }

    function remove_order($order_id) {
        $query = "DELETE FROM orders WHERE id = ?";
        return $this->db->query($query, array($order_id));
    }

    // Model method to update description
    function updateDescription($orderId, $newDescription) {
        $sql = "UPDATE orders SET description = ?, updated_at = NOW() WHERE id = ?";
        return $this->db->query($sql, array($newDescription, $orderId));
    }
}
