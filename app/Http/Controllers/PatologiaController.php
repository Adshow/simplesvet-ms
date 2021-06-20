<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PatologiaService;
use App\Http\Requests\StorePatologiaPostRequest;

class PatologiaController extends Controller
{
    public function __construct(PatologiaService $PatologiaService)
    {
        $this->PatologiaService = $PatologiaService;
    }

    public function store(StorePatologiaPostRequest $request)
    {
        return $this->PatologiaService->store($request);
    }

    public function list()
    {
        return $this->PatologiaService->list();
    }

    public function shelve($patologia_id)
    {
        return $this->PatologiaService->shelve($patologia_id);
    }

    public function filter(Request $request)
    {
        return $this->PatologiaService->filter($request);
    }

    public function get($patologia_id)
    {
        return $this->PatologiaService->get($patologia_id);
    }
}
