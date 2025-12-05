@extends('templates.app')

@section('content')
{{-- jika user logout maka pesan akan muncul --}}
    @if (Session::get('success'))
        <div class="alert alert-success text-center">
            {{ Session::get('success') }}
            {{-- button close --}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Hero Section -->
    <div class="container-fluid bg-success text-white py-5">
        <div class="container mt-5 text-center">
            <h1 class="display-4">Welcome to My Savings</h1>
            <p class="lead">Your one-stop solution for managing your savings effectively.</p>
            <a href="#about" class="btn btn-light btn-lg mt-3">Learn More</a>
        </div>
    </div>

    <!-- About Section -->
    <div id="about" class="container my-5">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h2 class="text-success">About Us</h2>
                <p class="lead">We help you manage and grow your savings with smart financial solutions.</p>
            </div>
        </div>

        <!-- Vision & Mission Cards -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-success">
                    <div class="card-body">
                        <h3 class="card-title text-success">Vision</h3>
                        <p class="card-text">To become the leading platform in helping people achieve their financial goals through smart savings management.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-success">
                    <div class="card-body">
                        <h3 class="card-title text-success">Mission</h3>
                        <ul class="card-text">
                            <li>Provide user-friendly savings management tools</li>
                            <li>Educate users about financial literacy</li>
                            <li>Help users achieve their savings goals</li>
                            <li>Ensure security and transparency in all transactions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


