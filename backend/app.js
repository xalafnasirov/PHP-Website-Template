function send(to) {
    send_request(to);
}

function add(from, to) {
    to[from.name] = from.value;
    console.log(to);
}

function send_request(e, data, action) {
    e.preventDefault();
    console.log("submitted");
    data['action'] = action;
    console.log(data);
    $.ajax({
        type: 'POST',
        url: 'backend/api.php',
        data: data,
        dataType: 'json',
        success: function (response) {

            console.log("Raw: " + response.status);
            console.log("Message: " + response.message);

            if (response.status == 'success') {  
                alert(response.messsage);
                //Redirect to a different page or show a success message
                switch (data['action']) {
                    case 'login':
                        route('home');
                        break;
                    case 'register':
                        route('home');
                    default:
                        break;
                }
            } else {
                // Show an error message
                alert("Error: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

function route(page) {

    window.location.href = page;

}


