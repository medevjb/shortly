<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\UrlTrafic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class URLController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $urls = UrlTrafic::where( 'user_id', auth()->user()->id )->get();
        return view( 'layouts.url.index', compact( 'urls' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view( 'layouts.url.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request ) {
        $request->validate( [
            'url' => ['required', 'url'],
        ] );

        try {
            $url = $request->input( 'url' );
            $url = filter_var( $url, FILTER_SANITIZE_URL );

            // Check if the URL already exists. It will Genarate new Short Code if it already exists
            do {
                $shortCode = Str::random( 6 );
            } while ( UrlTrafic::where( 'short', Str::lower( $shortCode ) )->exists() );

            UrlTrafic::create( [
                'user_id' => auth()->user()->id,
                'url'     => $url,
                'short'   => Str::lower( $shortCode ),
            ] );

            flash()->success( 'Your short URL has been created.' );
            return redirect()->route( 'urls.index' );
        } catch ( \Throwable $th ) {
            flash()->error( $th->getMessage() );
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( string $code ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( string $code ) {
        $url = UrlTrafic::where( 'short', $code )->first();
        return view( 'layouts.url.edit', compact( 'url' ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, string $code ) {
        $request->validate( [
            'url' => ['required', 'url'],
        ] );
        try {
            $url = $request->input( 'url' );
            $url = filter_var( $url, FILTER_SANITIZE_URL );

            // Check if the URL already exists. It will Genarate new Short Code if it already exists
            do {
                $shortCode = Str::random( 6 );
            } while ( UrlTrafic::where( 'short', Str::lower( $shortCode ) )->exists() );

            UrlTrafic::where( 'short', $code )->update( [
                'url'     => $url,
                'short'   => Str::lower( $shortCode ),
            ] );

            flash()->success( 'Your short URL has been updated.' );
            return redirect()->route( 'urls.index' );
        } catch ( \Throwable $th ) {
            flash()->error( $th->getMessage() );
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $code ) {
        UrlTrafic::where( 'short', $code )->delete();
        flash()->success( 'Your short URL has been deleted.' );
        return redirect()->route( 'urls.index' );
    }

    /**
     * Redirect Controller
     * @param string $code
     * @return RedirectResponse
     */
    public function redirect( string $code ) {
        $url = UrlTrafic::where( 'short', $code )->first();
        if ( $url ) {
            $url->clicks += 1;
            $url->save();
            return redirect( $url->url );
        }
        return redirect()->back();
    }
}
