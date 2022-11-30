<!doctype html>
<html>
<head>
<style>
form label {
  display: inline-block;
  width: 100px;
}

form div {
  margin-bottom: 10px;
}

.error {
  color: red;
  margin-left: 5px;
}

label.error {
  display: inline;
}
</style>
</head>
<body>
<!-- First Form -->
<h2>Example 1:</h2>
<form id="first_form" method="post" action="">
   <div>
    <label for="first_name">Branch:</label>
    <select id="branch_id" name="branch_id">
		<option value="">--Select --Branch</option>
		<option value="Hello">Hello</option>
		<option value="Hello">Hello</option>
		<option value="Hello">Hello</option>
	</select>
  </div>
  <div>
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name"></input>
  </div>
  <div>
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name"></input>
  </div>
  <div>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"></input>
  </div>
  <div>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"></input>
  </div>
  <div>
    <input type="submit" value="Submit" />
  </div>
</form>

<hr/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script>
$(document).ready(function() {
  againTest();
  $('#first_form').submit(function(e) {
    e.preventDefault();
	var branch_id = $('#branch_id').val();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $('#email').val();
    var password = $('#password').val();

    $(".error").remove();

    if (branch_id.length < 1) {
      $('#branch_id').after('<br><span class="error">Please Select Branch</span>');
    }
	if (first_name.length < 1) {
      $('#first_name').after('<span class="error">This field is required</span>');
    }
    if (last_name.length < 1) {
      $('#last_name').after('<span class="error">This field is required</span>');
    }
    if (email.length < 1) {
      $('#email').after('<span class="error">This field is required</span>');
    }
    if (password.length < 8) {
      $('#password').after('<span class="error">Password must be at least 8 characters long</span>');
    }
  });
  

});
</script>
<script>
function getData(){
	axios.get('http://127.0.0.1:8000/api/get-branches')
	  .then(function (response) {
		console.log(response);
	  })
	  .catch(function (error) {
		console.log(error);
	  });
}
function againTest(){
	$.get("http://127.0.0.1:8000/api/get-branches",function(data,status){
		console.log(data);
	});
}
</script>
</body>
</html>