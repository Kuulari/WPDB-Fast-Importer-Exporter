jQuery(document).ready(function () {

    jQuery(".exporter_check_again, .importer_check_again").on("click", function () {
        var inputField = jQuery(this).parent().children("input[type='text']");
        var path = jQuery(this).parent().children("input[type='text']").val();

        jQuery.ajax({
            type: "POST",
            url: "ajax.php",
            context: document.body,
            data: {action: 'checkIfFileExists', path: path},
            success: function (data) {
                checkedForFile(data, inputField);
            }
        });
    });


    jQuery(".exporterbutton").on("click", function () {
        var mysqldumpPath = jQuery(this).parent().find(".dumppath").val();
        var host = jQuery(this).parent().find("td[data-dbhost]").html();
        var user = jQuery(this).parent().find("td[data-dbuser]").html();
        var pass = jQuery(this).parent().find("td[data-dbpass]").html();
        var dbname = jQuery(this).parent().find("td[data-dbname]").html();

        jQuery(this).after(getloadingBar());

        jQuery.ajax({
            type: "POST",
            url: "ajax.php",
            context: document.body,
            data: {
                action: 'createDump',
                mysqldumpPath: mysqldumpPath,
                host: host,
                user: user,
                pass: pass,
                dbname: dbname
            },
            success: function () {
                window.location.reload()
            }
        });
    });


    jQuery(".importbutton").on("click", function () {

        var sqlPath = jQuery(this).parent().parent().find(".sqlpath").val();
        var host = jQuery(this).parent().parent().find("td[data-dbhost]").html();
        var user = jQuery(this).parent().parent().find("td[data-dbuser]").html();
        var pass = jQuery(this).parent().parent().find("td[data-dbpass]").html();

        var dbname = jQuery(this).parent().parent().find("td[data-dbname]").html();
        var filename = jQuery(this).attr("data-file");

        var Check = confirm("Caution!! \n\nYou are importing: \n\n\t\t"+filename+"\n\nThe existing DB will be overwritten!!")

        if(Check){
            jQuery(this).after(getloadingBar());

            jQuery.ajax({
                type: "POST",
                url: "ajax.php",
                context: document.body,
                data: {
                    action: 'importDump',
                    sqlPath: sqlPath,
                    host: host,
                    user: user,
                    pass: pass,
                    dbname: dbname,
                    filename: filename
                },
                success: function () {
                    window.location.reload()
                }
            });
        }

    });
});

function checkedForFile(data, inputField) {
    var parseddata = jQuery.parseJSON(data);

    if (parseddata[0] == true) {
        inputField.css({border: "2px solid green"});
    } else {
        inputField.css({border: "2px solid red"});
    }
}

function getloadingBar() {

    var loadingbar = '<div id="spinningSquaresG">' +
        '<div id="spinningSquaresG_1" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_2" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_3" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_4" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_5" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_6" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_7" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_8" class="spinningSquaresG"></div>' +
        '</div>';
    return "<div class='loadingbar'>" + loadingbar + "</div>";
}