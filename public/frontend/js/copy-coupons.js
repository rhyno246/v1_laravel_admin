function CopyCode (e) {
    const couponTextActive = "Copied!";
    const couponText = "Copy";
    e.preventDefault();
    document.execCommand(
        "copy",
        false,
        $(this).parent().find('.coupon-input').select()
    );
    $(this).parent().find('.clickCoupon').html(couponTextActive);
    setTimeout(function () {
       $('.clickCoupon').html(couponText);
    }, 1000);
}
$(document).on('click' , '.clickCoupon' , CopyCode);
$('.tooltips').append("<span></span>");
    $('.tooltips:not([tooltip-position])').attr('tooltip-position','bottom');
    $(".tooltips").mouseenter(function(){
    $(this).find('span').empty().append($(this).attr('tooltip'));
});