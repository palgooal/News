<x-dashboard-layout>
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\\Models\About')
        <li class="breadcrumb-item"><a href="{{route('dashboard.about.index')}}">{{__('admin.Abouts')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.About')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                @can('edit', 'App\\Models\About')
                <div class="card-header">
                    <h5>{{__('admin.Edit About')}}</h5>
                </div>
                 @endcan
                 @can('edit', 'App\\Models\About')
                <div class="card-body">
                    <form action="{{route('dashboard.about.update',$abouts->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.abouts._form')
                        <div class="row justify-content-end mt-3">
                            <a href="{{route('dashboard.about.index')}}" class="btn btn-secondary col-1 mr-3">
                                {{__('admin.Back')}}
                            </a>
                            <button type="submit" class="btn btn-primary col-1  mr-3">
                                {{__('admin.Update')}}
                            </button>
                        </div>
                    </form>
                </div>
                @endcan
            </div>
        </div>
    </div>

    </x-dashboard-layout>