function updateTime() {
    const timeContainer = document.querySelector('.times');
    const now = new Date();
    const formattedTime = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    timeContainer.innerHTML = `<h3>${formattedTime}</h3>`;
}

setInterval(updateTime, 1000);
updateTime();
