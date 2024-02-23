<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("Order");
	}

	function index_html()
	{
		$result["orders"] = $this->Order->fetch_all();
		$this->load->view("partials/orders", $result);
	}

	function create() {
		date_default_timezone_set('Asia/Manila');
		$new_order = array(
					'description'=> $this->input->post("description"),
					'created_at' => date('Y-m-d h:i:s A'),
					'updated_at' => date('Y-m-d h:i:s A') );
		$this->Order->create($new_order);
		$result["orders"] = $this->Order->fetch_all();
		$this->load->view("partials/orders", $result);
	}	

	function remove($id) {
		$this->Order->remove_order($id);
		$result["orders"] = $this->Order->fetch_all();
		$this->load->view("partials/orders", $result);
	}

	// Controller method to update description
    public function updateDescription() {
        // Retrieve data from the AJAX request
        $orderId = $this->input->post('id');
        $newDescription = $this->input->post('description');

        // Call the model method to update the description in the database
        $result = $this->Order->updateDescription($orderId, $newDescription);

        // Return response (JSON format)
        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Description updated successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to update description.';
        }

        // Output response in JSON format
        echo json_encode($response);
    }

	function index()
	{
		$this->load->view('index');
	}

	/* below is test if you're connected to database */
	/* function index() {
		$result["orders"] = $this->Order->fetch_all();
		echo "<pre>";
		var_dump($result["orders"]);
		echo "</pre>";
		// remove the logging above once you confirm it successfully fetched
	} */

	/* function index() {
		$result["orders"] = $this->Order->fetch_all();
		$this->load->view('index', $result);
	} */
}
