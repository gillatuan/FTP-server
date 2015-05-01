<style type="text/css">
    .checkout-info, .cart-summary { padding: 15px 0; border-bottom: 1px solid #E9E8E8; overflow: hidden; }

    .checkout-info h2 { font-size: 22px; font-weight: bold; border-bottom: 1px solid #E9E8E8; }

    .checkout-info h3 { font-size: 18px; font-weight: bold; }

    .checkout-info .sixcol { float: left; width: 450px; margin-right: 20px; }

    .checkout-info .last { margin-right: 0; }

    .output { }

    .output .row { float: left; width: 45%; padding: 5px 0; max-width: 100%; min-width: 100%; }

    .output label { float: left; width: 28%; }
    .output span { float: left; width: 70%; overflow: hidden; }

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

    .add-info-cart .info { line-height: 20px; margin: 10px 0 0 20px; font-size: 14px; clear: both; }
</style>

    <div class="content-box-header">
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Table</a></li>
            <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2">Forms</a></li>
        </ul>
        <div class="clear"></div>
    </div><!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <h2>Chi tiết đơn hàng</h2>

            <div class="cart-summary">
                <h3>Tình trạng đơn hàng: <span style="color: red;"><?php echo Lookup::item('Order_Status', $model->order_status); ?></span></h3>
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
                        <?php $carts = Helper::objectToArray(json_decode($model->cart)); ?>
                        <?php foreach ($carts as $cart) { ?>
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
                    <h3>Bill To</h3>
                    <?php $billTo = Helper::objectToArray(json_decode($model->bill_to)); ?>
                    <div class="output">
                        <?php if (isset($billTo['username'])) { ?>
                            <div class="row">
                            <label>Tên truy cập</label>
                            <span><?php echo $billTo['username']; ?></span>
                        </div>
                        <?php } ?>

                        <div class="row">
                            <label>Email</label>
                            <span><?php echo $billTo['email']; ?></span>
                        </div>
                        <div class="row">
                            <label>Họ và tên</label>
                            <span><?php echo $billTo['full_name']; ?></span>
                        </div>
                        <div class="row">
                            <label>Điện thoại</label>
                            <span><?php echo $billTo['phone']; ?></span>
                        </div>
                        <div class="row">
                            <label>Địa chỉ</label>
                            <span><?php echo $billTo['address']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="sixcol shipto last">
                    <h3>Ship To</h3>
                    <?php $shipTo = Helper::objectToArray(json_decode($model->ship_to)); ?>

                    <div class="output">
                        <div class="tab-content form clearfix">
                            <div class="row">
                                <label>Họ và tên</label>
                                <span><?php echo $shipTo['full_name'] ?></span>
                            </div>

                            <div class="row">
                                <label>Điện thoại</label>
                                <span><?php echo $shipTo['phone'] ?></span>
                            </div>

                            <div class="row">
                                <label>Địa chỉ</label>
                                <span><?php echo $shipTo['address'] ?></span>
                            </div>
                        </div>

                        <div class="row add-info-cart">
                            <label>Yêu cầu khác: </label>
                            <div class="info"><?php echo $model->info; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>