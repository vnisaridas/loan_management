<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Process Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                	<a class="btn btn-primary" href="{{ route('loan-process-data') }}">Process Data</a>
                    <hr/>
                    @if($details)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @foreach($headers as $header)
                                        <th> {{ $header }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if($details) @foreach($details as $detail)
                                <tr>
                                    @foreach($headers as $header)
                                        @if($header != 'client_id')
                                            <td> {{ number_format($detail[$header],2) }}</td>
                                        @else
                                            <td> {{ $detail[$header] }}</td>
                                        @endif
                                    @endforeach
                                </tr>
                                @endforeach @endif
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
