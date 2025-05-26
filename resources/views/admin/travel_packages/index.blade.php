@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">{{ __('Travel Packages') }}</h1>
                    @if(auth()->user()->role == 'administrator')
                    <a href="{{ route('admin.travel_packages.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Type</th>
                                        <th>Image</th>
                                        <th>Location</th>
                                        <th>Price</th>
                                        <th>Description</th> {{-- Tambah kolom Description --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($travel_packages as $travel_package)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $travel_package->type }}</td>
                                            <td>
                                                @if($travel_package->galleries->isNotEmpty())
                                                    <img src="{{ asset('storage/' . $travel_package->galleries->first()->images) }}" alt="{{ $travel_package->type }}" width="100">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ $travel_package->location }}</td>
                                            <td>{{ $travel_package->price }}</td>
                                            <td>{{ Str::limit($travel_package->description, 100) }}</td> {{-- Ringkas deskripsi --}}
                                            <td>
                                            <td>
                                                <a href="{{ route('travel_package.show', $travel_package) }}" class="btn btn-sm btn-primary" target="_blank">
                                                    <i class="fa fa-eye"></i> Detail
                                                </a>
                                                @if(auth()->user()->role == 'administrator')
                                                <a href="{{ route('admin.travel_packages.edit', [$travel_package]) }}" class="btn btn-sm btn-info"> <i class="fa fa-edit"></i> </a>
                                                @endif
                                                @if(auth()->user()->role == 'administrator')
                                                <form onclick="return confirm('are you sure ?');" class="d-inline-block" action="{{ route('admin.travel_packages.destroy', [$travel_package]) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="7">Data Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{ $travel_packages->links() }}
                        </div>
                    </div>

                </div>
            </div>
            </div></div>
    @endsection