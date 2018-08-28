
$(document).ready(function() {
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

        console.log(data);

        return false;
    });
});