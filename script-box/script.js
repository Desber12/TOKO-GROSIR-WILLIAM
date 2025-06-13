document.addEventListener("DOMContentLoaded", function() {
    fetch('../box/get_data.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById("stock").innerText = data.stok;
        })
        .catch(error => console.error('Error fetching stock:', error));
});