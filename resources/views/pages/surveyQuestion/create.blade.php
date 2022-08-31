@extends('layout.master')
@section('content')
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    @include('partials.errors')
                    <form class="w-full"
                        action="@isset($surveyQuestion) {{ route('surveyQuestion.update', $surveyQuestion->id) }} @endisset @empty($surveyQuestion) {{ route('surveyQuestion.store') }} @endempty"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($surveyQuestion))
                            @method('PUT')
                        @endif
                        <table class="table table-bordered" id="dynamicAddRemove">
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="question[]" placeholder="Pertanyaan" required
                                        class="form-control" />
                                </td>
                                <td><button type="button" name="add" id="add-btn" class="btn btn-success"
                                        style="background-color: green">Add
                                        More</button></td>
                            </tr>
                        </table>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right">
                                <a href="{{ URL::previous() }}" class="btn btn-warning">Batal</a>
                                <button type="submit"
                                    class="shadow-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">
                var i = 0;
                $("#add-btn").click(function() {
                    ++i;
                    $("#dynamicAddRemove").append('<tr><td><input type="text" required name="question[' + i +
                        ']" placeholder="Pertanyaan" class="form-control" /></td><td><button type="button" style="background-color: red" class="btn btn-danger remove-tr">Remove</button></td></tr>'
                    );
                });
                $(document).on('click', '.remove-tr', function() {
                    $(this).parents('tr').remove();
                });
            </script>
        @endpush
    </x-app-layout>
@endsection
