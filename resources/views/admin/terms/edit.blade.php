@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-700 via-indigo-900 to-black p-6">

    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl p-8 mt-6 animate-fadeIn">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow">
                Edit Term
            </h1>

            <a href="{{ route('admin.terms.index') }}"
               class="bg-red-500 hover:bg-red-600
                      text-white font-semibold px-4 py-2 rounded-full
                      shadow-lg transition-all duration-300
                      hover:scale-105">
                ⟵ Back
            </a>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-500/80 text-white px-4 py-3 rounded-lg mb-4 animate-shake">
                <ul class="list-disc ml-4 space-y-1 font-medium">
                    @foreach($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form id="editTermForm" action="{{ route('admin.terms.update', $term->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-5">
                <label class="text-white font-medium mb-1 block">
                    Title <span class="text-green-300">*</span>
                </label>

                <input type="text"
                    name="title"
                    value="{{ old('title', $term->title) }}"
                    class="w-full bg-white/20 border border-white/30 text-white px-4 py-3 rounded-xl placeholder-gray-300 focus:ring-2 focus:ring-green-400 focus:border-transparent transition duration-200"
                    placeholder="Enter title"
                    required>
            </div>


            {{-- Description --}}
            <div class="mb-5">
                <label class="text-white font-medium mb-1 block">
                    Description <span class="text-green-300">*</span>
                </label>

                <textarea name="description" id="description"
                    rows="6"
                    class="w-full bg-white/20 border border-white/30 text-white px-4 py-3 rounded-xl placeholder-gray-300 focus:ring-2 focus:ring-green-400 focus:border-transparent transition duration-200"
                    placeholder="Write your content..."
                    required>{{ old('description', $term->description) }}</textarea>

                <p class="text-gray-300 text-xs text-right mt-1">
                    <span id="descCount">0</span> characters
                </p>
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label class="text-white font-medium mb-1 block">
                    Status <span class="text-green-300">*</span>
                </label>

                <select name="status"
                        class="w-full bg-white/20 border border-white/30 text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-green-400 focus:border-transparent transition duration-200"
                        required>
                    <option class="text-black" value="active" {{ old('status', $term->status)=='active' ? 'selected' : '' }}>Active</option>
                    <option class="text-black" value="inactive" {{ old('status', $term->status)=='inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>


            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-green-400 hover:bg-green-500 text-black font-semibold py-3 rounded-full shadow-lg transition-all duration-300 hover:scale-105"
                id="submitBtn">
                Save Changes
            </button>
        </form>
    </div>
</div>
@endsection


@section('scripts')
<script>
    // Change button text on submit
    document.getElementById("editTermForm").addEventListener("submit", function () {
        let btn = document.getElementById("submitBtn");
        btn.innerHTML = "Saving...";
        btn.classList.add("opacity-70", "cursor-not-allowed");
    });

    // Live character count
    const desc = document.getElementById("description");
    const count = document.getElementById("descCount");

    function updateCount() {
        count.textContent = desc.value.length;
    }

    desc.addEventListener("input", updateCount);
    updateCount();
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes shake {
        10%, 90% { transform: translateX(-1px); }
        20%, 80% { transform: translateX(2px); }
        30%, 50%, 70% { transform: translateX(-4px); }
        40%, 60% { transform: translateX(4px); }
    }
    .animate-shake {
        animation: shake 0.4s;
    }
</style>
@endsection
