<?php
//Handles all functions of inquiries/tickets
class Tickets extends Database
{
	private $ticketTable = 'inquiries';
	private $ticketRepliesTable = 'replies';
	private $departmentsTable = 'departments';
	private $dbConnect = false;
	public function __construct()
	{
		$this->dbConnect = $this->dbConnect();
	}

	//show inquiries
	public function showTickets()
	{
		$sqlWhere = '';
		if (!isset($_SESSION["admin"])) {
			$sqlWhere .= " WHERE i.user = '" . $_SESSION["userid"] . "' ";
			if (!empty($_POST["search"]["value"])) {
				$sqlWhere .= " and ";
			}
		} else if (isset($_SESSION["admin"]) && !isset($_SESSION["full"])) {
			$sqlWhere .= " WHERE i.department = '" . $_SESSION["dept"] . "' ";
			if (!empty($_POST["search"]["value"])) {
				$sqlWhere .= " and ";
			}
		} else if (isset($_SESSION["admin"]) && isset($_SESSION["full"]) && !empty($_POST["search"]["value"])) {
			$sqlWhere .= " WHERE ";
		}
		$time = new time;
		$sqlQuery = "SELECT i.id, i.uniqid, i.title, i.init_msg as message, i.date, i.last_reply, i.resolved, u.email as creator, d.name as department, u.user_group, i.user, i.user_read, i.admin_read
			FROM inquiries i 
			LEFT JOIN users u ON i.user = u.id 
			LEFT JOIN departments d ON i.department = d.id $sqlWhere ";
		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= ' (uniqid LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR title LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR name LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR email LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR resolved LIKE "%' . $_POST["search"]["value"] . '%") ';
		}
		if (!empty($_POST["order"])) {
			$sqlQuery .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= 'ORDER BY i.id DESC ';
		}
		if ($_POST["length"] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$ticketData = array();
		while ($ticket = mysqli_fetch_assoc($result)) {
			$ticketRows = array();
			$status = '';
			if ($ticket['resolved'] == 0) {
				$status = '<span class="label label-success">Open</span>';
			} else if ($ticket['resolved'] == 1) {
				$status = '<span class="label label-danger">Closed</span>';
			}
			$title = $ticket['title'];
			if ((isset($_SESSION["admin"]) && !$ticket['admin_read'] && $ticket['last_reply'] != $_SESSION["userid"]) || (!isset($_SESSION["admin"]) && !$ticket['user_read'] && $ticket['last_reply'] != $ticket['user'])) {
				$title = $this->getRepliedTitle($ticket['title']);
			}
			$disbaled = '';
			if (!isset($_SESSION["admin"])) {
				$disbaled = 'disabled';
			}
			$ticketRows[] = $ticket['uniqid'];
			$ticketRows[] = $title;
			$ticketRows[] = $ticket['department'];
			$ticketRows[] = $ticket['creator'];
			$ticketRows[] = $time->ago($ticket['date']);
			$ticketRows[] = $status;
			$ticketRows[] = '<a href="review.php?id=' . $ticket["uniqid"] . '" class="btn btn-success btn-xs update">View Inquiry</a>';
			if (!isset($_SESSION["admin"])) {
				$ticketRows[] = '';
				$ticketRows[] = '';
				$ticketRows[] = '';
			} else {
				$ticketRows[] = '<button type="button" name="update" id="' . $ticket["id"] . '" class="btn btn-warning btn-xs update" ' . $disbaled . '>Edit Inquiry</button>';
				$ticketRows[] = '<button type="button" name="end" id="' . $ticket["id"] . '" class="btn btn-danger btn-xs end"  ' . $disbaled . '>Close Inquiry</button>';
				if (isset($_SESSION["full"])) {
					$ticketRows[] = '<button type="button" name="delete" id="' . $ticket["id"] . '" class="btn btn-danger btn-xs delete"  ' . $disbaled . '>Delete Inquiry</button>';
				} else {
					$ticketRows[] = '';
				}
			}
			$ticketData[] = $ticketRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$ticketData
		);
		echo json_encode($output);
	}

	//get notification if answered
	public function getRepliedTitle($title)
	{
		$title = $title . '<span class="answered">New</span>';
		return $title;
	}

	//create inquiry
	public function createTicket()
	{
		if (!empty($_POST['subject']) && !empty($_POST['message'])) {
			$date = new DateTime();
			$date = $date->getTimestamp();
			$uniqid = uniqid();// generates a unique ID based on the current time in microsecondss
			$message = strip_tags($_POST['message']);
			$queryInsert = "INSERT INTO " . $this->ticketTable . " (uniqid, user, title, init_msg, department, date, last_reply, user_read, admin_read, resolved) 
			VALUES('" . $uniqid . "', '" . $_SESSION["userid"] . "', '" . $_POST['subject'] . "', '" . $message . "', '" . $_POST['department'] . "', '" . $date . "', '" . $_SESSION["userid"] . "', 0, 0, '" . $_POST['status'] . "')";
			mysqli_query($this->dbConnect, $queryInsert);
			echo 'success ' . $uniqid;
		} else {
			echo '<div class="alert error">Please fill in all fields.</div>';
		}
	}

