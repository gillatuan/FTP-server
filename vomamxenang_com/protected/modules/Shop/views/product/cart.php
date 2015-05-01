<div class="module-cart clearfix">
    <h3>Thông tin đặt hàng</h3>
    <div class="product-neighbours">
        <strong>Giỏ hàng của bạn</strong>
        <a href="<?php echo Helper::url('/site/index'); ?>" class="next-page" title="Tiếp tục mua hàng">Tiếp tục mua hàng</a>

        <div class="clear"></div>
    </div>

    <div class="cart-summary">
        <div class="addcart-success link active"></div>
        <table>
            <thead>
                <tr>
                    <td>Tên</td>
                    <td>Giá</td>
                    <td>Số lượng / Update</td>
                    <td class="bold">Giảm giá</td>
                    <td class="value">Thành tiền</td>
                </tr>
            </thead>
            <tbody>
                <?php $valueItem = 0;
                if (count($showCart)) {
                    foreach ($showCart as $cart) {
                        ?>
                        <tr>
                            <td class="product-name"><?php echo $cart['name']; ?></td>
                            <td><?php echo Helper::formatNumber($cart['price']); ?></td>
                            <td><input type="text" class="product-amount" value="<?php echo $cart['quantity']; ?>" />
                                <input type="hidden" class="product-alias" value="<?php echo $cart['alias']; ?>" />
                                <input type="hidden" class="product-price" value="<?php echo $cart['price']; ?>" />
                                <input type="hidden" class="product-discount" value="<?php echo $cart['valueDiscount'] ?>" />
                                <input type="hidden" class="product-value" value="<?php echo $cart['valueAfterDiscount']; ?>" />
                                <span class="button-update-cart" title="Cập nhật số lượng" id="id-<?php echo $cart['alias']; ?>"></span>
                                <span class="delete-product" title="Xóa sản phẩm"></span>
                            </td>
                            <td class="bold"><?php echo $cart['formatValueDiscount']; ?></td>
                            <td class="value"><?php echo $cart['formatValueAfterDiscount']; ?></td>
                        </tr>
                        <?php $valueItem += $cart['valueAfterDiscount']; ?>
                    <?php } ?>

                    <tr>
                        <td colspan="4" style="text-align: right">Chi phí vận chuyển</td>
                        <td class="value"><?php echo Helper::formatNumber(Transport_Charge); ?></td>
                    </tr>
                    <tr>
                            <td colspan="4" style="text-align: right">Tổng tiền thanh toán</td>
                            <input type="hidden" class="total-value" value="<?php echo $valueItem + Transport_Charge; ?>" />
                            <td class="value total"><?php echo Helper::formatNumber($valueItem + Transport_Charge); ?></td>
                        </tr>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">Bạn chưa chọn mua món hàng nào cả.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="checkout-info output">
        <div class="sixcol billto">
            <h3>Thông tin người mua</h3>

            <div class="output">
                <?php $this->renderPartial('Admin.views.user._form', array('model' => $modelUser, 'id' => 'user-form')); ?>
            </div>
        </div>
        <div class="sixcol shipto last">
            <h3>Thông tin người nhận</h3>

            <div class="output">
                <p><?php echo Helper::t('some_comment'); ?></p>

                <p class="showFormReview"><a href="#" title="Thêm / Sửa thông tin người nhận" class="link">Thêm / Sửa thông tin người nhận</a></p>
                <div class="tab-content form clearfix">

                    <div class="row">
                        <label><?php echo Helper::t('fullname'); ?></label>
                        <input name="" class="fullname" />
                    </div>

                    <div class="row">
                        <label><?php echo Helper::t('phone'); ?></label>
                        <input name="" class="phone" />
                    </div>

                    <div class="row">
                        <label><?php echo Helper::t('address'); ?></label>
                        <input name="" class="address" />
                    </div>

                </div>

                <div class="add-info-cart">
                    <div class="row">
                        <label>Yêu cầu khác</label>
                        <textarea rows="10" cols="" class="other-info"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-order">
        <p class="link active">Bạn chưa hoàn tất cung cấp thông tin đặt mua hàng của bạn. Thanks.</p>
        <a class="link active" href="javascript:;" title="Mua giỏ hàng này">Mua giỏ hàng này</a>
    </div>
</div>

<?php
$scriptActionCart = '
    $(function() {
        $(".shipto .form").hide();
        $(".showFormReview").click(function () {
            $(this).parent().find(".tab-content.form").toggle("slow");

            return false;
        });

        $(".button-update-cart").click(function() {
            var url = "' . Helper::url('/Shop/product/updateOrDeleteCart') . '";
            var $this = $(this);
            var productAlias = $this.parent().find(".product-alias").val();

            param = {
                alias: productAlias,
                quantity: $this.parent().find(".product-amount").val(),
                valueBefore: $this.parent().find(".product-value").val(),
                totalValueBefore: $this.parent().parent().parent().find(".total-value").val(),
                type: "updateCart"
            };

            processAjax(url, param, $this, productAlias, "updateCart")
        })

        $(".delete-product").click(function() {
            if (confirm("Bạn thực sự muốn xóa sản phẩm này trong giỏ hàng")) {
                var url = "' . Helper::url('/Shop/product/updateOrDeleteCart') . '";
                var $this = $(this);
                var productAlias = $this.parent().find(".product-alias").val();

                param = {
                    alias: productAlias,
                    valueBefore: $this.parent().find(".product-value").val(),
                    totalValueBefore: $this.parent().parent().parent().find(".total-value").val(),
                    type: "delOneCart"
                };

                processAjax(url, param, $this, productAlias, "delOneCart")
            }

            return false;
        })

        if ($(".form .row").hasClass("error") == false) {
            $(".cart-order p").hide();
            $(".cart-order a").show();
        } else {
            $(".cart-order p").show();
            $(".cart-order a").hide();
        }

        $(".cart-order a").click(function() {
            var dataError = false, userInfo = new Array();
            $.each($("#user-form input.required"), function(index, value) {
                if ($(value).val() == "") {
                    dataError = true;
                    $(".cart-order p").show();
                    $(".cart-order a").hide();
                    $(value).focus();

                    return false;
                } else {
                    userInfo.push($(value).val());
                }
            });

            if ("' . Helper::user()->id . '") {
                var userEmail = $(".user-email").text();
                userInfo.push(userEmail);
            }
            userInfo.push($(".billto textarea").val());

            userInfo.push($(".shipto input.fullname").val());
            userInfo.push($(".shipto input.phone").val());
            userInfo.push($(".shipto input.address").val());
            userInfo.push($(".shipto .other-info").val());

            if (dataError == false) {
                $(this).parent().html(\'<p class="link active" style="display: block;"><img src="' . Helper::themeUrl() . '/images/shopmyphamhan-loading.gif" alt="loading image" /></p>\');
                var url = "' . Helper::url('/Shop/product/userOrder') . '";
                $.ajax({
                    url: url,
                    type: "post",
                    data: {userInfo: userInfo},
                    success: function(dataValue){
                        window.location = "' . Helper::url('/Shop/product/confirmOrder') . '";
                    }
                });
            }

            return false;
        })
    })
';
Helper::cs()->registerScript('scriptActionCart', $scriptActionCart, CClientScript::POS_END);