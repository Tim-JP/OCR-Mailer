$(document).ready(function () {
    var isDragging = false;
    var lastX = 0;
    var lastY = 0;
    var interval = 1;
    var lastDotTime = 0;

    $('.writeable').mousedown(function (event) {
        isDragging = true;
        lastX = event.pageX;
        lastY = event.pageY;
        lastDotTime = Date.now();

        createDot(lastX, lastY);
    });

    $(document).mousemove(function (event) {
        if (isDragging) {
            var now = Date.now();
            var elapsed = now - lastDotTime;

            if (elapsed >= interval) {
                lastX = event.pageX;
                lastY = event.pageY;

                var $writeable = $('.writeable');
                var offset = $writeable.offset();
                var width = $writeable.width();
                var height = $writeable.height();

                if (lastX >= offset.left && lastX <= offset.left + width &&
                    lastY >= offset.top && lastY <= offset.top + height) {

                    lastDotTime = now;
                    createDot(lastX, lastY);
                }
            }
        }
    });

    $(document).mouseup(function () {
        isDragging = false;
    });
});

function createDot(x, y) {
    var $dot = $('<div class="dot"></div>');

    $dot.css({
        left: x - 5 + 'px',
        top: y - 5 + 'px',
        position: 'absolute'
    });

    $('.writeable').append($dot);
}

function removeDots() {
    $(".dot").remove();
}

function addSpace() {
    var originalHeight = $('.mail')[0].style.height;
    var originalHeightValue = parseFloat(originalHeight);
    var newHeight = originalHeightValue + 20;

    $(".mail").css('height', newHeight + "vh");
}

function sendForm() {
    var reciever = $("#reciever").val();
    var subject = $("#subject").val();
    
    if (reciever === "") {
        $("#reciever").attr("class", "warning");
    } else {
        $("#reciever").removeClass("warning");
    }

    if (subject === "") {
        $("#subject").attr("class", "warning");
    } else {
        $("#subject").removeClass("warning");
    }

    if (reciever !== "" && subject !== "") {
        html2canvas($('.writeable')[0]).then(function (canvas) {
            var imgData = canvas.toDataURL('image/png');
            $('#content').val(imgData);
    
            $('#mailForm')[0].submit();
        });
    }
}

function changeSwitch() {
    if ($("#switch").is(':checked')) {
        $("#enhance").val(1);
    } else {
        $("#enhance").val(0);
    }
}