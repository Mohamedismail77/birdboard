<x-app-layout>

    <div class="container py-4">

        <div class="flex items-center mb-4">
            <h1 class="flex-1 text-2xl text-gray-700">My Projects</h1>
            <a  class="btn btn-blue" href="/projects/create">New Project</a>
        </div>

        <div class="flex flex-wrap">
        @forelse($projects as $project)

            <a href="{{$project->path()}}" class="w-1/4 m-2 bg-white p-8 rounded-2xl shadow">
                <h1 class="mb-3 hover:text-red-400 text-blue-500 text-lg">{{$project->title}}</h1>
                <p class="text-gray-500">{{Str::limit($project->description,50)}}</p>
            </a>
        @empty
            <div>No Projects Created Yet</div>
        @endforelse
        </div>
    </div>

</x-app-layout>
