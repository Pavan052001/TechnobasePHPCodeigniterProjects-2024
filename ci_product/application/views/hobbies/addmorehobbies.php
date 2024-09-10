<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hobbies</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm">
        <form id="hobbyForm">
            <div id="hobbyList" class="form-group">
                <div class="input-group mb-3 hobbyItem">
                    <input type="text" name="hobby_title[]" id="name" class="form-control" placeholder="Enter Hobby" onkeypress="return alphaonly(event)" Required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger removeHobby">Remove</button>
                    </div>
                </div>
            </div>
            <button type="button" id="addHobby" class="btn btn-success btn-block mb-3">Add Another Hobby</button>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
        <div id="response" class="alert mt-3 d-none"></div>
    </div>

    <script>
        $(document).ready(function() {
            // Event listener for adding another hobby input field
            $("#addHobby").click(function() {
                $("#hobbyList").append(`
                    <div class="input-group mb-3 hobbyItem">
                        <input type="text" name="hobby_title[]" class="form-control" placeholder="Enter Hobby">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger removeHobby">Remove</button>
                        </div>
                    </div>
                `);
            });

            // Event listener for removing a hobby input field
            $("#hobbyList").on('click', '.removeHobby', function() {
                $(this).closest('.hobbyItem').remove();
            });

            // Handle form submission with AJAX
            $("#hobbyForm").submit(function(e) {
                e.preventDefault(); // Prevent the form from submitting the traditional way

                $.ajax({
                    url: "<?php echo site_url('HobbieController/add_hobbies'); ?>",  // Replace with your controller/method
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        response = JSON.parse(response);
                        $("#response").removeClass('d-none alert-danger alert-success')
                                      .addClass(response.status === 'success' ? 'alert-success' : 'alert-danger')
                                      .html(response.message);
                    },
                    error: function() {
                        $("#response").removeClass('d-none').addClass('alert-danger').html("An error occurred.");
                    }
                });
            });
        });

        function validate(){

            var hobby = $("#name").val();
            var error = "Required";
            $("hobby_error").text();
            if(hobby==''){
                $("hobby_error").text(error);
                $("#name").focus();
                return false;
            }
        }
    </script>
    <script>
        //name
function alphaonly(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 65 || charCode > 122))
    return false;
  return true;

}
    </script>
</body>
</html>
