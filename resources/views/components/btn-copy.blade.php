<script>
    document.getElementById('clipboard').addEventListener('click', function() {
        var copyText = document.getElementById('share_url');
        copyText.select();
        // copyText.setSelectionRange(0, 99999);
        document.execCommand('copy');
        var icon = document.querySelector('#clipboard i');
        icon.classList.remove('far', 'fa-clipboard');
        icon.classList.add('fa-solid', 'fa-check');
        setTimeout(function() {
            icon.classList.remove('fa-solid', 'fa-check');
            icon.classList.add('far', 'fa-clipboard');
        }, 2000);
    });
</script>