<style type="text/css">
    .checkout-info, .cart-summary { padding: 15px 0; border-bottom: 1px solid #E9E8E8; overflow: hidden; }

    .checkout-info h2 { font-size: 22px; font-weight: bold; border-bottom: 1px solid #E9E8E8; }

    .checkout-info h3 { font-size: 18px; font-weight: bold; }

    .checkout-info .sixcol { float: left; width: 40%; margin-right: 20px; }

    .checkout-info .last { margin-right: 0; }

    .output .row { padding: 5px 0; }

    .output label { float: left; width: 28%; line-height: 22px; }


    .output span { float: left; width: 70%; line-height: 22px; overflow: hidden; }

    .output input { float: left; width: 55%; }

    .output textarea { width: 95%; }

    .cart-summary { }

    .cart-summary h3 { line-height: 28px; font-size: 18px; font-weight: bold; }

    .cart-summary table { width: 100%; }

    table td { padding: 10px; border: 1px solid #E9E8E8; }

    table td.value { color: #f44747 !important; font-size: 140%; font-family: Georgia, "Times New Roman", Times, serif; font-style: italic; text-align: right; }

    table td input { width: 10%; }

    table td.bold { font-weight: bold; text-align: right; }

    .normal { margin-top: 20px; }

    .normal p { line-height: 1.6; margin: 0.7em 0; text-shadow: 0 1px #fff; }

    .add-info-cart { margin-top: 20px; }

    .add-info-cart label { font-weight: bold; font-size: 18px; }

    .add-info-cart .info { line-height: 20px; margin: 10px 0 0 10px; font-size: 14px; clear: both; }
    .contact { border-top: 1px solid #E9E8E8; padding: 10px 5px; }
    .contact .detail { margin-left: 20px; font-weight: bold; }
</style>


    <h2>Xác nhận đơn hàng</h2>

    <div class="cart-summary" style="padding: 15px 0; border-bottom: 1px solid #E9E8E8; overflow: hidden;">
        <h3 style="line-height: 28px; font-size: 18px; font-weight: bold">Giỏ hàng của bạn</h3>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <td style="padding: 10px; border: 1px solid #E9E8E8;">Tên</td>
                    <td style="padding: 10px; border: 1px solid #E9E8E8;">Giá</td>
                    <td style="padding: 10px; border: 1px solid #E9E8E8;">Số lượng / Update</td>
                    <td style="padding: 10px; border: 1px solid #E9E8E8; font-weight: bold; text-align: right">Giảm giá</td>
                    <td class="value" style="padding: 10px; border: 1px solid #E9E8E8; color: #f44747!important; font-size: 140%; font-family: Georgia,'Times New Roman',Times,serif; font-style: italic; font-weight: bold; text-align: right;">Thành tiền</td>
                </tr>
            </thead>
            <tbody>
                <?php $valueItem = 0; ?>
                <?php foreach ($userCart as $cart) { ?>
                    <tr>
                        <td class="product-name" style="padding: 10px; border: 1px solid #E9E8E8;"><?php echo $cart['name']; ?></td>
                        <td style="padding: 10px; border: 1px solid #E9E8E8;"><?php echo Helper::formatNumber($cart['price']); ?></td>
                        <td style="padding: 10px; border: 1px solid #E9E8E8;"><?php echo $cart['quantity']; ?></td>
                        <td style="padding: 10px; border: 1px solid #E9E8E8; font-weight: bold; text-align: right"><?php echo $cart['formatValueDiscount']; ?></td>
                        <td class="value" style="padding: 10px; border: 1px solid #E9E8E8; color: #f44747!important; font-size: 140%; font-family: Georgia,'Times New Roman',Times,serif; font-style: italic; font-weight: bold; text-align: right;"><?php echo $cart['formatValueAfterDiscount']; ?></td>
                    </tr>
                    <?php $valueItem += $cart['valueAfterDiscount']; ?>
                <?php } ?>
                <tr>
                    <td colspan="4" style="padding: 10px; border: 1px solid #E9E8E8;text-align: right">Chi phí vận chuyển</td>
                    <td class="value" style="padding: 10px; border: 1px solid #E9E8E8; color: #f44747!important; font-size: 140%; font-family: Georgia,'Times New Roman',Times,serif; font-style: italic; font-weight: bold; text-align: right;"><?php echo Helper::formatNumber(Transport_Charge); ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 10px; border: 1px solid #E9E8E8;text-align: right">Tổng tiền thanh toán</td>
<!--                    <input type="hidden" class="total-value" value="--><?php //echo $valueItem + Transport_Charge; ?><!--" />-->
                    <td class="value total" style="padding: 10px; border: 1px solid #E9E8E8; color: #f44747!important; font-size: 140%; font-family: Georgia,'Times New Roman',Times,serif; font-style: italic; font-weight: bold; text-align: right;"><?php echo Helper::formatNumber($valueItem + Transport_Charge); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="checkout-info" style="padding: 15px 0; border-bottom: 1px solid #E9E8E8; overflow: hidden;">
        <div class="sixcol billto" style="float: left; width: 40%; margin-right: 20px;">
            <h3 style="font-size: 18px; font-weight: bold;">Bill To</h3>

            <div class="output" style="padding: 5px 0;">
                <div class="tab-content form clearfix">
                    <?php if (isset($billTo['username'])) { ?>
                        <div class="row" style="clear: both">
                        <label style="float: left; width: 28%; line-height: 22px;">Tên truy cập</label>
                        <span class="float: left; width: 70%; line-height: 22px; overflow: hidden;"><?php echo $billTo['username']; ?></span>
                    </div>
                    <?php } ?>

                    <div class="row" style="clear: both">
                        <label style="float: left; width: 28%; line-height: 22px;">Email</label>
                        <span style="float: left; width: 70%; line-height: 22px; overflow: hidden;"><?php echo $billTo['email']; ?></span>
                    </div>

                    <div class="row" style="clear: both">
                        <label style="float: left; width: 28%; line-height: 22px;">Họ và tên</label>
                        <span style="float: left; width: 70%; line-height: 22px; overflow: hidden;"><?php echo $billTo['full_name']; ?></span>
                    </div>

                    <div class="row" style="clear: both">
                        <label style="float: left; width: 28%; line-height: 22px;">Điện thoại</label>
                        <span style="float: left; width: 70%; line-height: 22px; overflow: hidden;"><?php echo $billTo['phone']; ?></span>
                    </div>

                    <div class="row" style="clear: both">
                        <label style="float: left; width: 28%; line-height: 22px;">Địa chỉ</label>
                        <span style="float: left; width: 70%; line-height: 22px; overflow: hidden;"><?php echo $billTo['address']; ?></span>
                    </div>

                    <div class="row" style="clear: both">
                        <label style="float: left; width: 28%; line-height: 22px;">Mô tả</label>
                        <span style="float: left; width: 70%; line-height: 22px; overflow: hidden;"><?php echo nl2br($billTo['description']); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="sixcol shipto last" style="float: left; width: 40%; margin-right: 20px; margin-right: 0;">
            <h3 style="font-size: 18px; font-weight: bold;">Ship To</h3>

            <div class="output">
                <div class="tab-content form clearfix">
                    <div class="row" style="clear: both">
                        <label style="float: left; width: 28%; line-height: 22px;">Họ và tên</label>
                        <?php echo $shipTo['full_name'] ?>
                    </div>

                    <div class="row" style="clear: both">
                        <label style="float: left; width: 28%; line-height: 22px;">Điện thoại</label>
                        <?php echo $shipTo['phone'] ?>
                    </div>

                    <div class="row" style="clear: both">
                        <label style="float: left; width: 28%; line-height: 22px;">Địa chỉ</label>
                        <?php echo $shipTo['address'] ?>
                    </div>
                </div>

                <div class="row add-info-cart" style="clear: both">
                    <label style="float: left; width: 50%; line-height: 22px;">Yêu cầu khác: </label>
                    <div class="clearfix" style="clear: both"></div>
                    <div class="info"><?php echo nl2br($shipTo['other']); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="normal" style="margin-top: 20px;">
        <p style="line-height: 1.6; margin: 0.7em 0; text-shadow: 0 1px #fff;">Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất để xác nhận đơn hàng này.</p><br />
        <p style="line-height: 1.6; margin: 0.7em 0; text-shadow: 0 1px #fff;">Chúc bạn và gia đình có một ngày vui ve.</p>
        <p style="line-height: 1.6; margin: 0.7em 0; text-shadow: 0 1px #fff;">Chân thành cám ơn đã mua hàng.</p>
        <div class="contact" style="border-top: 1px solid #E9E8E8; padding: 10px 5px">
            <p>Mọi chi tiết, thắc mắc vui lòng liên hệ:</p>
            <p style="margin-left: 20px; font-weight: bold;">ĐT: <?php echo HOTLINE; ?></p>
            <p style="margin-left: 20px; font-weight: bold;">Website: <a href="<?php echo Helper::url('/Shop/product/index'); ?>" title="Vomamxenang.com">http://vomamxenang.com</a></p>
        </div>
    </div>
