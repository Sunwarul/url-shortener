<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Inertia\Inertia;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use App\Services\ShortCodeGeneratorInterface;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $urls = Url::where('created_by', Auth::id())
            ->get()
            ->map(function ($url) {
                $url->short_code = url($url->short_code);
                return $url;
            });
        return Inertia::render('Urls/Index', ['urls' => $urls]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request, ShortCodeGeneratorInterface $shortCodeGenerator)
    {
        $requestData = $request->validated();

        $url = Url::create([
            'original_url' => $requestData['original_url'],
            'short_code' => $shortCodeGenerator->generate($requestData['original_url']),
            'expire_at' => Auth::check() ? today()->addYears(5) : today()->addDays(7),
            'created_by' => Auth::id(),
        ]);

        return to_route('urls.generated', $url->short_code);
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        return redirect()->to($url->original_url);
    }


    public function generated(Url $url)
    {
        $url->short_code = url($url->short_code);
        return Inertia::render('UrlView', ['url' => $url]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        //
    }
}
