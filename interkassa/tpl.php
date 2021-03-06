<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/interkassa.css">
<!--<script src="js/interkassa.js"></script>-->
<? // var_dump($_SERVER)?>
<div class="interkasssa" style="text-align: center;">
    <?php
    if (strtoupper($this->enabledAPI)=='Y') {
        $payment_systems = $this->getIkPaymentSystems($this->merchantId, $this->apiId, $this->apiKey);
        if (is_array($payment_systems) && !empty($payment_systems)) {
            ?>
            <button type="button" class="sel-ps-ik btn btn-info btn-lg" data-toggle="modal"
                    data-target="#InterkassaModal" style="display: none;">
                Select Payment Method
            </button>
            <div id="InterkassaModal" class="ik-modal fade" role="dialog">
                <div class="ik-modal-dialog ik-modal-lg">
                    <div class="ik-modal-content" id="plans">
                        <div class="container">
                            <h3>
                                1. Выберите удобный способ оплаты<br>
                                2. Укажите валюту<br>
                                3. Нажмите &laquo;Оплатить&raquo;<br>
                            </h3>
                            <div class="ik-row">
                                <?php foreach ($payment_systems as $ps => $info) { ?>
                                    <div class="col-sm-3 text-center payment_system">
                                        <div class="panel panel-warning panel-pricing">
                                            <div class="panel-heading">
                                                <div class="panel-image">
                                                    <img src="images/interkassa-img/<?php echo $ps; ?>.png"
                                                         alt="<?php echo $info['title']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="radioBtn btn-group">
                                                        <?php foreach ($info['currency'] as $currency => $currencyAlias) { ?>
                                                            <a class="btn btn-primary btn-sm notActive"
                                                               data-toggle="fun"
                                                               data-title="<?php echo $currencyAlias; ?>"><?php echo $currency; ?></a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <a class="btn btn-lg btn-block btn-success ik-payment-confirmation"
                                                   data-title="<?php echo $ps; ?>"
                                                   href="#">Оплатить через<br>
                                                    <strong><?php echo $info['title']; ?></strong>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else
            echo $payment_systems;
    }
    ?>
</div>

<script type="text/javascript">

    if ($ == undefined) {
        if (jQuery == undefined) {
            alert('Your jQuery is not defined in your site')
        } else {
            $ = jQuery
        }
    }
    ;
    console.log("<?= $url_host; ?>")
    var selpayIK = {
        actForm: 'https://sci.interkassa.com/',
        req_url: '<?= $url_host ?>',

        // req_url: 'http://test1.ru/operation?id=18',
        // req_url: 'http://intkassa.supercat.pp.ua/',
        selPaysys: function () {
            if (document.querySelector('button.sel-ps-ik') != null) {
                document.querySelector('.sel-ps-ik').click();
            } else {
                var form = document.forms['payment_interkassa'];
                form.action = selpayIK.actForm;
                setTimeout(function () {
                    form.submit()
                }, 200)
            }
        },
        paystart: function (data) {
            data_array = (this.IsJsonString(data)) ? JSON.parse(data) : data;
            var form = $('form[name="payment_interkassa"]');
            if (data_array['resultCode'] != 0) {
                $('input[name="ik_act"]').remove();
                $('input[name="ik_int"]').remove();
                $('form[name="payment_interkassa"]').attr('action', selpayIK.actForm).submit()
            } else {
                if (data_array['resultData']['paymentForm'] != undefined) {
                    var data_send_form = [];
                    var data_send_inputs = [];
                    data_send_form['url'] = data_array['resultData']['paymentForm']['action'];
                    data_send_form['method'] = data_array['resultData']['paymentForm']['method'];
                    for (var i in data_array['resultData']['paymentForm']['parameters']) {
                        data_send_inputs[i] = data_array['resultData']['paymentForm']['parameters'][i];
                    }
                    $('body').append('<form method="' + data_send_form['method'] + '" id="tempformIK" action="' + data_send_form['url'] + '"></form>');
                    for (var i in data_send_inputs) {
                        $('#tempformIK').append('<input type="hidden" name="' + i + '" value="' + data_send_inputs[i] + '" />');
                    }
                    $('#tempformIK').submit();
                } else {
                    if (document.getElementById('tempdivIK') == null) {
                        $('form[name="payment_interkassa"]').after('<div id="tempdivIK">' + data_array['resultData']['internalForm'] + '</div>');
                    } else {
                        $('#tempdivIK').html(data_array['resultData']['internalForm']);
                    }
                    $('#internalForm').attr('action', 'javascript:selpayIK.selPaysys2()')
                }
            }
        },
        selPaysys2: function () {
            var form2 = $('#internalForm');
            var msg2 = form2.serialize();
            $.ajax({
                type: 'POST',
                url: selpayIK.req_url,
                data: msg2,
                success: function (data) {
                    selpayIK.paystart2(data.responseText);
                },
                error: function (xhr, str) {
                    alert('Error: ' + xhr.responseCode);
                }
            });
        },
        paystart2: function (string) {
            data_array = (this.IsJsonString(data)) ? JSON.parse(data) : data;
            var form2 = $('#internalForm');
            if (data_array['resultCode'] != 0) {
                form2[0].action = selpayIK.actForm;
                $('input[name="ik_act"]').remove();
                $('input[name="ik_int"]').remove();
                $('input[name="sci[ik_int]"]').remove();
                setTimeout(function () {
                    form2[0].submit()
                }, 200)
            } else {
                $('#tempdivIK').html('');
                if (data_array['resultData']['paymentForm'] != undefined) {
                    var data_send_form = [];
                    var data_send_inputs = [];
                    data_send_form['url'] = data_array['resultData']['paymentForm']['action'];
                    data_send_form['method'] = data_array['resultData']['paymentForm']['method'];
                    for (var i in data_array['resultData']['paymentForm']['parameters']) {
                        data_send_inputs[i] = data_array['resultData']['paymentForm']['parameters'][i];
                    }
                    $('#tempdivIK').append('<form method="' + data_send_form['method'] + '" id="tempformIK2" action="' + data_send_form['url'] + '"></form>');
                    for (var i in data_send_inputs) {
                        $('#tempformIK2').append('<input type="hidden" name="' + i + '" value="' + data_send_inputs[i] + '" />');
                    }
                    $('#tempformIK2').submit();
                } else {
                    $('#tempdivIK').append(data_array['resultData']['internalForm']);
                }
            }
        },
        IsJsonString: function (str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }
    };

    $(document).ready(function () {

        if ($('._topLine').length == 0) {
            $('input:submit')[0].style.display = 'none'
            //new
            $(document).mouseup(function (e) { // событие клика по веб-документу
                var div = $("#plans"); // тут указываем ID элемента
                if (!div.is(e.target) // если клик был не по нашему блоку
                    && div.has(e.target).length === 0) { // и не по его дочерним элементам
                    $(location).attr('href', '<?=$url_location?>');
                }
            });
        }

        // $('#payment_form').after('<a href=#>q</a>')

        if ($(".topLinks")[0] == null) {
            document.payment_interkassa.submit();
        } else $(".topLinks")[0].style.height = 'initial';//http://test1.ru/operation?id=16


        $('body').prepend('<div class="blLoaderIK"><div class="loaderIK"></div></div>');
        var checkSelCurrPS = [];

        $('.ik-payment-confirmation').click(function (e) {
            e.preventDefault();

            var pm = $(this).closest('.payment_system');
            var ik_pw_via = $(pm).find('.radioBtn a.active').data('title');
            if (!$(pm).find('.radioBtn a').hasClass('active') || ($.inArray(ik_pw_via, checkSelCurrPS) == -1)) {
                alert('Вы не выбрали валюту');
                return;
            } else {
                if (ik_pw_via.search('test_interkassa|qiwi|rbk') == -1) {
                    var form = $('form[name="payment_interkassa"]');
                    form.append($('<input>', {type: 'hidden', name: 'ik_act', val: 'process'}));
                    form.append($('<input>', {type: 'hidden', name: 'ik_int', val: 'json'}));
                    $('.blLoaderIK').css('display', 'block');
                    $.post(selpayIK.req_url, form.serialize(), function (data) {
                        selpayIK.paystart(data);
                    })
                        .fail(function () {
                            alert('Something wrong');
                        })
                        .always(function () {
                            $('.blLoaderIK').css('display', 'none');
                        })
                } else {
                    $('form[name="payment_interkassa"]').attr('action', selpayIK.actForm).submit()
                }
            }
            $('#InterkassaModal').hide();
            $('.fade.in').hide()
        });

        $('.radioBtn a').on('click', function () {
            $('.blLoaderIK').css('display', 'block');
            var form = $('form[name="payment_interkassa"]');
            var sel = $(this).data('title');
            var tog = $(this).data('toggle');

            $('#' + tog).prop('value', sel);
            $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
            $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');

            var ik_pw_via = $(this).attr('data-title');
            checkSelCurrPS.push(ik_pw_via);
            if ($('input[name ="ik_pw_via"]').length > 0) {
                $('input[name ="ik_pw_via"]').val(ik_pw_via);
            } else {
                form.append($('<input>', {type: 'hidden', name: 'ik_pw_via', val: ik_pw_via}));
            }

            $.post(selpayIK.req_url, form.serialize())
                .always(function (data, status) {
                    $('.blLoaderIK').css('display', 'none');
                    if (status == 'success') {
                        $('input[name="ik_sign"]').val(data);
                        // $('input[name="ik_sign"]').val(data.replace(/<\/?[^>]+>/g, ''));
                    } else {
                        alert('Something wrong');
                    }
                })
        })

    });
</script>