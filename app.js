$(document).ready(function() {
        $(".share").click(function() {
            $("#share").fadeIn("slow");
        });
        $(".close").click(function() {
            $("#share").fadeOut("slow");
        });

        $(".legal").click(function() {
            $("#legal").fadeIn("slow");
        });
        $("#legal .close").click(function() {
            $("#legal").fadeOut("slow");
        });

        $(window).focus(function() {
            $("#favicon").attr("href","images/favicon.ico");
            $("title").html("Eleven Eighteen Entertainment &mdash; Accueil");
        });

        $(window).blur(function() {
            $("#favicon").attr("href","images/favicon1.ico");
            $("title").html("Reviens vite ! &mdash; 1118 Ent.");
        });
});
