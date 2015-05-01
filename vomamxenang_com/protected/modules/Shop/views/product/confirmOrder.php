<div class="module-cart clearfix">
    <h3>Xác nhận đơn hàng</h3>

    <div class="product-neighbours">
        <strong>Giỏ hàng của bạn</strong>
        <a href="<?php echo Helper::url('/site/index'); ?>" class="next-page" title="Tiếp tục mua hàng">Tiếp tục mua hàng</a>

        <div class="clear"></div>
    </div>

    <div class="cart-summary">
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
                <?php $valueItem = 0; ?>
                <?php foreach ($userCart as $cart) { ?>
                    <tr>
                        <td class="product-name"><?php echo $cart['name']; ?></td>
                        <td><?php echo Helper::formatNumber($cart['price']); ?></td>
                        <td><?php echo $cart['quantity']; ?></td>
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
            </tbody>
        </table>
    </div>

    <div class="checkout-info">
        <div class="sixcol billto">
            <h3><?php echo Helper::t('bill_to') ?></h3>

            <div class="output">
                <div class="tab-content form clearfix">
                    <?php if (isset($billTo['username'])) { ?>
                        <div class="row">
                            <label><?php echo Helper::t('username'); ?></label>
                            <span><?php echo $billTo['username']; ?></span>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <label>Email</label>
                        <span><?php echo $billTo['email']; ?></span>
                    </div>
                    <div class="row">
                        <label><?php echo Helper::t('fullname'); ?></label>
                        <span><?php echo $billTo['full_name']; ?></span>
                    </div>
                    <div class="row">
                        <label><?php echo Helper::t('phone'); ?></label>
                        <span><?php echo $billTo['phone']; ?></span>
                    </div>
                    <div class="row">
                        <label><?php echo Helper::t('address'); ?></label>
                        <span><?php echo $billTo['address']; ?></span>
                    </div>
                    <div class="row">
                        <label><?php echo Helper::t('description'); ?></label>
                        <span><?php echo nl2br($billTo['description']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="sixcol shipto last">
            <h3><?php echo Helper::t('ship_to') ?></h3>

            <div class="output">
                <div class="tab-content form clearfix">
<!--                    <p>--><?php //echo Helper::t('some_comment'); ?><!--</p>-->
                    <div class="row">
                        <label>Họ và tên</label>
                        <?php echo $shipTo['full_name'] ?>
                    </div>
                    <div class="row">
                        <label>Điện thoại</label>
                        <?php echo $shipTo['phone'] ?>
                    </div>
                    <div class="row">
                        <label>Địa chỉ</label>
                        <?php echo $shipTo['address'] ?>
                    </div>
                    <div class="row add-info-cart">
                        <label>Yêu cầu khác</label>
                        <?php echo nl2br($shipTo['other']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-order">
        <a class="link active buyOrder" href="javascript:void;" title="Xác nhận đơn hàng">Xác nhận đơn hàng</a>
    </div>
</div>

<?php
$scriptBuyThisOrder = '
    $(function() {
        $(".buyOrder").click(function() {
            $(this).parent().html(\'<p class="link active" style="display: block;"><img src="' . Helper::themeUrl() . '/images/shopmyphamhan-loading.gif" alt="loading image" /></p>\');

            var url = "' . Helper::url('/Shop/product/confirmOrder') . '";
            var confirmOrder = "Success";

            $.ajax({
                url: url,
                type: "post",
                data: { confirmOrder: confirmOrder },
                success: function(data){
                    window.location = "' . Helper::url('/Shop/product/index', array('flashOrder' => true)) . '";
                }
            });

            return false;
        })
    })
';
Helper::cs()->registerScript('scriptBuyThisOrder', $scriptBuyThisOrder, CClientScript::POS_END);