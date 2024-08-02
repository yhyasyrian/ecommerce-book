<?php

namespace App\Services\DashboardResource;

use App\Exceptions\NoCreateException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class ResourceService
{
    private array $columns = [];
    abstract public function getModel():Model;
    abstract public function getTitleForOne():string;
    abstract public function getNameRoute():string;
    abstract public function getTitleForMoreOne():string;
    abstract public function getRequestValidationRules():FormRequest;
    protected function createHandel(FormRequest $request):void
    {
        throw new NoCreateException();
    }
    public function setColumns(array $columns):void {
        $this->columns = $columns;
    }
    abstract public function __construct();
    private function getInformationBlade():array
    {
        return [
            'title' => $this->getTitleForOne(),
            'titlePage' => $this->getTitleForMoreOne(),
            'columns' => $this->columns,
            'nameRoute' => $this->getNameRoute(),
        ];
    }
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $data = $this->getModel()->paginate(10);
        $columnsTable = array_filter($this->columns,fn(ColumnDashboard $columnDashboard) => $columnDashboard->isShowInTable());
        return viewDashboard('resources.index',['data'=>$data,...$this->getInformationBlade(),'columnsTable'=>$columnsTable]);
    }
    public function create(): Factory|View|\Illuminate\Foundation\Application
    {
        $method = 'post';
        return viewDashboard('resources.create',[...$this->getInformationBlade(),...compact('method')]);
    }
    public function store(Request $request): Factory|View|\Illuminate\Foundation\Application|Application
    {
        $request->validate($this->getRequestValidationRules()->rules());
        try {
            $this->createHandel($this->getRequestValidationRules());
        } catch (NoCreateException $e) {
            foreach ($this->getRequestValidationRules()->rules() as $key => $value) {
                $this->getModel()->{$key} = $this->getRequestValidationRules()->get($key);
            }
            $this->getModel()->save();
        }
        session()->flash('success','تم الحفظ بنجاح');
        return $this->index();
    }
    public function show(int $book)//: Factory|\Illuminate\Foundation\Application|View|Application
    {
        // return viewdashboard('books.show',compact('book'));
    }
    public function edit(int $book)
    {

    }
    public function update(Request $request, int $book)
    {

    }
    public function destroy(int $book){}
}
