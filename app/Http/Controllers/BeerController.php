<?php

namespace App\Http\Controllers;

use App\Exports\BeerExport;
use App\Http\Requests\BeerRequest;
use App\Services\PunkapiService;
use Maatwebsite\Excel\Facades\Excel;

class BeerController extends Controller
{
    public function index(BeerRequest $request, PunkapiService $service)
    {
        return $service->getBeers(...$request->validated());
    }

    public function export(BeerRequest $request, PunkapiService $service)
    {
        $beers = $service->getBeers(...$request->validated());

        Excel::store(new BeerExport($beers), 'olw-report.xlsx');

        return 'relatorio criado';
    }
}