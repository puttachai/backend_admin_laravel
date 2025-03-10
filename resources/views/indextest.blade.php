@extends('layouts.mainLayout')

@section('content')

    <div class="card border-0 rounded-lg " style="margin: 40px;">
        <div class="mx-4 my-4 justify-center">
            <h1>List of Sellers</h1>
            <table style="border-collapse: collapse; width: 100%;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Seller ID</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Shop Name</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Email</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">User Name</th>
                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">User Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellers as $seller)
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $seller->seller_id }}</td> <!-- ดึง seller_id -->
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $seller->shop_name }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $seller->email }}</td>
                            @if($seller->user)
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $seller->user->name }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $seller->user->email }}</td>
                            @else
                                <td style="border: 1px solid #ddd; padding: 8px;">N/A</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">N/A</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
