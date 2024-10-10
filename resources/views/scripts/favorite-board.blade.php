<script>
    function toggleFavorite(checkbox) {
        const boardId = {{ $board->id }};
        const url = checkbox.checked ? `/favorite/${boardId}` : `/unfavorite/${boardId}`;
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            return response.json();
        })
    }
</script>