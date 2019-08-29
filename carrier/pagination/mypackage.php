
<?php
	include '../functions/dbcon.php';
	session_start();
	if (!isset($_SESSION['id'])) {
		header('location: login');
	}
	$userId = $_SESSION['id']; //current ID of logged in user
	$record_perpage = 10;
	$page = '';
	$output = '';

	if (isset($_POST['page'])) {
		// code...
		$page = $_POST['page'];
	} else{
		$page = 1;
	}

	$start_from = ($page - 1) * $record_perpage;

	$queryesults = "SELECT DISTINCT a.*, (SELECT COUNT(*) FROM bidreport WHERE productid = a.itemId ) AS total FROM biditem a WHERE a.sellerId = $userId ORDER BY date_made DESC LIMIT $start_from, $record_perpage";
	$runquery = mysqli_query($conn, $queryesults);

	$output .= '<table class="list-view">
		<thead>
			<tr class="table100-head">
				<th class="column1">Date</th>
				<th class="column2">Order ID</th>
				<th class="column3">Name</th>
				<th class="column4">Price</th>
				<th class="column5">Bids</th>
				<th class="column6">  </th>
			</tr>
		</thead>
		<tbody>';
		while ($row = mysqli_fetch_array($runquery)) {
			// code...
			$output .= "<tr>
				<td class='column1'>".$row['date_made']."</td>
				<td class='column2' style='text-transform: uppercase'>".$row['orderId']."</td>
				<td class='column3'>".$row['itemname']."</td>
				<td class='column4'>".$row['startprice']."</td>
				<td class='column5'>".$row['total']."</td>
				<td class='column6'>
					<a href='overview?q=".$row['itemId']."' class=''> Map view </a> &nbsp;&nbsp;&nbsp;
					<a href='offer?q=".$row['itemId']."' class='tbl-btn'> view bids </a>
				</td>
			</tr>";
		}
		$output .= '</tbody></table>
		<div class="pagination p2"> <ul>';

		$page_query = "SELECT DISTINCT a.*, (SELECT COUNT(*) FROM bidreport WHERE productid = a.itemId ) AS total FROM biditem a WHERE a.sellerId = $userId ORDER BY date_made DESC";
		$page_result = mysqli_query($conn, $page_query);
		$total_records = mysqli_num_rows($page_result);
		$total_pages = ceil($total_records/$record_perpage);

		for($i=1; $i<=$total_pages; $i++) {
			$output .= "<a class='pagination_link'is-active id='".$i."'><li>".$i."</li></a>";
		}

		$output .='</ul></div>';

		echo $output;
?>
