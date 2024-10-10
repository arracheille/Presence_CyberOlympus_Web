<script>
    function toggleFavoriteTaskItem(checkbox) {
        const taskitemId = {{ $taskitem->id }};
        const url = checkbox.checked ? `/task-item-favorite/${taskitemId}` : `/task-item-unfavorite/${taskitemId}`;
        
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