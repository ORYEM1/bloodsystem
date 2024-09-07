document.getElementById("toggleButton").onclick = function() {
    var sidebar = document.getElementById("sidebar");
    var mainContent = document.getElementById("mainContent");

    if (sidebar.style.display === "block") {
        sidebar.style.display = "none";
        mainContent.style.marginLeft = "0";
    } else {
        sidebar.style.display = "block";
        mainContent.style.marginLeft = "260px"; // Adjust margin when sidebar is shown
    }
};
