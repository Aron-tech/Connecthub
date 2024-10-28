document.querySelectorAll('[id^="toggle-comments-"]').forEach(function(button) {
    button.addEventListener('click', function() {
        var postId = this.id.split('-')[2]; // Kiolvassa a post id-t a button id-jából
        var commentsSection = document.getElementById('comments-section-' + postId);
        commentsSection.classList.toggle('hidden');
    });
});
