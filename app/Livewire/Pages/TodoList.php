<?php

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class TodoList extends Component
{
    public string $newTodoListTitle;
    public string $newTodoListDescription = '';

    public function render(): View
    {
        return view('livewire.pages.todo-list');
    }

    #[Computed]
    public function todoLists(): Collection
    {
        return \App\Models\TodoList::query()
            ->with('todos')
            ->orderBy('created_at')
            ->get();
    }

    public function addTodoList(): void
    {
        $this->validate([
            'newTodoListTitle' => 'required|string|max:255',
            'newTodoListDescription' => 'nullable|string|max:1000',
        ]);

        \App\Models\TodoList::create([
            'title' => $this->newTodoListTitle,
            'description' => $this->newTodoListDescription,
        ]);

        $this->newTodoListTitle = '';
        $this->newTodoListDescription = '';
    }

    #[On('todoListDeleted')]
    public function reloadTodoLists(): void
    {
        $this->todoLists();
    }
}
