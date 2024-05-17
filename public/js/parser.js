function showLoadingSpinner() {
    $('.loading-spinner').css('display', 'block');
    $('.disabled-overlay').css('display', 'block');

    // Disable all buttons and specific links in the list group
    $('button, .list-group a').each(function () {
        $(this).addClass('disabled');
        $(this).attr('disabled', true);
    });
}

function handleButtonClick(event, category) {
    event.preventDefault();
    showLoadingSpinner();

    const now = new Date().getTime();
    localStorage.setItem('lastClickTime', now);

    // Simulate a delay (for example, a network request) then redirect
    setTimeout(function () {
        window.location.href = `/admin/${category}`;
    }, 1000); // Adjust the delay as needed
}

function checkAllButtonsCooldown() {
    const cooldown = 90000; // 1 minute in milliseconds
    const lastClickTime = localStorage.getItem('lastClickTime');

    if (lastClickTime) {
        const now = new Date().getTime();
        const elapsed = now - lastClickTime;

        if (elapsed < cooldown) {
            const remaining = (cooldown - elapsed) / 1000;
            $('button, .list-group a').each(function () {
                $(this).addClass('disabled');
                $(this).attr('disabled', true);
            });

            setTimeout(() => {
                $('button, .list-group a').each(function () {
                    $(this).removeClass('disabled');
                    $(this).removeAttr('disabled');
                });
            }, cooldown - elapsed);
        }
    }
}

$(document).ready(() => {
    checkAllButtonsCooldown();
});
