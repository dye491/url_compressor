/**
 * Created by yuri on 09.06.2017.
 */
$(document).ready()
{
    console.log("Page is ready");

    $("#btn-send").on("click", function () {
        console.log("button pressed");
        var short_url = $("#source-url").val();
        console.log(short_url);
        $.ajax({
            url: "/",
            type: "POST",
            data: {
                url: short_url
            },
            dataType: "text",
            success: function (data) {
                console.log(data);
                $(".panel-body p a").remove();
                $(".panel-body p").html('<a href="' + short_url + '" target="_blank">' + short_url + '</a>');
            },
            error: function (data) {
                console.log(data.responseText);
                $(".panel-body p a").remove();
                $(".panel-body p").html(data.responseText);
            }
        });
    });
}
