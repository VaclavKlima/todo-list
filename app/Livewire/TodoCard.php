<?php

namespace App\Livewire;

use App\Models\TodoList;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TodoCard extends Component
{
    public TodoList $todoList;

    public string $newTodoItemTitle = '';

    public function render(): View
    {
        return view('livewire.todo-card');
    }


    public function addTodoItem(): void
    {
        $this->validate([
            'newTodoItemTitle' => 'required|string|max:255',
        ]);

        $this->todoList->todos()->create([
            'title' => $this->newTodoItemTitle,
        ]);

        $this->newTodoItemTitle = '';
        $this->todoList->loadMissing('todos');
    }

    public function toggleTodoItem(int $todoId): void
    {
        $todo = $this->todoList->todos->find($todoId);

        if (!$todo) {
            return;
        }

        $todo->is_completed = !$todo->is_completed;
        $todo->save();
    }

    public function deleteTodoItem(int $todoId): void
    {
        $this->todoList->todos()->where('id', $todoId)->delete();
        $this->todoList->refresh('todos');
    }

    public function deleteTodoList(): void
    {
        $this->todoList->delete();
        $this->dispatch('todoListDeleted', $this->todoList->id);
    }
}
