function addInput() {
  document.querySelector("#editPassword").innerHTML = `
        <div class="form-group">
        <label for="post_category">Password</label>
        <input type="password" class="form-control" name="user_password" value="" />
        </div>`;
}

$(document).ready(function() {
  ClassicEditor.create(document.querySelector("#body")).catch(error => {
    console.error(error);
  });

  $("#selectAllBoxes").click(function(event) {
    if (this.checked) {
      $(".checkBoxes").each(function() {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function() {
        this.checked = false;
      });
    }
  });
});

// function loadUsersOnline() {
//   $.get("classes/Users.php?onlineusers=result", function(data) {
//     $(".usersonline").text(data);
//   });
// }

// setInterval(function() {
//   loadUsersOnline();
// }, 500);
