<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 justify-items-center p-3">
        @foreach($this->todoLists as $todoList)
            <livewire:todo-card :todo-list="$todoList" wire:key="todolist-{{ $todoList->id }}" />
        @endforeach


        <div class="w-full h-full p-4 border-2 border-cyan-400 bg-white/10 backdrop-blur-md shadow-lg min-w-0.5 flex flex-col"
             style="box-shadow: 0 4px 30px rgba(0,0,0,0.2); border-image: linear-gradient(90deg, #00fff7 0%, #ff00ea 100%) 1; background: linear-gradient(135deg, rgba(0,255,247,0.15) 0%, rgba(255,0,234,0.10) 100%); min-height: 10rem;">

            <!-- input for the new todo list name -->
            <input type="text" wire:model="newTodoListTitle" placeholder="Enter Todo List Name"
                   class="w-full p-2 mb-4 border border-cyan-400 rounded bg-white/20 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300">

            <!-- input area for the description -->
            <textarea wire:model="newTodoListDescription" placeholder="Enter Todo List Description"
                      rows="5"
                      class="w-full h-full p-2 mb-4 border border-cyan-400 rounded bg-white/20 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300"></textarea>

            <button wire:click="addTodoList" class="w-full py-2 flex items-center justify-center text-2xl font-bold text-cyan-400 hover:text-cyan-500 transition duration-300 border-2 border-cyan-400 rounded">
                <i class="fas fa-plus"></i> Create Todo List
            </button>
        </div>
    </div>
</div>