	//get the inquiry details
	public function getTicketDetails()
	{
		if ($_POST['ticketId']) {
			$sqlQuery = "
				SELECT * FROM " . $this->ticketTable . " 
				WHERE id = '" . $_POST["ticketId"] . "'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}
	}

	//update inquiry
	public function updateTicket()
	{
		if ($_POST['ticketId']) {
			$updateQuery = "UPDATE " . $this->ticketTable . " 
			SET department = '" . $_POST["department"] . "', resolved = '" . $_POST["status"] . "'
			WHERE id ='" . $_POST["ticketId"] . "'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
		}
	}

	//close inquiry
	public function closeTicket()
	{
		if ($_POST["ticketId"]) {
			$sqlClose = "UPDATE " . $this->ticketTable . " 
				SET resolved = '1'
				WHERE id = '" . $_POST["ticketId"] . "'";
			mysqli_query($this->dbConnect, $sqlClose);
		}
	}

	//delelte inquiry
	public function deleteTicket()
	{
		if ($_POST["ticketId"]) {
			$sqlDeleteInq  = "DELETE FROM " . $this->ticketTable . "
                WHERE id = '" . $_POST["ticketId"] . "'";

			if (mysqli_query($this->dbConnect, $sqlDeleteInq)) {
			} else {
				echo "ERROR: Could not able to execute $sqlDeleteInq. " . mysqli_error($this->dbConnect);
			}
			$sqlDeleteRep  = "DELETE FROM " . $this->ticketRepliesTable . "
            WHERE ticket_id = '" . $_POST["ticketId"] . "'";

			if (mysqli_query($this->dbConnect, $sqlDeleteRep)) {
			} else {
				echo "ERROR: Could not able to execute $sqlDeleteRep. " . mysqli_error($this->dbConnect);
			}
		}
	}

	//get department names from department table
	public function getDepartments()
	{
		$sqlQuery = "SELECT * FROM " . $this->departmentsTable;
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while ($department = mysqli_fetch_assoc($result)) {
			echo '<option value="' . $department['id'] . '">' . $department['name']  . '</option>';
		}
	}

	//get inquiry information
	public function ticketInfo($id)
	{
		$sqlQuery = "SELECT i.id, i.uniqid, i.title, i.user, i.init_msg as message, i.date, i.last_reply, i.resolved, CONCAT(u.firstname, ' ', u.surname) as creator, d.name as department 
			FROM " . $this->ticketTable . " i 
			LEFT JOIN users u ON i.user = u.id 
			LEFT JOIN departments d ON i.department = d.id 
			WHERE i.uniqid = '" . $id . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$tickets = mysqli_fetch_assoc($result);
		return $tickets;
	}

	//saving the inquiry replies
	public function saveTicketReplies()
	{
		if ($_POST['message']) {
			$date = new DateTime();
			$date = $date->getTimestamp();
			$queryInsert = "INSERT INTO " . $this->ticketRepliesTable . " (user, text, ticket_id, date) 
				VALUES('" . $_SESSION["userid"] . "', '" . $_POST['message'] . "', '" . $_POST['ticketId'] . "', '" . $date . "')";
			mysqli_query($this->dbConnect, $queryInsert);
			$updateTicket = "UPDATE " . $this->ticketTable . " 
				SET last_reply = '" . $_SESSION["userid"] . "', user_read = '0', admin_read = '0' 
				WHERE id = '" . $_POST['ticketId'] . "'";
			mysqli_query($this->dbConnect, $updateTicket);
		}
	}

	//get inquiry replies
	public function getTicketReplies($id)
	{
		$sqlQuery = "SELECT r.id, r.text as message, r.date, CONCAT(u.firstname, ' ', u.surname) as creator, u.email as email, d.name as department, u.user_group  
			FROM " . $this->ticketRepliesTable . " r
			LEFT JOIN " . $this->ticketTable . " i ON r.ticket_id = i.id
			LEFT JOIN users u ON r.user = u.id 
			LEFT JOIN departments d ON i.department = d.id 
			WHERE r.ticket_id = '" . $id . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$data = array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}

	//updating if the inquiry has been viewed
	public function updateTicketReadStatus($ticketId)
	{
		$updateField = '';
		if (isset($_SESSION["admin"])) {
			$updateField = "admin_read = '1'";
		} else {
			$updateField = "user_read = '1'";
		}
		$updateTicket = "UPDATE " . $this->ticketTable . " 
			SET $updateField
			WHERE id = '" . $ticketId . "'";
		mysqli_query($this->dbConnect, $updateTicket);
	}
}
