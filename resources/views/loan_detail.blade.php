<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loan Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered">
                    	<thead>
                    		<tr>
                    			<th>Client ID</th>
                    			<th>No of Payments</th>
                    			<th>First Payment</th>
                    			<th>Last Payment</th>
                    			<th>Amount</th>
                    		</tr>
                    	</thead>	
                    	<tbody>
                            @if($details)
                        		@foreach($details as $detail)
                        			<tr>
                        				<td>{{ $detail->client_id }}</td>
                        				<td>{{ $detail->num_of_payment }}</td>
                        				<td>{{ date('d/m/Y',strtotime($detail->first_payment_date)) }}</td>
                        				<td>{{ date('d/m/Y',strtotime($detail->last_payment_date)) }}</td>
                        				<td>{{ number_format($detail->loan_amount,2) }}</td>
                        			</tr>
                        		@endforeach	
                            @else
                                <tr>
                                    <td colspan="5">Sorry No Data</td>
                                </tr>
                            @endif    
                    	</tbody>	
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
