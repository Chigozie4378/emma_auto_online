<script>
    function selectProduct(value) {
        $(document).ready(function () {
            var product_name = value;
            if (product_name != "") {
                $.ajax({
                    url: "./ajax/products/model.php",
                    method: "POST",
                    data: {
                        product_name: product_name
                    },
                    success: function (data) {
                        $("#modelDiv").html(data);
                    }
                });
            } else {
                $("#modelDiv").css("display", "none");
            }
        });


    }

    function selectModel(value1, value2) {
        $(document).ready(function () {
            var model = value1;
            var product_name = value2;
            if (model && product_name != "") {
                $.ajax({
                    url: "./ajax/products/brand.php",
                    method: "POST",
                    data: {
                        model: model,
                        product_name: product_name
                    },
                    success: function (data) {
                        $("#brandDiv").html(data);
                    }
                });
            } else {
                $("#brandDiv").css("display", "none");
            }
        });
    }

    //JQuery Ajax for Manufacturer
    function findProduct(value1, value2, value3) {
        $(document).ready(function () {
            var brand = value1;
            var model = value2;
            var product_name = value3;
            if (brand && model && product_name != "") {
                $.ajax({
                    url: "./ajax/product_results.php",
                    method: "POST",
                    data: {
                        brand: brand,
                        model: model,
                        product_name: product_name
                    },
                    success: function (data) {
                        $("#rPriceQty").html(data);
                    }
                });
            } else {
                $("#rPriceQty").css("display", "none");
            }
        });

    }
</script>