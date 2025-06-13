const texts = [
    "Selamat Datang di Toko Grosir dan Eceran AA Jaya",
    "Beli Keperluan Anda Disini!",
    "Dapatkan harga grosir terbaik untuk usaha Anda!",
    "Belanja lebih hemat dengan diskon menarik!",
    "Produk berkualitas dengan harga bersaing!",
    "Pilihan lengkap untuk kebutuhan sehari-hari!",
    "Layanan cepat dan ramah untuk kenyamanan belanja Anda!",
    "Belanja grosir lebih mudah dan praktis!",
    "Pesan sekarang dan nikmati penawaran spesial!",
    "Dapatkan produk segar dan berkualitas setiap hari!"
];


    let index = 0;

    function changeText() {
        let textElement = document.getElementById("change");
        textElement.classList.add("fade-out");


        setTimeout(() => {
            index = (index + 1) % texts.length;
            textElement.textContent = texts[index];
            textElement.classList.remove("fade-out");
        }, 1000);
    }

    setInterval(changeText, 3000);