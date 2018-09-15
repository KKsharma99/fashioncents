<script type="text/javascript">
	
	function follow(c, a, b, username) {
		$.ajax({
			url: 'followuser.php',
			type: 'post',
			data: {uid: c, id: a, status: b, username : username},
			success: function(data) {
				var follownames = document.getElementsByName("follow".concat(c));
				var followlist = Array.prototype.slice.call(follownames);
				var followbutton = document.getElementById("followbutton")
				var followbuttonxs = document.getElementById("followbutton-xs")
				if (data == "1") {
					for ( var count = 0; count < followlist.length; count++) {
						var followtext = followlist[count];
						$(followtext).html('Following');
						followlist[count].setAttribute("onclick", "follow(" + c + ", " + a + ", 2, '" + username + "');");
					}
					$('#followbutton').html('Unfollow');
						followbutton.setAttribute("onclick", "follow(" + c + ", " + a + ", 2, '" + username + "');");
						$('#followbutton-xs').html('Unfollow');
						followbuttonxs.setAttribute("onclick", "follow(" + c + ", " + a + ", 2, '" + username + "');");
				} else
				if (data == "2") {
					for( var count = 0; count < followlist.length; count++) {
						var followtext = followlist[count];
						$(followtext).html('Follow');
						followlist[count].setAttribute("onclick", "follow(" + c + ", " + a + ", 1, '" + username + "');");
					}
					$('#followbutton').html('Follow');
						followbutton.setAttribute("onclick", "follow(" + c + ", " + a + ", 1, '" + username + "');");
						$('#followbutton-xs').html('Follow');
						followbuttonxs.setAttribute("onclick", "follow(" + c + ", " + a + ", 1, '" + username + "');");
				}
			}
		})
	}

	function save(a, b, c) {
		$.ajax({
			url: 'savepost.php',
			type: 'post',
			data: {postid: a, status:b, uid: c},
			success: function(data) {
				var loc = document.getElementById("save".concat(a));
				if (data == "1") {
					loc.src = 'vendor/custom-icons/bookmark-active.png';
					loc.setAttribute("onclick", "save(" + a + ", 2, " + c + ");");
				} else
				if (data == "2") {
					loc.src = 'vendor/custom-icons/bookmark.png';
					loc.setAttribute("onclick", "save(" + a + ", 1, " + c + ");");
				}
			}
		})
	}
	var likeflag = true;
	function like(a, b, c, posterid, username) {
		if(likeflag) {
			likeflag = false;
			$.ajax({
				url: 'likepost.php',
				type: 'post',
				data: {postid: a, status:b, uid: c, posterid:posterid, username: username},
				success: function(data) {
			//$('#container').append(data);
			var loc = document.getElementById("like".concat(a));
			var likes = document.getElementById("likebox".concat(a));
			var imgloc = document.getElementById("img".concat(a));
			var numlikes = $('#likebox'.concat(a)).children().html();
			if (data == "1") {
				loc.src = 'vendor/custom-icons/heart2.png';
				loc.setAttribute("onclick", "like(" + a + ", 2, " + c + "," + posterid + ",'" + username + "');");
				imgloc.removeAttribute("ondblclick");
				numlikes++;
				$('#likebox'.concat(a)).children().html(numlikes);
				likes.setAttribute("data-original-title", numlikes + " Likes").html();
			} else
			if (data == "2") {
				loc.src = 'vendor/custom-icons/heart.png';
				loc.setAttribute("onclick", "like(" + a + ", 1," + c + "," + posterid + ",'" + username + "');");
				imgloc.setAttribute("ondblclick", "like(" + a + ", 1," + c + "," + posterid + ",'" + username + "');");
				numlikes--;
				$('#likebox'.concat(a)).children().html(numlikes);
				likes.setAttribute("data-original-title", numlikes + " Likes").html();
			}
		}
	});
			likeflag = true
		}
	}
	function commentlike(a, b, c, posterid, username) {
		$.ajax({
			url: 'likecomment.php',
			type: 'post',
			data: {commentid: a, status:b, uid: c, posterid:posterid, username:username},
			success: function(data) {
				var loc = document.getElementById("comment".concat(a));
			//var likes = document.getElementById("commentcount".concat(a));
			var numlikes = $('#commentcount'.concat(a)).html();
			if (data == "1") {
				loc.src = 'vendor/custom-icons/heart2.png';
				loc.setAttribute("onclick", "commentlike(" + a + ", 2, " + c + "," + posterid + ",'" + username + "');");
				numlikes++;
				$('#commentcount'.concat(a)).html(numlikes);
			} else
			if (data == "2") {
				loc.src = 'vendor/custom-icons/heart.png';
				loc.setAttribute("onclick", "commentlike(" + a + ", 1," + c + "," + posterid + ",'" + username + "');");
				numlikes--;
				$('#commentcount'.concat(a)).html(numlikes);
			}
			
		}
	})
	}
	function comment(a, b) {
		var commentbox = document.getElementById("commentbox".concat(a));
		if (commentbox.value != "") {
			var text = commentbox.value;
			commentbox.value = "";
			$.ajax({
				url: 'addcomment.php',
				type: 'post',
				data: {postid: a, uid: b, comment: text},
				success: function(data) {
					$('#commentlist' + a).append(data);
				}
			})
		}
	}
	function deletepost(a) {
		$.ajax({
			url: 'deletepost.php',
			type: 'post',
			data: {postid: a},
			success: function(data) {
				if (data == 1) {
					$('#post'.concat(a)).remove();
					hideDeleteModal();
				}
			}
		})
	}

	function logout() {
		$.ajax({
			url: 'logout.php',
			type: 'post',
			data: {},
			success: function(data) {
				window.location = "index.php";
			}
		});
	}

	function clicktrack(visitid, itemid, location){
		$.ajax({
			url: 'clicktracker.php',
			type: 'post',
			data: {visitid: visitid, itemid: itemid, location: location}
		});
	}




//window.onload = function () {
	var isActive = true;
	var firstpageload = true;
	var timer = 0;

	window.onfocus = function () { 
		isActive = true; 
	}; 

	window.onblur = function () { 
		isActive = false; 
	}; 

	setInterval(function () { 
		//console.log(window.isActive ? 'active' : 'inactive');
		if(window.isActive) {
			$.ajax({
			url: 'sessiontimer.php',
			type: 'post',
			data: {time : timer, firstload : firstpageload},
			success: function(data) {
				if(firstpageload) {
					timer = parseInt(data, 10);
					firstpageload = false;
				}
			}
			});
			timer+=1;
		} 
	}, 1000);
//}
</script>
