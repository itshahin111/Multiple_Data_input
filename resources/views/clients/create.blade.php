@extends('layouts.app')

@section('content')
    <h1>Add Client</h1>
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        <div id="client-rows">
            <div class="client-row">
                <div>
                    <label>Name</label>
                    <input type="text" name="clients[0][name]" value="{{ old('clients.0.name') }}">
                    @error('clients.0.name') <div>{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="clients[0][email]" value="{{ old('clients.0.email') }}">
                    @error('clients.0.email') <div>{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Phone</label>
                    <input type="text" name="clients[0][phone]" value="{{ old('clients.0.phone') }}">
                    @error('clients.0.phone') <div>{{ $message }}</div> @enderror
                </div>
                <div>
                    <label>Address</label>
                    <textarea name="clients[0][address]">{{ old('clients.0.address') }}</textarea>
                    @error('clients.0.address') <div>{{ $message }}</div> @enderror
                </div>
                <button type="button" class="remove-row">Remove</button>
            </div>
        </div>

        <button type="button" id="add-row">Add Row</button>
        <button type="submit">Save</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let rowIndex = 1;

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

            $('.remove-row').hide(); // Hide the remove button for the first row
        });
    </script>
@endsection
