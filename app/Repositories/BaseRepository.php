<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected Model $entity;

    public function __construct(Model $entity){
        $this->entity = $entity;
    }

    public function get(string $identify)
    {
        return $this->entity->findOrFail($identify);
    }

    public function all(){
        return $this->entity->all();
    }

    public function save(array $data): bool
    {
        return $this->entity->save($data);
    }

    public function create(array $data)
    {
        return $this->entity->create($data);
    }


    public function update($identify,array $data){
        $result = $this->get($identify);

        return $result->update($data);
    }

    public function delete(string $identify){
        $result = $this->get($identify);
        
        return $result->delete($identify);
    }
}
