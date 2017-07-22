<script>
    $(document).ready(function () {
        var $img = $("#captcha");

        $("#captcha").on("click", function () {
            $img.attr("src", $img.attr("src").split("?")[0] + "?" + Math.random());
        });
        $

    });
</script>
</body>
</html>