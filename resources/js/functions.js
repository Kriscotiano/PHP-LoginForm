function trimVal(el) {
    return $.trim($(el).val());
}

function errorFalse(input, msg) {
    return input.html(`<div class='text-success'><i class='fa fa-check-circle'></i> ${msg}</div>`)
    .show();
}

function errorTrue(input, msg) {
    return input.html(`<div class='text-error'><i class='fa fa-check-circle'></i> ${msg}</div>`)
    .show();
}