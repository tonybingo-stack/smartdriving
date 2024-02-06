<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TemplateController extends Controller
{
    protected $model;
    protected $viewPath;
    protected $searchParam;

    public function __construct(Model $model, $viewPath, $searchParam)
    {
        $this->model = $model;
        $this->viewPath = $viewPath;
        $this->searchParam = $searchParam;
    }

    public function index(Request $request)
    {
        if ($request->has('paginate')) {
            $items = $this->model->where(function (Builder $query) {
                return !empty($this->searchParam) ? $query->where($this->searchParam,'like','%'.implode('%', str_split((string) request('qry', ''))) . '%') : $query;
            })->advancedFilter();
            return $items;
        }
        if ($request->acceptsHtml()) {
            return inertia($this->viewPath);
        }

        if ($request->acceptsJson()) {
            $items = $this->model->where(function (Builder $query) {
                return !empty($this->searchParam) ? $query->where($this->searchParam,'like','%'.implode('%', str_split((string) request('qry', ''))) . '%') : $query;
            })->get();
            return $items;
        }
    }

    public function show(Request $request, string $id)
    {
        if ($request->acceptsJson()) {
            $item = $this->model->findOrFail($id);
            return response()->json(['data' => $item]);
        }
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), $this->validationRules());

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        $item = $this->model->create($request->all());
        return response()->json(['data' => $item], 201);
    }

    public function update(Request $request, $id)
    {
        $item = $this->model->findOrFail($id);

        // $validator = Validator::make($request->all(), $this->validationRules());

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        $item->update($request->all());
        return response()->json(['data' => $item]);
    }

    public function destroy($id)
    {
        $item = $this->model->findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Item deleted']);
    }

    protected function validationRules()
    {
        // Define validation rules for the specific model
        return [];
    }


}