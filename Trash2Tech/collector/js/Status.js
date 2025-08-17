document.querySelector(".hamburger").addEventListener("click", function() {
    document.querySelector(".nav-links").classList.toggle("show");
});
function updateStatus(button, status) {
    let card = button.closest(".status-card");
    let statusLabel = card.querySelector(".status-label");
    let completeButton = card.querySelector(".complete-btn");

    // Remove all status classes first
    statusLabel.classList.remove("pending", "in-progress", "completed");

    // Update status label & color
    statusLabel.textContent = status;

    if (status === "In Progress") {
        statusLabel.classList.add("in-progress");
        completeButton.disabled = false;
    } else if (status === "Completed") {
        statusLabel.classList.add("completed");
        completeButton.disabled = true;
    }
}
