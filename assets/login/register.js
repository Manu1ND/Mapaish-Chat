$.validator.addMethod('regex', function (value, element, param) {
    return this.optional(element) ||
        value.match(typeof param == 'string' ? new RegExp(param) : param);
});
// form validation
$(function () {
    $('#register').validate({
        rules: {
            mem_name: 'required',
            username: 'required',
            email: {
                required: true,
                email: true,
            },

            password: {
                required: true,
                regex: '^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$',
            }
        },
        messages: {
            mem_name: `<small class="text-danger">
            Duplicate Username.
            </small>`,
            username: `<div class="alert alert-warning alert-dismissible fade show">
                <strong>Warning!</strong> Username is required.
            </div>`,
            email: `<div class="alert alert-warning alert-dismissible fade show">
                <strong>Warning!</strong> Enter a valid email address.
            </div>`,

            password: {
                regex: `<div class="alert alert-warning alert-dismissible fade show">
                    <strong>Warning!</strong> Enter a valid password.
                </div>`
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

});