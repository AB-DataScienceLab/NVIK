document.addEventListener("DOMContentLoaded", function () {
    const image = document.getElementById("plot-image");

    // Toggle zoom on click
    image.addEventListener("click", function () {
        if (image.classList.contains("zoomed")) {
            image.classList.remove("zoomed"); // Remove zoom
        } else {
            image.classList.add("zoomed"); // Apply zoom
        }
    });
});
