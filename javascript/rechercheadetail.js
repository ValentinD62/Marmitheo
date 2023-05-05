



var button = document.getElementsByClassName('recette');
function m() {
    console.log(1);
    location.href="../pages/detail.php";
};

for (var i = 0;i<button.length;i++) {
    button[i].addEventListener('click',m);
}




