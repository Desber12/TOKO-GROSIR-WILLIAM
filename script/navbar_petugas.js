const sidebarItems = document.querySelectorAll(".content-sidebar li");

const activeItem = localStorage.getItem("activeSidebar");
if (activeItem) {
    document.querySelectorAll(".content-sidebar li")[activeItem].classList.add("active");
}

sidebarItems.forEach((item, index) => {
    item.addEventListener("click", function () {
        sidebarItems.forEach(li => li.classList.remove("active"));
        this.classList.add("active");
        localStorage.setItem("activeSidebar", index);
    });
});

