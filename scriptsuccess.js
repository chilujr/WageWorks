const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        alert("Your message has been sent successfully!");
    }