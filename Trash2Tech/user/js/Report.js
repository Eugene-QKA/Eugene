document.querySelector(".hamburger").addEventListener("click", function() {
    document.querySelector(".nav-links").classList.toggle("show");
});
function toggleDetails(id) {
    const row = document.getElementById(`details-${id}`);
    if (row.style.display === "table-row") {
        row.style.display = "none";
    } else {
        row.style.display = "table-row";
    }
}
