@extends('layouts.app')

@section('content')
    <h1>Edit Client</h1>
    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div id="client-rows">
            @foreach($clients as $index => $client)
                <div class="client-row">
                    <div>
                        <label>Name</label>
                        <input type="text" name="clients[{{ $index }}][name]" value="{{ old('clients.' . $index . '.name', $client->name) }}">
                        @error('clients.' . $index . '.name') <div>{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="clients[{{ $index }}][email]" value="{{ old('clients.' . $index . '.email', $client->email) }}">
                        @error('clients.' . $index . '.email') <div>{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="text" name="clients[{{ $index }}][phone]" value="{{ old('clients.' . $index . '.phone', $client->phone) }}">
                        @error('clients.' . $index . '.phone') <div>{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label>Address</label>
                        <textarea name="clients[{{ $index }}][address]">{{ old('clients.' . $index . '.address', $client->address) }}</textarea>
                        @error('clients.' . $index . '.address') <div>{{ $message }}</div> @enderror
                    </div>
                    <button type="button" class="remove-row">Remove</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-row">Add Row</button>
        <button type="submit">Update</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let rowIndex = {{ count($clients) }};

            $('#add-row').click(function() {
                let newRow = $('.client-row:first').clone();
                newRow.find('input, textarea').each(function() {
                    let nameAttr = $(this).attr('name');
                    nameAttr = nameAttr.replace(/\[0\]/g, '[' + rowIndex + ']');
                    $(this).attr('name', nameAttr).val('');
                });
                newRow.find('.remove-row').show();
                $('#client-rows').append(newRow);
                rowIndex++;
            });

            $(document).on('click', '.remove-row', function() {
                $(this).closest('.client-row').remove();
            });
        });
    </script>
@endsection
