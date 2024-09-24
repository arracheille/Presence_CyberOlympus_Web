<script>
    document.querySelectorAll('.task-item-container').forEach(cardItemsContainer => {
        new Sortable(cardItemsContainer, {
            group: 'shared',
            animation: 150,
            onEnd: function(evt) {
                const itemId = evt.item.getAttribute('data-id');
                const newTaskId = evt.to.closest('.to-do-card').getAttribute('data-id');

                fetch('{{ route('task-item.updatePosition') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        item_id: itemId,
                        new_task_id: newTaskId
                    })
                })
            }
        });
    });
</script>
