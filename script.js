function toggleMenu() {
    const nav = document.getElementById('Enlaces');
    nav.classList.toggle('active');
}

document.querySelectorAll('Enlaces a').forEach(link => {
    link.addEventListener('click', () => {
    document.getElementById('Enlaces').classList.remove('active');
    });
});