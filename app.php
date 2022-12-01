<html>
<style>
    div,
    form,
    input,
    select,
    p {
        padding: 0;
        margin: 0;
        outline: none;
        font-family: Roboto, Arial, sans-serif;
        font-size: 16px;
        color: #eee;
    }

    h1,
    h2 {
        text-transform: uppercase;
        font-weight: 400;
        color: aliceblue;
    }

    h2 {
        margin: 0 0 0 8px;
    }

    .main-block {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 25px;
        background: url("https://www.w3docs.com//uploads/media/default/0001/01/b5edc1bad4dc8c20291c8394527cb2c5b43ee13c.jpeg") no-repeat center;
        background-size: cover;
    }

    .left-part,
    form {
        padding: 25px;
    }

    .left-part {
        text-align: center;
    }

    .fa-graduation-cap {
        font-size: 72px;
    }

    form {
        background: rgba(0, 0, 0, 0.7);
        border-radius: 10px;
    }

    .title {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .info {
        display: flex;
        flex-direction: column;
    }

    input,
    select {
        padding: 5px;
        margin-bottom: 30px;
        background: transparent;
        border: none;
        border-bottom: 1px solid #eee;
    }

    input::placeholder {
        color: #eee;
    }

    option:focus {
        border: none;
    }

    option {
        background: black;
        border: none;
    }

    .checkbox input {
        margin: 0 10px 0 0;
        vertical-align: middle;
    }

    .checkbox a {
        color: #26a9e0;
    }

    .checkbox a:hover {
        color: #85d6de;
    }
    .spn-msg {
        padding: 7px;
        margin-top: 4px;
        margin-bottom: 10px;
        color: #0db10d;
        font-size: 25px;
    }

    .btn-item,
    button {
        padding: 10px 5px;
        margin-top: 20px;
        border-radius: 5px;
        border: none;
        background: #26a9e0;
        text-decoration: none;
        font-size: 15px;
        font-weight: 400;
        color: #fff;
    }

    .btn-item {
        display: inline-block;
        margin: 20px 5px 0;
        padding: 5px;
        border-radius: 10px;
    }

    button {
        width: 100%;
    }

    button:hover,
    .btn-item:hover {
        background: #85d6de;
    }

    .error {
        color: red;
        margin-bottom: 15px;
    }

    @media (min-width: 568px) {

        html,
        body {
            height: 100%;
        }

        .main-block {
            flex-direction: row;
            height: calc(100% - 50px);
        }

        .left-part,
        form {
            flex: 1;
            height: auto;
        }
    }
</style>

<body>
    <div class="main-block">
        <div class="left-part">
            <i class="fas fa-graduation-cap"></i>
            <!-- <h1>Book you appointment</h1>
            <p>Our concern person communicate with you very soon</p>
            <div class="btn-group">
                <a class="btn-item" href="#">Call now</a>
                <a class="btn-item" href="#">Make Email</a>
            </div> -->
        </div>
        
        <form id="formid" method="post" action="#">
            <span style="display: none;" id="show-message" class="spn-msg"></span>
            <div class="title">
                <i class="fas fa-pencil-alt"></i>
                <h2>Book an Appointment</h2>
            </div>
            <div class="info">
                <label for="">Branch</label>
                <select name="branch_id" onchange="getCounselor()" id="branch_id">
                    <option value="" selected>--Select Branch--</option>
                </select>
                <span></span>
                <label for="">Consultant</label>
                <select name="counselor_id" id="counselor_id">
                    <option value="" selected>--Select Consultant--</option>
                </select>
                <label for="">Full Name</label>
                <input class="fname" type="text" id="name" name="name" placeholder="Full name">
                <label for="">Mobile Number</label>
                <input type="text" id="phone" name="phone" placeholder="Phone number">
                <label for="">Email Address</label>
                <input type="text" id="email" name="email" placeholder="Email">
                <label for="">Date of Birth</label>
                <input type="date" id="date_of_bith" name="date_of_bith" placeholder="Date of Birth">
                <label for="appointmenttime">Appointment Date & Time</label>
                <input type="datetime-local" id="appointment_date" name="appointment_date" id="">
                <label for="">Message</label>
                <textarea name="description" id="description" cols="30" rows="3"></textarea><br>
                <label for="">Is It Your First Visit</label>
                <select name="is_first_visit" id="is_first_visit">
                    <option value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>

            </div><br>
            <div class="checkbox">
                <input type="checkbox" name="checkbox"><span>I agree to the <a href="#">Privacy Policy</a></span>
            </div>
            <button id="submit-btn" type="submit" href="/">Submit</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            getBranches();
        });
    </script>
    <script>
        function getBranches() {
            $.get("http://127.0.0.1:8000/api/get-branches", function(data, status) {
                //console.log(data);
                $.each(data, function(i, branch) {
                    $('#branch_id').append('<option value="' + branch.id + '">' + branch.branch_name + '</option>');
                    console.log(branch.id);
                });
            });
        }

        function getCounselor() {
            var branch_id = $('#branch_id').val();
            if (branch_id === "") {
                return false;
            }
            $.get("https://staging-api.theleadlibrary.com/api/get-counsellor-by-branch-for-appointment/" + branch_id, function(data, status) {
                //console.log(data);
                if (data['result']['key'] === 101) {
                    alert(data['result']['val']);
                }
                if (data['result']['key'] === 200) {
                    $("#counselor_id").empty()
                    //console.log(data['result']['val']);
                    $('#counselor_id').append('<option value="">--Select Consultant--</option>');
                    $.each(data.result.val, function(i, counselor) {
                        $('#counselor_id').append('<option value="' + counselor.id + '">' + counselor.counselor_name + '</option>');
                    });
                }

            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#formid').validate({
                rules: {
                    branch_id: {
                        required: true
                    },
                    counselor_id: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    date_of_bith: {
                        required: true
                    },
                    is_first_visit: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    appointment_date: {
                        required: true
                    },
                },
                messages: {
                    branch_id: {
                        required: "Please Select Branch"
                    },
                    counselor_id: {
                        required: "Please Select Counselor"
                    },
                    email: {
                        required: "Email Field Is Required!",
                        email: "Email Must Be Valid Email Address!"
                    },
                    name: {
                        required: "Full Name Field Is Required!",
                    },
                    phone: {
                        required: "Phone Number Field Is Required!",
                    },
                    date_of_bith: {
                        required: "Date of Birth Field Is Required!",
                    },
                    is_first_visit: {
                        required: "Please Select Your Visit Status!",
                    },
                    description: {
                        required: "Message Field is Required!",
                    },
                    appointment_date: {
                        required: "Appointment Date Time Field is Required!",
                    }
                },
                submitHandler: function(form) {
                    $('#submit-btn').prop('disabled', true);
                    var dataval = {
                        branch_id: $('#branch_id').val(),
                        counselor_id: $('#counselor_id').val(),
                        email: $('#email').val(),
                        name: $('#name').val(),
                        phone: $('#phone').val(),
                        date_of_bith: $('#date_of_bith').val(),
                        is_first_visit: $('#is_first_visit').val(),
                        description: $('#description').val(),
                        appointment_date: $('#appointment_date').val(),
                    };
                    var formdata = JSON.stringify(dataval);
                    //alert(JSON.stringify(data));
                    //console.log(JSON.stringify(data));
                    $.get("https://staging-api.theleadlibrary.com/api/book-appointment-submit/" + formdata, function(data, status) {
                        console.log(data);
                        if (data['result']['key'] === 101) {
                            $('#submit-btn').prop('disabled', false);
                            alert(data['result']['val']);
                        }
                        if (data['result']['key'] === 200) {
                            $('#submit-btn').prop('disabled', false);
                            $("#formid")[0].reset();
                            $("#show-message").show();
                            $("#show-message").html(data['result']['val']);
                            window.scrollTo(0, 0);
                        }

                    });
                    //    var action="http://127.0.0.1:8000/api/book-appointment-submit";
                    //    //alert('hello world');
                    //    $.ajax({
                    //        url : action,
                    //        data:$(form).serialize(),
                    //        type : 'get',
                    //        success : function(result){
                    //            // alert(result.url);
                    //            console.log(result);
                    //        },
                    //        error:function (response) {
                    //            console.log(response);
                    //        }
                    //    });
                }
            });
        });
    </script>
</body>

</html>