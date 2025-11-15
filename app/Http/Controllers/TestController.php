<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
    public function test()
    {
        return Inertia::render('FinnTest');
        // return redirect()->route('dashboard')
        //     ->with('success', 'This is a success message!')
        //     ->with('info', 'This is an info message!')
        //     ->with('warning', 'This is a warning message!')
        //     ->with('error', 'This is an error message!');
    }

    public function testSuccess()
    {
        return redirect()->route('dashboard')
            ->with('success', 'Operation completed successfully!');
    }

    public function testError()
    {
        return redirect()->route('dashboard')
            ->with('error', 'Something went wrong! Please try again.');
    }

    public function testInfo()
    {
        return redirect()->route('dashboard')
            ->with('info', 'Here is some useful information for you.');
    }

    public function testWarning()
    {
        return redirect()->route('dashboard')
            ->with('warning', 'Please be careful with this action.');
    }
}
