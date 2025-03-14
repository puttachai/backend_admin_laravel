@extends('layouts.mainLayout')

@section('content')

<div class="page-body p-4 text-dark">
    <div class="page-heading border-bottom d-flex flex-row">
        <h5 class="font-weight-normal">User Details</h5>
    </div>
    <div class="small-cards mt-5 mb-4">

        <div class="container">
            <a href="{{ route('sellers.index') }}" class="btn btn-light mb-3">
                <i class="fa fa-arrow-left"></i> Go Back
            </a>
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <strong><i class="fa fa-user"></i> User Details</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Seller ID</th>
                                <td>{{ $sellers->seller_id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $sellers->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $sellers->email }}</td>
                            </tr>
                            <tr>
                                <th>Pickup Address</th>
                                <td>{{ $sellers->Pickup_address ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Shop Name</th>
                                <td>{{ $sellers->shop_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $sellers->phone_number ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Thai National ID</th>
                                <td>{{ $sellers->thai_national_id ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>ID Card Copy</th>
                                <td>
                                    @if ($sellers->id_card_copy)
                                    {{-- id_card --}}
                                        <a href="{{ asset('images/products/' . $sellers->id_card_copy) }}" target="_blank">View ID Card</a>
                                    @else
                                        <p>No ID card copy available</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $sellers->statussellers == 1 ? 'Admin' : 'User' }}</td>
                            </tr>
                            <tr>
                                <th>Seller Status</th>
                                <td>{{ $sellers->statusSellers }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ $sellers->Gender ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $sellers->date_of_birth ? \Carbon\Carbon::parse($sellers->date_of_birth)->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Registration Date</th>
                                <td>{{ $sellers->created_at ? \Carbon\Carbon::parse($sellers->created_at)->format('d/m/Y H:i') : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('sellers.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Go Back
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
