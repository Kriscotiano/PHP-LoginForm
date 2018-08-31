$(document).ready(function() {
    let eError = $('.email-error');
    let pError = $('.password-error');
    let cError = $('.confirm-error');

    let emailReg = /^[@]+$/i;

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
                        } else if (!data['valid']) {
                            $('.email-validation')
                                .html("<div class='text-error'><i class='fa fa-check-circle'></i> Not Available</div>")
                                .show();
                        }
                    }, 1000)
                })
            } else {
                $('.email-validation')
                    .html('<div class="invalid">Must contain at least one @ symbol</div>')
                    .show();
            }
        }, 1500));
    
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


        return false;
    });

});