<x-app-layout>
    <x-slot name="title">
        User
    </x-slot>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 pt-8 pb-4 flex items-center">
        <div class="text-black mx-auto">
            <h1 class="text-3xl font-semibold ">User</h1>
        </div>
    </div>

    <x-card class="pt-4">
        <h1 class="text-xl font-semibold">User Details</h1>
        <div class="mt-2 flex">
            <x-user-card :user="auth()->user()" class="mx-auto"></x-user-card>
        </div>
    </x-card>

    <x-card class="pt-4">
        <h1 class="text-xl font-semibold">Update User Details</h1>
        content here.
    </x-card>

    <x-card class="pt-4">
        <h1 class="text-xl font-semibold">User Actions</h1>
        <div class="flex flex-col w-72 mt-4">
            <div class="flex">
                <span class="my-auto flex-grow font-bold">Delete Account</span>
                <form method="POST" action="{{ route('deleteUser') }}">
                    @CSRF
                    @METHOD('DELETE')
                    <x-button class="bg-red-500 border-red-600 hover:bg-red-600 hover:border-red-700 focus:ring-red-200" onclick="return confirm('You are deleting your account; this action is irreversable. \\n\\nThis will also remove any of your actions on the site.\\n\\nAre you sure you want to continue?')">Delete</x-button>
                </form>
            </div>
        </div>
    </x-card>
</x-app-layout>
