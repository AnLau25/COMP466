window.addEventListener('beforeunload', function (e) {
    const currentHost = window.location.host;
    const destinationHost = (e.target.activeElement?.href && new URL(e.target.activeElement.href).host) || null;

    if (destinationHost && destinationHost !== currentHost) {
        navigator.sendBeacon('/shared/sessKill.php');
    }
});
