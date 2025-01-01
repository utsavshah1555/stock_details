

$(document).ready(function(){
    $('#login-form').submit(function(){

        $('#login-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                email: {
                    required: "Please enter email address",
                    email: "Please enter valid email address"
                },
                password: {
                    required: 'Please enter passowrd',
                },

            },
            submitHandler: function(form, event) {
                // Prevent the default form submission
                event.preventDefault();

                // Prepare the form data
                var formData = $(form).serialize();
                console.log(formData);
                // return


                // Send the AJAX request
                $.ajax({
                    url: loginUrl,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle the response from the server
                        // You can use the response to show messages or redirect
                        if (response.status) {
                            console.log('succees');
                            console.log(response);

                        } else {
                            console.log(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle any AJAX errors
                        console.log(error);
                    }
                });
            }
        });
    })

})
