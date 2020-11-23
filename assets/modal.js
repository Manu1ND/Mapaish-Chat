$(function () {
	// New Chat Room
	// Load New Chat Modal
	$("#newChatModalButton").on("click", function () {
		$('#chatModalTitle').text('New Chat');
		$.ajax({
			method: "POST",
			url: "backend/chat/chat/members.php",
			data: { type: "newChat", request: "single" },
			success: function (data) {
				var html = `
				<div class="form-group row">
					<label for="newChat" class="col-sm-3 col-form-label">Contacts</label>
					<div class="col-sm-9">
						<select class="selectpicker w-100" id="newChat" title="Empty" data-live-search="true"></select>
					</div>
				</div>`;
				$('#chatModalBody').html(html);
				var button = `<button type="button" id="newChatSubmit" class="btn btn-primary">New Chat</button>`;
				$('#chatModalButton').html(button);
				if (data) {
					data = JSON.parse(data);
					data.forEach(element => {
						$('#newChat').append(new Option(element.Name, element.Username));
					});
				}
				$(".selectpicker").selectpicker("refresh");
			}
		});
	});
	// Submit New Chat
	$(document).on("click", "#newChatSubmit", function () {
		if (!$('#newChat').val()) {
			alert("Select a contact");
		} else {
			var contact = $('#newChat').val();
			$.ajax({
				method: "POST",
				url: "backend/chat/chat/newChatRoom.php",
				data: { group: "0", members: contact },
				success: function (data) {
					console.log(data);
					$('#chatModal').modal('toggle');
				}
			});
		}
	});
	// Load New Group Modal
	$("#newGroupModalButton").on("click", function () {
		$('#chatModalTitle').text('New Group');
		$.ajax({
			method: "POST",
			url: "backend/chat/chat/members.php",
			data: { type: "newChat", request: "group" },
			success: function (data) {
				var html = `
				<div class="form-group row">
					<label for="groupName" class="col-sm-3 col-form-label">Group Name</label>
					<div class="col-sm-9">
						<input class="form-control" id="groupName" placeholder="Group Name">
					</div>
				</div>
				<div class="form-group row">
					<label for="newGroupMembers" class="col-sm-3 col-form-label">Contacts</label>
					<div class="col-sm-9">
						<select class="selectpicker w-100" id="newGroupMembers" multiple
							data-live-search="true" data-actions-box="true"></select>
					</div>
				</div>`;
				$('#chatModalBody').html(html);
				var button = `<button type="button" id="newGroupSubmit" class="btn btn-primary">New Group</button>`;
				$('#chatModalButton').html(button);
				if (data) {
					data = JSON.parse(data);
					data.forEach(element => {
						$('#newGroupMembers').append(new Option(element.Name, element.Username));
					});
				}
				$(".selectpicker").selectpicker("refresh");
			}
		});
	});
	// Submit New Group
	$(document).on("click", "#newGroupSubmit", function () {
		var valid = 1;
		if (!$('#groupName').val()) {
			alert("Enter Group Name");
			valid = 0;
		}
		if (!$('#newGroupMembers').val().length) {
			alert("Select atleast 1 member");
			valid = 0;
		}
		if (valid) {
			var groupName = $('#groupName').val();
			var members = JSON.stringify($('#newGroupMembers').val());
			$.ajax({
				method: "POST",
				url: "backend/chat/chat/newChatRoom.php",
				data: { group: "1", groupName: groupName, members: members },
				success: function (data) {
					console.log(data);
					$('#chatModal').modal('toggle');
				}
			});
		}
	});

	// Menu
	//Settings
	$("#changeNameModalButton").on("click", function () {
		$('#chatModalTitle').text('Change Name');
		var html = `
			<div class="form-group row">
				<label for="changeName" class="col-sm-4 col-form-label">Name</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="changeName"></input>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Profile Picture</label>
				<div class="col-sm-8">
					<img name="imgLink" class="mb-2" id="picturePreview" src=""
						alt="Group Picture" width="100" height="100"  style="border-radius: 40px" />
					<button class="btn btn-primary" id="removePicture" value="0">Remove Picture</button>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="changePicture">
						<label class="custom-file-label" id="pictureLabel" for="changePicture">Choose Image</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label for="changeStatus" class="col-sm-4 col-form-label">Status</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="changeStatus"></input>
				</div>
			</div>`;
		$('#chatModalBody').html(html);
		$.ajax({
			method: "POST",
			url: "backend/chat/member/info.php",
			success: function (data) {
				if (data) {
					var data = JSON.parse(data);
					$('#changeName').val(data.name);
					$('#changeStatus').val(data.status);
					var profilePicture = data.profilePicture;
					if (!profilePicture) {
						profilePicture = "https://www.seekpng.com/png/detail/966-9665493_my-profile-icon-blank-profile-image-circle.png";
						$('#removePicture').val(1);
					}
					$('#picturePreview').attr("src", profilePicture);
				}
			}
		});
		var button = `<button type="button" id="changeSettingsSubmit" class="btn btn-primary">Save</button>`;
		$('#chatModalButton').html(button);
	});
	// Settings Submit
	$(document).on("click", "#changeSettingsSubmit", function () {
		var name = $('#changeName').val();
		var profilePicture = $('#changePicture')[0].files[0];
		var removeProfilePicture = $('#removePicture').val();
		var imgLink = $('#picturePreview').attr("src");
		var status = $('#changeStatus').val();
		var formdata = new FormData();
		formdata.append('name', name);
		formdata.append('profilePicture', profilePicture);
		formdata.append('removeProfilePicture', removeProfilePicture);
		formdata.append('imgLink', imgLink);
		formdata.append('status', status);
		$.ajax({
			method: "POST",
			url: "backend/chat/member/settings.php",
			data: formdata,
			processData: false,
			contentType: false,
			success: function (data) {
				console.log(data);
				$('#chatModal').modal('toggle');
			}
		});
	});
	// Change Password
	$("#changePasswordModalButton").on("click", function () {
		$('#chatModalTitle').text('Change Password');
		var html = `
			<div class="form-group row">
				<label for="password" class="col-sm-4 col-form-label">Password</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="password"></input>
				</div>
			</div>
			<div class="form-group row">
				<label for="confirmPassword" class="col-sm-4 col-form-label">Re-Enter Password</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="confirmPassword"></input>
				</div>
			</div>`;
		$('#chatModalBody').html(html);
	});

	// Group Settings
	// Add Members Modal
	$("#addMemberModalButton").on("click", function () {
		$('#chatModalTitle').text('Add members');
		var roomID = $('#roomID').val();
		$.ajax({
			method: "POST",
			url: "backend/chat/chat/members.php",
			data: { type: "modifyGroup", request: "add", roomID: roomID },
			success: function (data) {
				var html = `
				<div class="form-group row">
					<label for="addGroupMembers" class="col-sm-3 col-form-label">Contacts</label>
					<div class="col-sm-9">
						<select class="selectpicker w-100" id="addGroupMembers" multiple
							data-live-search="true" data-actions-box="true"></select>
					</div>
				</div>`;
				$('#chatModalBody').html(html);
				var button = `<button type="button" id="addGroupMembersSubmit" class="btn btn-primary">Add</button>`;
				$('#chatModalButton').html(button);
				if (data) {
					data = JSON.parse(data);
					data.forEach(element => {
						$('#addGroupMembers').append(new Option(element.Name, element.Username));
					});
				}
				$(".selectpicker").selectpicker("refresh");
			}
		});
	});
	// Add Members Submit
	$(document).on("click", "#addGroupMembersSubmit", function () {
		if (!$('#addGroupMembers').val().length) {
			alert("Select atleast 1 member");
		} else {
			var members = JSON.stringify($('#addGroupMembers').val());
			var roomID = $('#roomID').val();
			$.ajax({
				method: "POST",
				url: "backend/chat/group/changeGroupMembers.php",
				data: { request: "add", roomID: roomID, members: members },
				success: function (data) {
					console.log(data);
					$('#chatModal').modal('toggle');
				}
			});
		}
	});
	// Remove Members Modal
	$("#removeMemberModalButton").on("click", function () {
		$('#chatModalTitle').text('Remove members');
		var roomID = $('#roomID').val();
		$.ajax({
			method: "POST",
			url: "backend/chat/chat/members.php",
			data: { type: "modifyGroup", request: "remove", roomID: roomID },
			success: function (data) {
				var html = `
				<div class="form-group row">
					<label for="removeGroupMembers" class="col-sm-3 col-form-label">Contacts</label>
					<div class="col-sm-9">
						<select class="selectpicker w-100" id="removeGroupMembers" multiple
							data-live-search="true" data-actions-box="true"></select>
					</div>
				</div>`;
				$('#chatModalBody').html(html);
				var button = `<button type="button" id="removeGroupMembersSubmit" class="btn btn-primary">Remove</button>`;
				$('#chatModalButton').html(button);
				if (data) {
					data = JSON.parse(data);
					data.forEach(element => {
						$('#removeGroupMembers').append(new Option(element.Name, element.Username));
					});
				}
				$(".selectpicker").selectpicker("refresh");
			}
		});
	});
	// Remove Members Submit
	$(document).on("click", "#removeGroupMembersSubmit", function () {
		if (!$('#removeGroupMembers').val().length) {
			alert("Select atleast 1 member");
		} else {
			var members = JSON.stringify($('#removeGroupMembers').val());
			var roomID = $('#roomID').val();
			$.ajax({
				method: "POST",
				url: "backend/chat/group/changeGroupMembers.php",
				data: { request: "remove", roomID: roomID, members: members },
				success: function (data) {
					$('#chatModal').modal('toggle');
				}
			});
		}
	});
	// Group Settings Modal
	$("#changeGroupNameModalButton").on("click", function () {
		$('#chatModalTitle').text('Group Settings');
		var html = `
			<div class="form-group row">
				<label for="changeGroupName" class="col-sm-4 col-form-label">Group Name</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="changeGroupName"></input>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Group Picture</label>
				<div class="col-sm-8">
					<img name="imgLink" class="mb-2" id="picturePreview" src=""
						alt="Group Picture" width="100" height="100"  style="border-radius: 40px" />
					<button class="btn btn-primary" id="removePicture" value="0">Remove Picture</button>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="changePicture">
						<label class="custom-file-label" id="pictureLabel" for="changePicture">Choose Image</label>
					</div>
				</div>
			</div>`;
		$('#chatModalBody').html(html);
		var roomID = $('#roomID').val();
		$.ajax({
			method: "POST",
			url: "backend/chat/group/loadGroupSettings.php",
			data: { roomID: roomID },
			success: function (data) {
				if (data) {
					var data = JSON.parse(data);
					$('#changeGroupName').val(data.groupName);
					var groupPicture = data.groupPicture;
					if (!groupPicture) {
						groupPicture = "https://www.seekpng.com/png/detail/966-9665493_my-profile-icon-blank-profile-image-circle.png";
						$('#removePicture').val(1);
					}
					$('#picturePreview').attr("src", groupPicture);
				}
			}
		});
		var button = `<button type="button" id="changeGroupSettingsSubmit" class="btn btn-primary">Save</button>`;
		$('#chatModalButton').html(button);
	});
	// Group Settings Submit
	$(document).on("click", "#changeGroupSettingsSubmit", function () {
		var roomID = $('#roomID').val();
		var groupName = $('#changeGroupName').val();
		var groupPicture = $('#changePicture')[0].files[0];
		var removeGroupPicture = $('#removePicture').val();
		var imgLink = $('#picturePreview').attr("src");
		var formdata = new FormData();
		formdata.append('roomID', roomID);
		formdata.append('groupName', groupName);
		formdata.append('groupPicture', groupPicture);
		formdata.append('removeGroupPicture', removeGroupPicture);
		formdata.append('imgLink', imgLink);
		$.ajax({
			method: "POST",
			url: "backend/chat/group/groupSettings.php",
			data: formdata,
			processData: false,
			contentType: false,
			success: function (data) {
				console.log(data);
				$('#chatModal').modal('toggle');
			}
		});
	});

	// upload image
	$(document).on("change", "#changePicture", function () {
		$('#picturePreview').attr("src", window.URL.createObjectURL(this.files[0]));
		$('#removePicture').val(0);
	});
	// remove image
	$(document).on("click", "#removePicture", function () {
		$('#picturePreview').attr("src", "https://www.seekpng.com/png/detail/966-9665493_my-profile-icon-blank-profile-image-circle.png");
		var fileName = "Choose Image";
		$("#pictureLabel").removeClass("selected").html(fileName);
		$('#changePicture').val('');
		$('#removePicture').val(1);
	});
	// image name
	$(document).on("change", ".custom-file-input", function () {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
});