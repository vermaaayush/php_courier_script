
// dd pop up window - terms & conditions
   var popupWindow = null;
function positionedPopup(url, winName, w, h, t, l, scroll) {
    settings =
    'height=' + h + ',width=' + w + ',top=' + t + ',left=' + l + ',scrollbars=' + scroll + ',resizable'
    popupWindow = window.open(url, winName, settings)
}
