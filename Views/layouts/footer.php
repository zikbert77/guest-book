<script>
    $(document).ready(function () {
        var $img = $("#captcha");

        $("#captcha").on("click", function () {
            $img.attr("src", $img.attr("src").split("?")[0] + "?" + Math.random());
        });


        $('#lang').on('change', function() {


            var params = {
                lang: this.value
            }

            $.get("/changeLang/", params, function(data){
                if ( data )
                    alert("Language switch to: " + data);

                location.reload();
            });

        })

    });
</script>
</body>
</html>