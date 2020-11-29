<?php
include("backend/session.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon"
		href="https://static.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">
	<title>Mapaish</title>
	<link rel="stylesheet" href="assets/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/node_modules/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="assets/node_modules/material-icons/iconfont/material-icons.css">
	<link rel="stylesheet" href="assets/chat/chat.css">

</head>

<body>

	<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-md-4 border-right">
				<div class="settings-tray">
					<img class="profile-image" id="profilePicture" alt="Profile img">
					<span class="settings-tray--right">
						<!-- <i class="material-icons">cached</i> -->
						<!-- New chat Modal buttons -->
						<i class="dropdown">
							<i class="material-icons" type="button" id="dropdownChatButton" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								message
							</i>
							<div class="dropdown-menu" aria-labelledby="dropdownChatButton">
								<a class="dropdown-item" id="newChatModalButton" href="#" data-toggle="modal"
									data-target="#chatModal">Start New Chat</a>
								<a class="dropdown-item" id="newGroupModalButton" href="#" data-toggle="modal"
									data-target="#chatModal">Create New Group</a>
							</div>
						</i>

						<!-- Button trigger modal -->
						<i class="dropdown">
							<i class="material-icons" id="dropdownMenuButton" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">menu</i>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" id="settingsModalButton" data-toggle="modal"
									data-target="#chatModal">Settings</a>
								<a class="dropdown-item" id="changePasswordModalButton" data-toggle="modal"
									data-target="#chatModal">Change Password</a>
								<a class="dropdown-item" href="backend/login/logout.php">Logout</a>
							</div>
						</i>
					</span>
				</div>

				<div class="search-box">
					<div class="input-wrapper">
						<i class="material-icons">search</i>
						<input id="filterChatroom" placeholder="Search here" type="text">
					</div>
				</div>
				<div class="chatRooms" id="chatRooms"></div>
			</div>

			<div class="col-md-8">
				<div class="settings-tray">
					<div class="friend-drawer no-gutters friend-drawer--grey">
						<img class="profile-image" id="chatPicture" alt="">
						<div class="text">
							<h6 id="chatName" style="color: white;"></h6>
							<p class="text-muted" id="status"></p>
						</div>
						<span class="settings-tray--right" id="groupSettingsMenu" hidden>
							<i class="dropdown">
								<i class="material-icons" type="button" id="dropdownGroupMenuButton"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" hidden>
									menu
								</i>
								<div class="dropdown-menu" aria-labelledby="dropdownGroupMenuButton">
									<a class="dropdown-item" id="addMemberModalButton" href="#" data-toggle="modal"
										data-target="#chatModal">Add Member</a>
									<a class="dropdown-item" id="removeMemberModalButton" href="#" data-toggle="modal"
										data-target="#chatModal">Remove Member</a>
									<a class="dropdown-item" id="changeGroupNameModalButton" href="#"
										data-toggle="modal" data-target="#chatModal">Group Settings</a>
								</div>
							</i>
						</span>
					</div>
				</div>
				<div class="chat-section">
					<div id="chat-panel" class="chat-panel"></div>
					<div class="row search-bar" hidden>
						<div class="col-12">
							<div class="chat-box-tray">
								<input type="text" id="inputMessage" placeholder="Type your message here...">
								<!--Changes made-->
								<i class="material-icons" id="sendMessage">send</i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalTitle"
			aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<h5 class="modal-title" id="chatModalTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body" id="chatModalBody"></div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<div id="chatModalButton"></div>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" id="roomID" value="" />
		<input type="hidden" id="isGroup" value="" />
	</div>

	<script src="assets/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="assets/chat/chat.js"></script>
	<script src="assets/chat/modal.js"></script>

</body>

</html>