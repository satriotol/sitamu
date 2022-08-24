<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Survey') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('surveyQuestion.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                    + Create Survey
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-5">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Nilai/Orang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surveyQuestions as $surveyQuestion)
                                <tr>
                                    <td>{{ $surveyQuestion->question }}</td>
                                    <td>{{ $surveyQuestion->survey_answers->sum('value') }} /
                                        {{ $surveyQuestion->survey_answers->count() }} Orang</td>
                                    <td>
                                        <form class="inline-block"
                                            action='{{ route('surveyQuestion.destroy', $surveyQuestion->id) }}'
                                            method="POST">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')"
                                                class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                                Hapus
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
