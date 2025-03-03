<script>
    $(document).ready(function () {
    $("#product_name").change(function () {
        var product_name = $(this).val();

        if (product_name !== "") {
            // Determine the correct URL dynamically
            var ajaxUrl = window.location.pathname.includes("/pages") 
                ? "../ajax/products/model.php" 
                : "./ajax/products/model.php";

            $.ajax({
                url: ajaxUrl,
                method: "POST",
                data: {
                    product_name: product_name
                },
                success: function (data) {
                    $("#productDiv").html(data);
                }
            });
        } else {
            $("#modelDiv").css("display", "none");
        }
    });
});

</script>