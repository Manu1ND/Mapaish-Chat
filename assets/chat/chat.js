var chatRoomsJson = '';
var chatJson = '';
var username = "Manu1ND";

$(function () {
	setInterval(function () {
		$.ajax({
			method: "POST",
			url: "backend/chat/chat/loadChatRoom.php",
			success: function (data) {
				var html = '';
				if (chatRoomsJson != data && data != '') {
					chatRoomsJson = data;
					chatRooms = JSON.parse(data);
					chatRooms.forEach(chatRoom => {
						html += `
						<div class="chatRoom">
							<div class="friend-drawer friend-drawer--onhover" onClick="clickChat(`+ chatRoom.roomID + `, ` + chatRoom.isGroup + `)">
								<img class="profile-image"
									src="`;
						if (chatRoom.picture) {
							html += chatRoom.picture;
						} else {
							html += `assets/images/profilePicture.png`;
						}
						html += `"
									alt="">
								<div class="text">
									<h6>`+ chatRoom.chatName + `</h6>
									<p class="text-muted">`;
						if (chatRoom.senderUsername == username) {
							html += `[You]: `;
						} else {
							html += `[` + chatRoom.senderName + `]: `;
						}
						html += chatRoom.message + `</p>
								</div>
								<span class="time text-muted small">`+ chatRoom.time + `</span>
							</div>
							<hr>
						</div>`;
					});
					$("#chatRooms").html(html);
				}
			}
		});
	}, 500);

	// update chat
	setInterval(function () {
		$.ajax({
			method: "POST",
			url: "backend/chat/chat/loadProfilePicture.php",
			success: function (data) {
				if (data) {
					var imgLink = data;
				} else {
					var imgLink = 'assets/images/profilePicture.png';
				}
				if ($('#profilePicture').attr("src") != imgLink) {
					$('#profilePicture').attr("src", imgLink);
				}
			}
		});
	}, 500);

	// update profile picture
	setInterval(function () {
		if ($('#roomID').val()) {
			var roomID = $('#roomID').val();
			loadChat(roomID);
		}
	}, 500);

	// enter key triggers button click
	$('#inputMessage').on("keypress", function (e) {
		if (e.which === 13) {
			$('#sendMessage').trigger("click");
		}
	});

	// send message
	$('#sendMessage').on("click", function () {
		var roomID = $('#roomID').val();
		var message = $('#inputMessage').val();
		if (message) {
			$.ajax({
				method: "POST",
				url: "backend/chat/chat/sendMsg.php",
				data: {
					roomID: roomID,
					message: message
				},
				success: function (data) {
					console.log(data);
					loadChat(roomID);
					$('#inputMessage').val('');
				}
			});
		}
	});

	// filter chat
	$("#filterChatroom").on("keyup", function () {
		var searchFilter = $(this).val().toLowerCase();
		$(".chatRoom").filter(function () {
			$(this).toggle(
				$(this).find('h6').text().toLowerCase().indexOf(searchFilter) > -1);
		});
	});
});

function clickChat(roomID, isGroup) {
	if ($('#roomID').val() != roomID) {
		$("#chat-panel").html('');
		$('#roomID').val(roomID);
		if (isGroup) {
			$('#groupSettingsMenu').removeAttr('hidden');
		} else {
			$('#groupSettingsMenu').attr('hidden', true);
		}
		loadChat(roomID).then(() => {
			$('.chat-bubble').finish();
			$('.chat-bubble').show('slow');
			$("#chat-panel").animate({ scrollTop: $("#chat-panel").prop("scrollHeight")}, 1000);
		});
	}
	if ($('.search-bar').attr('hidden')) {
		$('.search-bar').removeAttr('hidden').hide().show('slow');
		$('#dropdownGroupMenuButton').removeAttr('hidden').hide().show('slow');
	}
};

function loadChat(roomID) {
	if ($('.chatMessage').length) {
		var message = document.getElementsByClassName("chatMessage");
		var lastID = message[message.length - 1].id;
	} else {
		lastID = 0;
	}
	return $.ajax({
		method: "POST",
		url: "backend/chat/chat/loadChat.php",
		data: {
			roomID: roomID,
			lastID: lastID
		},
		success: function (data) {
			var html = '';
			if (chatJson != data && data != '') {
				chatJson = data;
				chatRoom = JSON.parse(data);
				chatRoomInfo = chatRoom.roomInfo;
				$('#chatName').text(chatRoomInfo.chatName);
				$('#status').text(chatRoomInfo.status);
				if (chatRoomInfo.picture) {
					$('#chatPicture').attr("src", chatRoomInfo.picture);
				} else {
					$('#chatPicture').attr("src", "assets/images/profilePicture.png");
				}
				chat = chatRoom.message;
				if (chat) {
					chat.forEach(chatMessage => {
						html += `
						<div id="`+ chatMessage.messageID + `" class="row no-gutters chatMessage">`;
						if (parseInt(chatMessage.isGroup) && chatMessage.name) {
							html += `<div class="col-md-3">
										<div class="chat-bubble chat-bubble--left">
											<div class="chat-bubble--title">` + chatMessage.name + `</div>`;
						} else if (chatMessage.name) {
							html += `<div class="col-md-3">
										<div class="chat-bubble chat-bubble--left">`;
						} else {
							html += `<div class="col-md-3 offset-md-9">
										<div class="chat-bubble chat-bubble--right">`;
						}
						html += chatMessage.message + `
									<div class="chat-bubble--time">` + chatMessage.time + `</div>
								</div>
							</div>
						</div>`;
					});
					$("#chat-panel").append(html);
					$("#chat-panel").animate({ scrollTop: $("#chat-panel").prop("scrollHeight")}, 500);
				}
			}
		}
	});
}