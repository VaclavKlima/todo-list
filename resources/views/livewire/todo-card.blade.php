<div @class(['w-full h-full p-4 border-2 border-cyan-400 bg-gradient-to-bl backdrop-blur-md shadow-lg min-w-0.5 flex flex-col',
                $this->isCompleted ? 'from-green-500/30 to-green-500/10' : 'from-white/1 to-white/10'
            ])
     style="box-shadow: 0 4px 30px rgba(0,0,0,0.2); border-image: linear-gradient(90deg, #00fff7 0%, #ff00ea 100%) 1; min-height: 10rem;">

    <h2 class="text-xl font-bold text-cyan-400 mb-2">{{ $todoList->title }}</h2>

    <!-- delete button for the todo list in the top right corner -->
    <button wire:click="deleteTodoList"
            wire:confirm="Are you sure you want to delete this todo list?"
            class="text-red-400 hover:text-red-500 transition duration-300 absolute top-5 right-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <p class="text-sm text-white/70 mb-4">
        {{ $todoList->description }}&nbsp;
    </p>

    <ul class="flex-1 overflow-y-auto">
        @forelse($todoList->todos ?? [] as $todoItem)
            <li @class(['flex items-center justify-between p-2 mb-2  rounded shadow-sm', $todoItem->is_completed ? 'bg-green-500/30' : 'bg-white/20'])>
                <span class="text-white">{{ $todoItem->title }}</span>
                <div class="flex items-center">
                    <button wire:click="toggleTodoItem({{ $todoItem->id }})"
                            class="text-sm text-cyan-400 hover:text-cyan-500 transition duration-300">
                        @if($todoItem->is_completed)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                        @endif
                    </button>
                    <button wire:click="deleteTodoItem({{ $todoItem->id }})"
                            wire:confirm="Are you sure you want to delete this todo item?"
                            class="text-sm text-red-400 hover:text-red-500 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </li>
        @empty
            <li class="text-center text-white/70 p-2">No todo items found. Add some!</li>
        @endforelse
    </ul>

    <!-- input + button connected together in to group for adding new todo items -->
    <div class="flex items-stretch mt-4 rounded overflow-hidden shadow-sm">
        <input type="text" wire:model="newTodoItemTitle" placeholder="Enter Todo Item Title"
               wire:keydown.enter="addTodoItem"
               class="flex-1 p-2 border-t border-b border-l border-cyan-400 bg-white/20 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 transition duration-300 rounded-l">
        <button wire:click="addTodoItem" class="p-2 bg-cyan-400 text-white border-t border-b border-r border-cyan-400 hover:bg-cyan-500 transition duration-300 rounded-r flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </button>
    </div>
</div>
