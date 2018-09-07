function trimVal(el) {
    return $(el).trim.val();
}

function errorFalse(input, msg) {
    return input.html(`<div class='text-success'><i class='fa fa-check-circle'></i> ${msg}</div>`)
    .show();
}

function errorTrue(input, msg) {
    return input.html(`<div class='text-error'><i class='fa fa-check-circle'></i> ${msg}</div>`)
    .show();
}