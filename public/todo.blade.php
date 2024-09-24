<x-app-layout>
    <h2>To-dos</h2>
    <div class="dashboard-wrapper">
      <div class="dashboard-to-do">
        @foreach ($tasks as $task)
        <div class="dashboard-to-do-card">
            <div class="to-do-card-top">
              <h4 onclick="editCardtitle({{ $task->id }}, '{{ $task->title }}')">{{ $task->title }}</h4>
              <div id="addcarditemModal" class="modal">
                <div class="modal-content">
                    <div class="modal-title-close">
                        <h2>Add New List</h2>
                        <span class="close" onclick="cancelAddcarditem()">&times;</span>
                    </div>
                    <form action="{{ route('storeItem') }}" method="POST">
                        @csrf
                        <input type="hidden" name="todo_card_id" id="todo_card_id">
                        <label for="item-title">Item Title</label>
                        <input type="text" id="item-title" name="title" required>
            
                        <label for="description">Description</label>
                        <textarea id="description" name="description"></textarea>
            
                        <div class="modal-footer">
                            <button type="button" class="cancel-btn" onclick="cancelAddcarditem()">Cancel</button>
                            <button type="submit" class="submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
            @if ($task->todos->count())
                @foreach ($task->todos as $todo)
                <div id="editCarditem" class="modal">
                  <div class="modal-content">
                    <div class="modal-title-close">
                      <h2>Edit Task Item</h2>
                      <span class="close" onclick="closeEdititem()">&times;</span>
                    </div>
                    <form id="editCarditemform" action="" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="todo_card_id" id="todo_card_id_edit">
                      <label for="item-title-edit">Item Title</label>
                      <input type="text" id="item-title-edit" name="title" required>
              
                      <label for="description-edit">Description</label>
                      <textarea id="description-edit" name="description"></textarea>
                      
                      <div class="modal-footer">
                        <a href="/softDelete/{{ $todo->id }}" class="delete-btn">Delete</a>
                        <button type="button" class="cancel-btn" onclick="cancelEdititem()">Cancel</button>
                        <button type="submit" class="submit-btn">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="to-do-card-item" onclick="editCarditem({{ $todo->id }}, '{{ $todo->title }}', '{{ $todo->description }}')">
                  <h5>{{ $todo->title }}</h5>
                  <p>{{ $todo->description }}</p>
                </div>
              @endforeach
            @endif
            <button class="btn" onclick="openAddcarditem({{ $task->id }})">Add Data</button>
          </div>
        @endforeach
        <div class="dashboard-to-do-card add-card" id="add-card">
          <button class="to-do-card-item add-to-do-card-item" id="add-card" onclick="openAddcard()">
            <i class="fa-solid fa-plus"></i>
            <p class="p-bold">Add Another List</p>
          </button>
        </div>
      </div>
    </div>
  
    <div id="editcardTitle" class="modal">
      <div class="modal-content">
        <div class="modal-title-close">
          <h2>Edit Task Name</h2>
          <span class="close" onclick="closeEdittitle()">&times;</span>
        </div>
        <form id="editTitleform" action="" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" id="editTitleid">
  
          <label for="editCardtitle">Task Title</label>
          <input type="text" id="editCardtitle" name="title" required>
          <div class="modal-footer">
            <button type="submit" class="submit-btn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  
    <div id="addcardModal" class="modal">
      <div class="modal-content">
        <div class="modal-title-close">
          <h2>Add New List</h2>
          <span class="close" onclick="closeAddcard()">&times;</span>
        </div>
        <form action="{{ route('storeCard') }}" method="POST">
          @csrf
          <label for="title">Task Title</label>
          <input type="text" id="title" name="title" required>
          <div class="modal-footer">
            <button type="button" class="cancel-btn" onclick="cancelAddcard()">Cancel</button>
            <button type="submit" class="submit-btn">Submit</button>
          </div>
        </form>
      </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
    <script>
      toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-center",
        "timeOut": "3000",
        "extendedTimeOut": "0",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };
      document.addEventListener('DOMContentLoaded', () => {
        @if(session('success'))
          toastr.success('{{ session('success') }}');
        @endif
      });
    </script>
  
    <script>
      function openAddcard() {
        document.getElementById('addcardModal').style.display = 'block';
      }
  
      function cancelAddcard() {
        document.getElementById('addcardModal').style.display = 'none';
      }
  
      function closeAddcard() {
        document.getElementById('addcardModal').style.display = 'none';
      }
  
      function openAddcarditem(taskId) {
        document.getElementById('addcarditemModal').style.display = 'block';
        document.getElementById('todo_card_id').value = taskId;
      }
  
      function cancelAddcarditem() {
        document.getElementById('addcarditemModal').style.display = 'none';
      }
  
      function closeAddcarditem() {
        document.getElementById('addcarditemModal').style.display = 'none';
      }
      
      function editCardtitle(id, title) {
        document.getElementById('editTitleid').value = id;
        document.getElementById('editCardtitle').value = title;
        document.getElementById('editTitleform').action = `/to-do/card/update/${id}`;
        document.getElementById('editcardTitle').style.display = 'block';
      }
  
      function cancelEdittitle() {
        document.getElementById('editcardTitle').style.display = 'none';
      }
  
      function closeEdittitle() {
        document.getElementById('editcardTitle').style.display = 'none';
      }  
  
      function editCarditem(id, title, description) {
        document.getElementById('todo_card_id_edit').value = id;
        document.getElementById('item-title-edit').value = title;
        document.getElementById('description-edit').value = description;
        document.getElementById('editCarditemform').action = `/to-do/item/update/${id}`;
        document.getElementById('editCarditem').style.display = 'block';
      }
  
      function closeEdititem() {
        document.getElementById('editCarditem').style.display = 'none';
      }
  
      function cancelEdititem() {
        document.getElementById('editCarditem').style.display = 'none';
      }
    </script>
  </x-app-layout>
  