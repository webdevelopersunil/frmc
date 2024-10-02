// public/js/ajax-helper.js
function submit(route, parameters, check) {

    var xhr = new XMLHttpRequest();
    xhr.open('POST', route, true);
    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            var response = JSON.parse(xhr.responseText);
            if (xhr.status === 200) {
                if (response.status === 'success') {
                    console.log('Success:', response.message);
                } else {
                    console.log('Error:', response.message);
                }
            } else {
                console.log('Request failed:', xhr.statusText);
            }
        }
    };

    var data = {
        parameters: parameters,
        check: check
    };

    xhr.send(JSON.stringify(data));
}

// Global function to handle form submissions
function handleFormSubmit(event) {

    event.preventDefault();

    var form = event.target;
    var route = form.action;
    var check = form.getAttribute('data-check');
    var formData = new FormData(form);
    var parameters = {};

    formData.forEach(function(value, key) {
        parameters[key] = value;
    });

    submit(route, parameters, check);
}

// Attach event listener to forms with class 'ajax-form'
document.addEventListener('DOMContentLoaded', function() {
    
    var forms = document.querySelectorAll('form.ajax-form');
    forms.forEach(function(form) {
        form.addEventListener('submit', handleFormSubmit);
    });
});
