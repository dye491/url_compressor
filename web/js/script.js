/**
 * Created by yuri on 09.06.2017.
 */
$(document).ready()
{
    console.log("Page is ready");

    $("#btn-send").on("click", function () {
        // console.log("button pressed");
        var source_url = $("#source-url").val(),
            redirect_url = $('#redirect_url').val();
        // console.log(source_url);
        $.ajax({
            url: "/",
            type: "POST",
            data: {
                url: source_url,
                redirect_url: redirect_url
            },
            dataType: "text",
            success: function (data) {
                // console.log(data);
                $(".panel-body p a").remove();
                $(".panel-body p").html('<a href="' + data + '" target="_blank">' + data + '</a>');
                $(".panel-result").removeClass("panel-danger").addClass("panel-success");
                // console.log($(".panel-result").attr('class'));
            },
            error: function (data) {
                // console.log(data.responseText);
                $(".panel-body p a").remove();
                $(".panel-body p").html(data.responseText);
                $(".panel-result").removeClass("panel-success").addClass("panel-danger");
                // console.log($(".panel-result").attr('class'));
            }
        });
    });
}
