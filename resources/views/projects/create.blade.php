<x-app-layout>

    <div class="md:container mx-auto py-4">

        <div class="flex items-center mb-4">
            <h1 class="flex-1 text-4xl">Create New Project</h1>
            <a  class="btn btn-blue" href="/projects">Cancel</a>
        </div>

        <div class="w-full max-w">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="/projects">
                @csrf
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Project Title</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="title" id="title" placeholder="Title"/>
                <br>
                <br>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Project Description</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="description" id="description" placeholder="Description" rows="3"></textarea>
                <br>
                <br>
                <button class="btn btn-blue" type="submit">Save</button>

            </form>
        </div>

</x-app-layout>


