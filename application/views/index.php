<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Ajax Ordertaker II</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/assets/index.css">
		<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script>
			$(document).ready(function(){
				/* Function to clear form inputs */
                function clearFormInputs() {
					$('#order-form')[0].reset(); // Reset the form with ID "form1"
                    /* $('form')[0].reset(); */ // Reset the first form in the document
                }

				/* Function to handle removing order form via AJAX */
				function removeOrder(event) {
					event.preventDefault(); // Prevent default form submission
					var form = $(this);
					var url = form.attr('action');
					$.post(url, form.serialize(), function(res) {
						$('#orders').html(res); // Update orders
					});
				}

				/* Function to handle submitting edited description */
				function submitEditedDescription(event) {
					// Check if Enter key was pressed
					if (event.keyCode === 13) {
						var $input = $(this);
						var orderId = $input.closest('.order-holder').find('.order-id').text();
						var newDescription = $input.val();

						// Send AJAX request to update description in	 the database
						$.post('/orders/updateDescription', {
							id: orderId,
							description: newDescription
						}, function(response) {
							// Handle response from server
							if (response.success) {
								// Update interface if update was successful
								$textarea.replaceWith('<textarea class="order-description-input">' + newDescription + '</textarea>');
							} else {
								// Handle error if update failed
								console.error('Failed to update description.');
							}
						}, 'json');
					}
				}

				/* we are getting all of the quotes whenever the user first requests the page */
				$.get('/orders/index_html', function(res) {
					$('#orders').html(res);
				});

				/* submitting order form via AJAX */
				$('form').submit(function(){
					$.post('/orders/create', $(this).serialize(), function(res) {
						$('#orders').html(res); // Update orders
						clearFormInputs(); // Clear form inputs
					});
					return false; // Prevent default form submission
				});

				/* Attach event handler for removing order form via AJAX */
				$('#orders').on('submit', '.remove-order-form', removeOrder);

				// Attach event handler for editing description
				$('#orders').on('keyup', '.order-description-input', submitEditedDescription);

			});
		</script>
	</head>
	<body>
		<div class="container">
			<h1>Order Queue:</h1>
			<div id="orders">
			</div>
		</div>
	</body>
	<footer>
		<form id="order-form" action="/orders/create" method="post">
			<input type="text" name="description" placeholder="Type customers order here">
			<input type="submit" value="Submit">
		</form>
	</footer>
</html>