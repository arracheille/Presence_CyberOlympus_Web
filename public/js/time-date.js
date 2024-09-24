function updateDateTime() {
    const now = new Date();
    const optionsTime = {
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
    };

    const currentTime = now.toLocaleTimeString(undefined, optionsTime);

    document.getElementById("current-time").textContent = currentTime;
}

// Update date and time once when the page loads
updateDateTime();

// Update time every second
setInterval(updateDateTime, 1000);
