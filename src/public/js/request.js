const selectedColor = 'black';
const noSelectedColor = 'grey';

//URLのクエリパラメータ取得
const urlParams = new URLSearchParams(window.location.search);
const tab = urlParams.get('tab');

document.addEventListener('DOMContentLoaded', function () {
    const wait = document.getElementById('wait');
    const approve = document.getElementById('approve');
    if (tab === 'wait') {
        wait.style.color = selectedColor;
        approve.style.color = noSelectedColor;
    } else if (tab === 'approve') {
        wait.style.color = noSelectedColor;
        approve.style.color = selectedColor;
    }
});