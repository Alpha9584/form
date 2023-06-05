document.addEventListener('DOMContentLoaded', function() {
    const likeBtns = document.getElementsByClassName('likeBtn');
    const dislikeBtns = document.getElementsByClassName('dislikeBtn');

    for (let i = 0; i < likeBtns.length; i++) {
        likeBtns[i].addEventListener('click', function() {
            toggleButton(likeBtns[i], dislikeBtns[i]);
        });
    }

    for (let i = 0; i < dislikeBtns.length; i++) {
        dislikeBtns[i].addEventListener('click', function() {
            toggleButton(dislikeBtns[i], likeBtns[i]);
        });
    }

    function toggleButton(btnToActivate, btnToDeactivate) {
        btnToActivate.classList.toggle('active');
        btnToDeactivate.classList.remove('active');
    }
});
