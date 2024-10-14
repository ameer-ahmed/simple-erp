<?php

namespace App\Livewire\Manager\Task;

use App\Repository\TaskRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $keyword = null;

    private TaskRepositoryInterface $taskRepository;

    public function boot(
        TaskRepositoryInterface $taskRepository,
    )
    {
        $this->taskRepository = $taskRepository;
    }

    public function render()
    {
        $tasks = $this->taskRepository->searchByManager(auth('manager')->id(), $this->keyword);

        return view('livewire.manager.task.index', compact('tasks'));
    }

    public function destroy($id)
    {
        $this->taskRepository->deleteFirstByManager($id, auth('manager')->id());

        return redirect()->route('manager.tasks.index')->with('success', 'Success');
    }
}
