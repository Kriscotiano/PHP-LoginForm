$(document).ready(function() {

    let passwordReg = /^(?=.*[0-9])[\w.!#$&*+]{6,}$/;
    let email = '';
    let password = '';
    let confirm = '';

    //Email Validation
    $('#email')
        .on('input', _.debounce(async function() {
            let emailVal = $.trim($('#email').val());
                
            if (emailVal.indexOf("@")!=-1) {
                $.ajax({
                    type: 'POST',
                    url: 'ajax/validate_email.php',
                    data: {
                        email: emailVal
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('.email-validation')
                            .html('<i class="fa fa-spinner fa-pulse fa-fw"></i>')
                            .show();
                    },
                    success: _.debounce(async function(data) {
                        if (data['valid'] && emailVal.indexOf("@")!=-1) {
                            $('.email-validation')
                                .html("<div class='text-success'><i class='fa fa-check-circle'></i> Available</div>")
                                .show();
                                email = emailVal;
                        } else if (!data['valid']) {
                            $('.email-validation')
                                .html("<div class='text-error'><i class='fa fa-check-circle'></i> Not Available</div>")
                                .show();
                                email = '';
                        }
                    }, 1000)
                })
            } else {
                $('.email-validation')
                    .html('<div class="invalid">Must contain at least one @ symbol</div>')
                    .show();
                    email = '';
            }
        }, 1500));
    
    //Password Validation
    $('#password').on('input', _.debounce(async function() {
        let passwordVal = $.trim($('#password').val());

        if (passwordReg.test(passwordVal)) {
            $('.password-validation')
                .html("<div class='text-success'><i class='fa fa-check-circle'></i></div>")
                .show();
                password = passwordVal;
        } else {
            $('.password-validation') 
                .html("<div class='text-error'><i class='fa fa-check-circle'></i> Must contain at least 6 characters & 1 integer.</div>")
                .show();
                password = '';
        }
    }, 1500));

    //Confirm Password Validation
    $('#confirm').on('input', _.debounce(async function() {
        let confirmVal = $.trim($('#confirm').val());

        if (confirmVal === $('#password').val()) {
            $('.confirm-validation')
                .html("<div class='text-success'><i class='fa fa-check-circle'></i></div>")
                .show();
                confirm = confirmVal;
        } else {
            $('.confirm-validation')
                .html("<div class='text-error'><i class='fa fa-check-circle'></i> Passwords do not match.</div>")
                .show();
                confirm = '';
        }
    }, 1500));

    //Form Submission Validation
    $(document)
    .on('submit', '.js-register', function(event) {
        event.preventDefault();

        let form = $(this);
        let data = {
            //form.find looks through just the form instead of having to search through entire html
            email: form.find("input[type='email']").val(),
            password: form.find("#password.input[type='password']").val(),
            confirm: form.find("#confirm.input[type='password']").val()  
        }

        $.ajax({
            type: 'POST',
            url: 'ajax/register.php',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                if (data.redirect !== undefined) {
                    window.location = data.redirect;
                } else if (data.error !== undefined) {
                    _error.text(data.error).show();
                }
            }
        });
        
        return false;
    });

    $(document)
    .on('submit', '.js-login', function(event) {
        event.preventDefault();

        let form = $(this);
        let data = {
            //form.find looks through just the form instead of having to search through entire html
            email: form.find("input[type='email']").val(),
            password: form.find("#password.input[type='password']").val()
        }

        $.ajax({
            type: 'POST',
            url: 'ajax/login.php',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                if (data.redirect !== undefined) {
                    window.location = data.redirect;
                } else if (data.error !== undefined) {
                    _error.html(data.error).show();
                }
            }
        });
        
        return false;
    });

});