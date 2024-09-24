<script>
    const cardWrapper = document.getElementById("to-do-body");

    new Sortable(cardWrapper, {
        animation: 360,
        chosenClass: "boxShadow",
        dragClass: "drag",
        filter: '.add-card',
        onEnd: function (evt) {
            const items = Array.from(cardWrapper.children);
            
            const order = items.map((item, index) => ({
                id: item.getAttribute('data-id'), 
                position: index
            }));

            fetch('/tasks/update-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ order })
            })
        }
    });
</script>
