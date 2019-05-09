  <div class="page-buffer"></div>
</div>

<footer id="footer" class="sel col"><!--Footer-->
    <p>&nbsp;</p>
                    <div class="child">
                            <address style="color:white">
                            <p>При возникновении вопросов обращаться по почте: </p>
                            <a href="mailto:nsablina15@gmail.com" style="font-style:italic">Заказчик</a>
                            </address>
                    </div>
                    <div class="child1">
                            <p style="text-align:right;">Copyright&copy;2016</p>
                    </div>
</footer><!--/Footer-->



<script src="/template/js/jquery.js"></script>
<script src="/template/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>

</body>
</html>