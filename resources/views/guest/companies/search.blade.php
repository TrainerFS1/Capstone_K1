@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Search Companies</h1>

    <form action="{{ route('guest.companies.searchCompany') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="Search for companies..." aria-label="Search for companies..." aria-describedby="button-search">
            <button class="btn btn-primary" type="submit" id="button-search">Search</button>
        </div>
    </form>
</div>
@endsection