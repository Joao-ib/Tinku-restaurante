</main>
</div>

<script>
    function toggleSidebar() {
        document.querySelector('.admin-sidebar').classList.toggle('collapsed');
        document.querySelector('.admin-main').classList.toggle('expanded');
    }

    // Auto-cerrar alertas después de 5 segundos
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);
</script>
</body>

</html>