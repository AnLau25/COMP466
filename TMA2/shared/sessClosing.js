window.addEventListener('beforeunload', function (e) {
    const currentHost = window.location.host;
    const destinationHost = (e.target.activeElement?.href && new URL(e.target.activeElement.href).host) || null;

    if (destinationHost && destinationHost !== currentHost) {
        fetch('/shared/logout.php', {
            method: 'POST',
            keepalive: true
        });
    }
});