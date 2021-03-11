<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $user)
    {
        parent::__construct($user);
    }

    public function get(int $id): Model
    {
        return $this->model->find($id);
    }

    public function getByDescription($search)
    {
        return $this->model->where('description', 'like', '%'.$search.'%')
            ->select('id', 'description','code')
            ->orderby('description', 'asc')
            ->limit(5)
            ->get();
    }

}
