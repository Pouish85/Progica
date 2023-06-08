const departementCheckbox = document.getElementById(
    "search_bar_extendToDepartement"
);
const regionCheckbox = document.getElementById("search_bar_extendToRegion");

departementCheckbox.addEventListener("change", function () {
    if (departementCheckbox.checked) {
        regionCheckbox.checked = false;
    }
});

regionCheckbox.addEventListener("change", function () {
    if (regionCheckbox.checked) {
        departementCheckbox.checked = false;
    }
});
