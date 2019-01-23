/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/elements.scss');
require('../css/app.scss');
require('../css/login.scss');


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');


let search = document.getElementById('search_search');
let result = document.getElementById('search_result');
let timeoutId = 0;

search.addEventListener('input', function (e) {
    clearTimeout(timeoutId); // doesn't matter if it's 0
    timeoutId = setTimeout(fetchRequest, 500);
});

function fetchRequest() {
    if (search.value.length > 3) {
        fetch('/search/' + search.value)
            .then(response => response.text())
            .then(html => {
                result.innerHTML = html;
            });
    }
}

/** Tab **/
let items = document.querySelectorAll('.menu a ');
for (item of items) {
    let target = item.dataset.target;
    item.addEventListener('click', function (e) {
        e.preventDefault();
        let data = document.querySelectorAll('.data');
        for (dataEl of data) {
            dataEl.style.display = 'none';
        }
        document.querySelector('.' + target).style.display = 'flex';
    });
}