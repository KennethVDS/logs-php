$.ajax({
    type: 'POST',
    url: 'loginCheck',
    data: $(formLogin).serialize(),
    dataType: 'json',
    success: function (textStatus, status) {
        console.log(textStatus);
        console.log(status);
    },
    error: function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(xhr.statusText);
        console.log(textStatus);
        console.log(error);
    }
});