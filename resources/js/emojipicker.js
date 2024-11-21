document.addEventListener('DOMContentLoaded', function () {
    const emojiButton = document.getElementById('emoji-button');
    const emojiPicker = document.getElementById('emoji-picker');
    const textarea = document.getElementById('body');

    emojiButton.addEventListener('click', function () {
        emojiPicker.classList.toggle('hidden');
    });

    emojiPicker.addEventListener('click', function (event) {
        if (event.target.classList.contains('emoji')) {
            const emoji = event.target.getAttribute('data-emoji');
            textarea.value += emoji;
            emojiPicker.classList.add('hidden');
        }
    });
});
