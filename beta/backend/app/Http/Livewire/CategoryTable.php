<?php

namespace App\Http\Livewire;

use App\Models\Category;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryTable extends DataTableComponent
{
    // protected $model = Category::class;

    // public function configure(): void
    // {
    //     $this->setPrimaryKey('id');
    //     $this->setRefreshVisible();
    // }
    

    // public function columns(): array
    // {
    //     return [
    //         Column::make("Id", "id")
    //             ->sortable(),
    //         Column::make("Name", "name")
    //             ->sortable(),
    //         Column::make("Description", "description")
    //             ->sortable(),
    //         Column::make("Created at", "created_at")
    //             ->sortable(),
    //         Column::make("Updated at", "updated_at")
    //             ->sortable(),
    //     ];
    // }
    public $category_id, $action;
    public $myParam = 'Default';
    public string $tableName = 'category';
    public array $category = [];
    

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];
    
    public $columnSearch = [
        'name' => null,
        'description' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['categories.id as id'])
            ->setHideReorderColumnUnlessReorderingEnabled();

        $this->setTableWrapperAttributes([
            'class' => 'table align-middle table-row-dashed fs-6 gy-5',
        ]);
        $this->setTheadAttributes([
            'class' => 'text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0',
          ]);
        $this->setTbodyAttributes([
            'class' => 'fw-semibold text-gray-600',
          ]);
          $this->setThAttributes(function(Column $column) {
            if ($column->isField('name')) {
              return [
                'class' => 'min-w-250px',
              ];
            }
        
            return [];
          });
        $this->setTrAttributes(function($row, $index) {
            if ($index % 2 === 0) {
                return [
                'class' => 'text-start',
                ];
            } else {
                return [
                    'class' => 'text-start',
                ];
            }
      
            return [];
        });
        $this->setRefreshVisible();
    }

    public function columns(): array
    {
        return [
            // ImageColumn::make('Avatar')
            //     ->location(function($row) {
            //         return asset('img/logo-'.$row->id.'.png');
            //     })
            //     ->attributes(function($row) {
            //         return [
            //             'class' => 'w-8 h-8 rounded-full',
            //         ];
            //     }),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Description', 'description')
                ->sortable()
                ->searchable()
                ->excludeFromColumnSelect(),
            ButtonGroupColumn::make('Actions', 'actions')
                ->unclickable()
                ->attributes(function($row) {
                    return [
                        'class' => 'text-end',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit' )
                        ->location(fn($row) => '#')
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-light-primary btn-active-primary',
                                'wire:click' => "selectAction(".$row->id.", 'update')",
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => 'Delete')
                        ->location(fn($row) => '#')
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-light-danger btn-active-danger',
                                'wire:click' => "selectAction(".$row->id.", 'delete')",
                            ];
                        }),
                ]),
        ];
    }

    public function selectAction($category_id, $action) {
        $this->category_id = $category_id;
        $this->action = $action;
        if($action == 'update') {
            //Update
            $this->emit('getCategoryData', $this->category_id);
            $this->dispatchBrowserEvent('openEditModal');

        } else {
            //Delete
            $this->dispatchBrowserEvent('openDeleteModal', ['id' => $category_id]);
        }
    }

    public function builder(): Builder
    {
        return Category::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('categories.name', 'like', '%' . $name . '%'))
            ->when($this->columnSearch['description'] ?? null, fn ($query, $description) => $query->where('categories.description', 'like', '%' . $description . '%'));
    }
}
