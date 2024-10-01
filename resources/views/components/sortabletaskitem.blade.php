<script>
    document.querySelectorAll('.task-item-container').forEach(cardItemsContainer => {
        new Sortable(cardItemsContainer, {
            group: 'shared',
            animation: 150,
            onEnd: function(evt) {
                const itemId = evt.item.getAttribute('data-id');
                const newTaskId = evt.to.closest('.content-task').getAttribute('data-id');
                const items = Array.from(evt.to.children);
                const order = items.map((item, index) => ({
                    id: item.getAttribute('data-id'),
                    position: index
                }));
                fetch('{{ route('taskitemUpdate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        item_id: itemId,
                        new_task_id: newTaskId,
                        order: order
                    })
                })
                .then(response => response.json())
            }
        });
    });
</script>
