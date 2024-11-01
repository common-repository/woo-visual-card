function showVisualCardCheckout(){
    jQuery("form.checkout").card({
        container: '#businesspay_visual_card',
        formSelectors: {
            numberInput: 'input#businesspay_card_number',
            expiryInput: 'input#businesspay_expiry',
            cvcInput: 'input#businesspay_cvv',
            nameInput: 'input#businesspay_holder_name'
        },
        messages: {
            validDate: 'Válido\naté',
            monthYear: 'mês/ano',
        },
        placeholders: {
            number: '•••• •••• •••• ••••',
            name: 'Nome no Cartão',
            expiry: '••/••••',
            cvc: '•••'
        },
        debug: false
    });
}

function showVisualCardOrderPay(){
    if (document.getElementById("businesspay_visual_card")) {
        jQuery("#order_review").card({
            container: '#businesspay_visual_card',
            formSelectors: {
                numberInput: 'input#businesspay_card_number',
                expiryInput: 'input#businesspay_expiry',
                cvcInput: 'input#businesspay_cvv',
                nameInput: 'input#businesspay_holder_name'
            },
            messages: {
                validDate: 'Válido\naté',
                monthYear: 'mês/ano',
            },
            placeholders: {
                number: '•••• •••• •••• ••••',
                name: 'Nome no Cartão',
                expiry: '••/••••',
                cvc: '•••'
            },
            debug: false
        });
    }
}

function resetFields(){
    jQuery("#businesspay_card_number").val('');
    jQuery("#businesspay_holder_name").val('');
    jQuery("#businesspay_expiry").val('');
    jQuery("#businesspay_cvv").val('');
    jQuery("#businesspay_installments").val(0);
    jQuery("#businesspay_doc").val('');
}

function setCardType(){
    var cardNum = jQuery("#businesspay_card_number");

    jQuery(".jp-card").removeClass('jp-card-identified');
    jQuery(".jp-card").removeClass('jp-card-visa');
    jQuery(".jp-card").removeClass('jp-card-mastercard');
    jQuery(".jp-card").removeClass('jp-card-amex');
    jQuery(".jp-card").removeClass('jp-card-dinersclub');
    jQuery(".jp-card").removeClass('jp-card-discover');

    if (cardNum.hasClass('discover')){
        jQuery(".jp-card").addClass('jp-card-discover jp-card-identified');
    }
    else if (cardNum.hasClass('dinersclub')){
        jQuery(".jp-card").addClass('jp-card-dinersclub jp-card-identified');
    }
    else if (cardNum.hasClass('amex')){
        jQuery(".jp-card").addClass('jp-card-amex jp-card-identified');
    }
    else if (cardNum.hasClass('mastercard')){
        jQuery(".jp-card").addClass('jp-card-mastercard jp-card-identified');
    }
    else if (cardNum.hasClass('visa')){
        jQuery(".jp-card").addClass('jp-card-visa jp-card-identified');
    }
}

//Set the visual card type
jQuery(document).on('keyup keydown change past', '#businesspay_card_number', function(){
    setCardType();
});

//Checkout page
jQuery(document).on('updated_checkout', function(){
    resetFields();
    showVisualCardCheckout();
    setCardType();
});

//Order Pay page
if (jQuery("body").hasClass('woocommerce-order-pay')){
    showVisualCardOrderPay();
}