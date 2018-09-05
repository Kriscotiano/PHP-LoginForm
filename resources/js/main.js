$(document).ready(function() {
    //Globals
    let passwordReg = /^(?=.*[0-9])[\w.!#$&*+]{6,}$/;
    let validation = [
        { 
            name: $('.email-validation'), 
            successMsg: 'Available',
            failMsg: [
                'Email already exists',
                'Must contain at least one @ symbol'
            ]
        },
        {
            name: $('.password-validation'),
            successMsg: '',
            failMsg: 'Must contain at least 6 characters & 1 integer'
        },
        {
            name: $('.confirm-validation'),
            successMsg: '',
            failMsg: 'Passwords do not match'
        }
    ];

    //Email Validation
    $('#email')
        .on('input', _.debounce(async function() {    
            if (trimVal('#email').indexOf("@")!=-1) {
                $.ajax({
                    type: 'POST',
                    url: 'ajax/validate_email.php',
                    data: {
                        email: trimVal('#email')
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('.email-validation')
                            .html('<i class="fa fa-spinner fa-pulse fa-fw"></i>')
                            .show();
                    },
                    success: _.debounce(async function(data) {
                        if (data['valid'] && trimVal('#email').indexOf("@")!=-1) {
                            errorFalse(validation[0].name, validation[0].successMsg);
                        } else if (!data['valid']) {
                            errorTrue(validation[0].name, validation[0].failMsg[0]);
                        }
                    }, 1000)
                })          
            } else {
                errorTrue(validation[0].name, validation[0].failMsg[1]);
            }
        }, 1500));
    
    //Password Validation
    $('#password').on('input', _.debounce(async function() {
        if (passwordReg.test(trimVal('#password'))) {
            errorFalse(validation[1].name, validation[1].successMsg);
        } else {
            errorTrue(validation[1].name, validation[1].failMsg);
        }
    }, 1500));

    //Confirm Password Validation
    $('#confirm').on('input', _.debounce(async function() {
        if (trimVal('#confirm') === trimVal('#password')) {
            errorFalse(validation[2].name, validation[2].successMsg);
        } else {
            errorTrue(validation[2].name, validation[2].failMsg);
        }
    }, 1500));

    //Form Submission Validation
    $(document)
    .on('submit', '.js-register', function(event) {
        event.preventDefault();

        let form = $(this);
        let error = form.find('.js-error');
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
                if (data.redirect !== undefined) {
                    window.location = data.redirect;
                } else if (data.error !== undefined) {
                    error.html(data.error).show();
                }
            }
        });
        
        return false;
    });

    $(document)
    .on('submit', '.js-login', function(event) {
        event.preventDefault();

        let form = $(this);
        let error = form.find('.js-error');
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
                    error.html(data.error).show().delay(6000).fadeOut();
                }
            }
        });
        
        return false;
    });

});