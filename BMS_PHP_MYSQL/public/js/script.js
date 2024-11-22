function updateDateTime() {
    const now = new Date();
    const day = String(now.getDate()).padStart(2, '0');
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const year = String(now.getFullYear()).slice(-2);
    
    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12; // Convert to 12-hour format

    const date = `${day}/${month}/${year}`;
    const time = `${hours}:${minutes}:${seconds} ${ampm}`;

    document.getElementById('datetime').innerText = `${date}    [   ${time}   ] `;
}

updateDateTime();
setInterval(updateDateTime, 1000);
