$(document).ready(function() {
    var reciever = $('#reciever').text();
    var subject = $('#subject').text();
    var content = $('#content').text();
    var enhance = $('#enhance').text();

    console.log(enhance);

    $.post("process.php", {
        content: content,
        reciever: reciever,
        subject: subject,
        enhance: enhance
    }).done(function() {
        window.location.href = 'result.php';
    });
});
