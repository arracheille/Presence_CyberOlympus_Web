<script>
    function toggleFavoriteTask(checkbox) {
        const taskId = checkbox.getAttribute('data-task-id');
        const url = checkbox.checked ? `/task-favorite/${taskId}` : `/task-unfavorite/${taskId}`;
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
    }
</script>